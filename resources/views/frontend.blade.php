<!DOCTYPE html>
<html>
<head>
    <title>Frontend for Currency Converter</title>
    <meta charset="utf-8">

    <style>

        pre {
            background:silver;
            width:500px;
            padding:10px;
        }

    </style>
</head>
<body>
<h3>List all available currencies</h3>
<pre id="available_currencies">
    Loading...
</pre>

<h3>Getting rates for selected currency</h3>
<select name="currency_rate_selector" id="currency_rate_selector">
        <option disabled selected>Choose...</option>
    @foreach($currencies as $currency)
        <option value="{{ $currency }}">{{ $currency }}</option>
    @endforeach
</select>

<pre id="rates_for_selected_currency">
    Select some value...
</pre>

<h3>Convert between two currencies</h3>

<select name="convert_from_currency" id="convert_from_currency">
    @foreach($currencies as $currency)
        <option value="{{ $currency }}">{{ $currency }}</option>
    @endforeach
</select> -
<select name="convert_to_currency" id="convert_to_currency">
    @foreach($currencies as $currency)
        <option value="{{ $currency }}">{{ $currency }}</option>
    @endforeach
</select>
<input type="text" name="convert_currency_amount" id="convert_currency_amount" value="" placeholder="eg. 100">
<button id="convert_between_two_currency">Convert</button>

<pre id="convert_results">
    Fill the data and see the results...
</pre>

<h3></h3>

<script>
    function getAvailableCurrencies() {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function () {
            document.getElementById("available_currencies").innerHTML = this.responseText;
        }
        xhttp.open("GET", "/currencies", true);
        xhttp.send();
    }

    function getRatesForSelectedCurrency()
    {
        document.getElementById('currency_rate_selector').addEventListener('change', function() {
            var chosen_currency = this.value;

            document.getElementById("rates_for_selected_currency").innerHTML = "Calculating...";

            const xhttp = new XMLHttpRequest();
            xhttp.onload = function () {
                document.getElementById("rates_for_selected_currency").innerHTML = this.responseText;
            }
            xhttp.open("GET", "/rates/"+chosen_currency, true);
            xhttp.send();


        });
    }

    function convertBetweenTwoCurrencies()
    {
        document.getElementById('convert_between_two_currency').addEventListener('click', function() {


            document.getElementById("convert_results").innerHTML = "Calculating...";

            var from_currency = document.getElementById("convert_from_currency").value;
            var to_currency = document.getElementById("convert_to_currency").value;
            var convert_currency_amount = document.getElementById("convert_currency_amount").value;

            console.log(from_currency)

            const xhttp = new XMLHttpRequest();
            xhttp.onload = function () {
                var resp = JSON.parse(this.responseText);
                var res = resp['result'].toFixed(2);
                document.getElementById("convert_results").innerHTML = `${resp['fromValue']} ${resp['from']} is ${res} ${resp['to']}`;
            }
            xhttp.open("POST", "/convert", true);
            xhttp.setRequestHeader("Content-Type", "application/json");
            xhttp.send(JSON.stringify({
                "from": from_currency,
                "to": to_currency,
                "fromValue": convert_currency_amount
            }));


        });

    }


    (function () {

        getAvailableCurrencies();
        getRatesForSelectedCurrency();
        convertBetweenTwoCurrencies();

    })();


</script>

</body>
</html>
