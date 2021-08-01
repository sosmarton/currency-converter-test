<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ConvertController extends CurrencyDataManagerController
{
    public function ConvertValuesBetweenTwoCurrency(Request $request) : array
    {


        $data = (array) json_decode($request->getContent(),true);

        $this->validate($request, [
            'from' => 'required|string',
            'to' => 'required|string',
            'fromValue' => 'required|numeric'
        ]);


        return $this->ConvertBetweenTwoCurrency(
            $data["from"],
            $data["to"],
            $data["fromValue"]
        );


    }
}
