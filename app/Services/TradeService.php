<?php

namespace App\Services;

use App\Events\AfterTradeClosed;
use App\Models\Asset;
use App\Models\Competition;
use App\Models\CompetitionParticipant;
use App\Models\Currency;
use App\Models\Trade;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class TradeService extends Service
{
    private $competition;
    private $user;
    private $openTrades;

    public function __construct(Competition $competition, User $user)
    {
        $this->competition = $competition;
        $this->user = $user;
    }

    /**
     * Open a new trade
     *
     * @param Asset $asset
     * @param null $direction
     * @param null $volume
     * @return Trade
     */
    public function open(Asset $asset, $direction, $volume) {
        $assetService = new AssetService();
        $price = $assetService->asset($asset)->price;

        Log::info(sprintf('New trade by user %d: %s %d x %.2f %s @ %f', $this->user->id, ($direction==Trade::DIRECTION_BUY?'buy':'sell'), $this->competition->lot_size, $volume, $asset->symbol, $price));

        // save a new trade
        $trade = new Trade();
        $trade->competition()->associate($this->competition);
        $trade->user()->associate($this->user);
        $trade->asset()->associate($asset);
        $trade->currency()->associate($this->competition->currency);
        $trade->direction   = $direction;
        $trade->lot_size    = $this->competition->lot_size;
        $trade->volume      = $volume;
        $trade->price_open  = $price;
        $trade->margin      = $this->margin($asset, $volume);
        $trade->status      = Trade::STATUS_OPEN;
        $trade->save();

        return $trade;
    }

    public function close(Trade $trade) {
        if ($trade->status == Trade::STATUS_OPEN) {
            $assetService = new AssetService();
            $price = $assetService->asset($trade->asset)->price;

            Log::info(sprintf('Close trade %d by user %d @ %f', $trade->id, $this->user->id, $price));

            $trade->price_close = $price;
            $trade->pnl = $this->unrealizedProfitLoss($trade);
            $trade->status = Trade::STATUS_CLOSED;
            $trade->closed_at = Carbon::now();
            $trade->save();

            // update user balance in the competition (add PnL)
            CompetitionParticipant::where([
                ['competition_id', $this->competition->id],
                ['user_id', $trade->user->id]
            ])
                ->increment('current_balance', $trade->pnl);

            event(new AfterTradeClosed($trade));
        }

        return $trade;
    }

    /**
     * Close all open trades
     */
    public function closeAll() {
        Log::info(sprintf('Closing all trades of user %d', $this->user->id));

        foreach ($this->openTrades() as $openTrade) {
            $this->close($openTrade);
        }
    }

    /**
     * Calculate required margin
     *
     * @param Asset $asset
     * @param null $volume
     * @return float|int
     */
    public function margin(Asset $asset, $volume) {
        return $this->competition->leverage
            ? $asset->price * $this->competition->lot_size * $volume / $this->competition->leverage
            : 0;
    }

    /**
     * Get user balance in competition
     *
     * @return float
     */
    public function balance() {
        $participant = $this->competition->participant($this->user);
        if (!$participant)
            abort(404);

        return $participant->current_balance;
    }

    /**
     * Calculate total margin on open trades
     *
     * @return float
     */
    public function totalMargin() {
        $totalMargin = 0;
        foreach ($this->openTrades() as $trade) {
            $totalMargin += $trade->margin;
        }
        return $totalMargin;
    }

    /**
     * Calculate unrealized PnL of a trade
     *
     * @param Trade $trade
     * @return mixed
     */
    public function unrealizedProfitLoss(Trade $trade) {
        // if unrealizedPnl was already calculated before simply return it
        return isset($trade->unrealizedPnl)
            ? $trade->unrealizedPnl
            : ($trade->asset->price - $trade->price_open) * $trade->direction_sign * $trade->lot_size * $trade->volume;
    }

    /**
     * Calculate total unrealized PnL
     *
     * @return int|mixed
     */
    public function totalUnrealizedProfitLoss() {
        $totalUnrealizedPnl = 0;
        foreach ($this->openTrades() as $trade) {
            // virtual property unrealizedPnl is added, so MarginCallService can determine the most losing trade
            $trade->unrealizedPnl = $this->unrealizedProfitLoss($trade);
            $totalUnrealizedPnl += $trade->unrealizedPnl;
        }
        return $totalUnrealizedPnl;
    }

    /**
     * Calculate equity
     *
     * @param User $user
     * @return float
     */
    public function equity() {
        return $this->balance() + $this->totalUnrealizedProfitLoss();
    }

    /**
     * Calculate free margin
     *
     * @param User $user
     * @return float
     */
    public function freeMargin() {
        return $this->equity() - $this->totalMargin();
    }

    /**
     * Calculate margin level
     *
     * @return float
     */
    public function marginLevel() {
        if ($this->openTrades()->isEmpty())
            throw new \Exception('Margin level can not be calculated if the user does not have open trades.');

        return $this->equity() / $this->totalMargin() * 100;
    }

    /**
     * Get open trades list
     *
     * @return mixed
     */
    public function openTrades() {
        if (is_null($this->openTrades))
            $this->loadOpenTrades();

        return $this->openTrades;
    }

    public function closedTradesCount() {
        return Trade::where([
                ['competition_id',  $this->competition->id],
                ['user_id',         $this->user->id],
                ['status',          Trade::STATUS_CLOSED]
            ])
            ->count();
    }

    /**
     * Load open trades from database
     */
    private function loadOpenTrades() {
        $this->openTrades = Trade::where([
                ['competition_id',  $this->competition->id],
                ['user_id',         $this->user->id],
                ['status',          Trade::STATUS_OPEN]
            ])
            ->with('asset')
            ->get();
    }
}