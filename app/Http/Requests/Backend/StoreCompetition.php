<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreCompetition extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'title'             => 'required|string|max:150',
            'duration'          => [
                'required',
                'string',
                'max:30',
                'regex:/[0-9PTYMDHS]+/'
            ],
            'slots_required'    => 'required|integer|min:1|max:16777215', // mediumint
            'slots_max'         => 'required|integer|min:'.$request->slots_required.'|max:16777215', // mediumint
            'start_balance'     => 'required|numeric|min:0.01|max:9999999999.99',
            'lot_size'          => 'required|integer|min:1',
            'leverage'          => 'required|integer|min:1',
            'volume_min'        => 'required|numeric|min:0.0001',
            'volume_max'        => 'required|numeric|min:'.$request->volume_min.'|max:999999',
            'min_margin_level'  => 'required|numeric|min:0|max:9999.99',
            'fee'               => 'sometimes|required|numeric|min:0|max:999999999999.99',
        ];
    }
}
