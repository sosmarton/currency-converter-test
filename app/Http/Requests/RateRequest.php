<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RateRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        $this->merge(['fromCurrency' => $this->route('fromCurrency')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fromCurrency' => 'required|in:'.implode(',',config('currencyapis.currencies'))
        ];
    }
}
