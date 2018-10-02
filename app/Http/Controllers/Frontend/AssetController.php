<?php

namespace App\Http\Controllers\Frontend;

use App\Badge;
use App\Models\Asset;
use App\Http\Controllers\Controller;
use App\Models\Sort\Frontend\AssetSort;
use App\Services\AssetService;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    const MAX_ASSETS = 10;

    public function index(Request $request) {
        $sort = new AssetSort($request);

        $assets = Asset::where('status', Asset::STATUS_ACTIVE)
            ->withCount('trades')
            ->orderBy($sort->getSortColumn(), $sort->getOrder())
            ->paginate($this->rowsPerPage);

        $badges = Badge::orderBy('points', 'desc')->get();

        return view('pages.frontend.assets.index', [
            'assets'    => $assets,
            'sort'      => $sort->getSort(),
            'order'     => $sort->getOrder(),
            'badges'    => $badges,
        ]);
    }

    /**
     * Search assets by name or symbol
     *
     * @param $query
     * @return array
     */
    public function search($query) {
        $query = trim(strtolower($query));
        // title field is required so correct result value is passed to onSelect() callback (Semantic UI search)
        $assets = Asset::where('status', Asset::STATUS_ACTIVE)
            ->where(function($sql) use($query) {
                $sql->whereRaw('LOWER(symbol) LIKE ?', [$query.'%']);
                $sql->orWhereRaw('LOWER(name) LIKE ?', ['%'.$query.'%']);
            })
            ->orderBy('symbol', 'asc')
            ->orderBy('name', 'asc')
            ->limit(self::MAX_ASSETS)
            ->get();

        return [
            'results' => $assets
        ];
    }

    /**
     * Save asset ID in session
     *
     * @param Request $request
     * @param Asset $asset
     * @return array
     */
    public function remember(Request $request, Asset $asset) {
        $request->session()->put('default_asset_id', $asset->id);
        return ['success' => TRUE];
    }

    /**
     * Get asset info
     *
     * @param Asset $asset
     * @return Asset|void
     */
    public function infoSingle(Asset $asset) {
        // Update asset market data before returning it
        if ($asset->status == Asset::STATUS_ACTIVE) {
            $assetService = new AssetService();
            return $assetService->asset($asset);
        }

        return abort(404);
    }

    public function infoMany(Request $request) {
        $assets = [];

        if ($request->ids) {
            $assetsIds = array_filter($request->ids, function ($id) {
                return intval($id) > 0;
            });

            $assetService = new AssetService();
            foreach ($assetsIds as $assetId) {
                $asset = Asset::findOrFail($assetId);
                if ($asset->status == Asset::STATUS_ACTIVE) {
                    $assets[] = $assetService->asset($asset);
                }
            }
            return $assets;
        }
    }
}