<div class="ui popup">
    <div class="header">{{ __('app.payout_structure') }}</div>
    <table class="ui very basic compact table">
        <tbody>
        @foreach($competition->payouts as $i => $payout)
            <tr>
                <td>
                    <span class="ui circular label">{{ ++$i }}</span> {{ __('app.place') }}
                </td>
                <td>&mdash;</td>
                <td>
                    {{ $payout['amount'] }}{{ $payout['type'] == 'flat' ? ' ' . $competition->currency->code : __('app.payout_type_percentage') }}
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">
                    {{ __('cash-competitions::text.fees_paid') }}
                    &mdash;
                    {{ $competition->total_fees_paid }} {{ $competition->currency->code }}
                </td>
            </tr>
            @if($competition->status == \App\Models\Competition::STATUS_COMPLETED)
                <tr>
                    <td colspan="3">
                        {{ __('cash-competitions::text.reward_paid') }}
                        &mdash;
                        {{ $competition->total_reward_paid }} {{ $competition->currency->code }}
                    </td>
                </tr>
            @endif
        </tfoot>
    </table>
</div>