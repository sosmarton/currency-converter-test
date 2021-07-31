<?php

namespace App\Http\Controllers;

use App\Services\CurrencyConverterManagerService;
use Illuminate\Http\Request;

class ConvertController extends Controller
{
    public function ConvertBetweenTwoCurrency(Request $request) : array
    {


        $data = (array) json_decode($request->getContent(),true);

        $this->validate($request, [
            'from' => 'required|string',
            'to' => 'required|string',
            'fromValue' => 'required|numeric'
        ]);


        return CurrencyConverterManagerService::ConvertBetweenTwoCurrency(
            $data["from"],
            $data["to"],
            $data["fromValue"]
        );


    }
}
