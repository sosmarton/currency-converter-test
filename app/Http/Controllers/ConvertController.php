<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ConvertController extends Controller
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
