<?php

namespace App\Http\Controllers;
use App\Services\CurrencyConverterManagerService;
use Illuminate\Http\Request;

class ConvertController extends CurrencyDataManagerController
{
    public function ConvertBetweenTwoCurrency(Request $request, CurrencyConverterManagerService $converter_manager) : array
    {


        $data = (array) json_decode($request->getContent(),true);

        $this->validate($request, [
            'from' => 'required|string',
            'to' => 'required|string',
            'fromValue' => 'required|numeric'
        ]);


        return $converter_manager->ConvertBetweenTwoCurrency(
            $data["from"],
            $data["to"],
            $data["fromValue"]
        );


    }
}
