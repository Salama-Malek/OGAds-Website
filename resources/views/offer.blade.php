<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Part 1</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap-4.3.1-dist/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Add your custom CSS styles here */

        .container {
            padding: 20px;
        }

        .container2 {
            display: flex;
            justify-content: center;
            align-items: center;
            /* height: 100vh; */
        }

        .input-container {
            display: flex;
            align-items: center;
            background-color: #eaeaea;
            border-radius: 50px;
            padding: 10px;
        }

        .num-jal {
            background-color: #a8f0a4;
            font-size: 30px;
            font-weight: bold;
            color: white;
            display: flex;
            width: 25%;
            align-items: center;
            border-radius: 50px;
            padding: 5px;
        }

        .rounded-input {
            flex: 1;
            padding: 10px;
            height: 70px;
            border-radius: 50px;
            border: none;
            outline: none;
        }

        .copy-button {
            background-color: rgba(170, 242, 165, 1);
            color: black;
            border: none;
            border-radius: 50%;
            padding: 15px;
            cursor: pointer;
            margin-left: 10px;
            font-size: 20px;
            line-height: 1;
        }

        .input-img {
            margin-right: 10px;
            width: 40px;
            padding-bottom: 40px;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        span {
            display: block;
        }

        .red-text {
            color: red;
        }

        .offers-div {
            flex-wrap: nowrap;

            background-color: #efdddd;
        }



        .oval {
            height: 50px;
            width: 100px;
            background-color: #555;
            border-radius: 50%;
        }

        .freefire-div {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .need-div {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }


        /* Media Queries */
        @media (max-width: 768px) {
            .num-jal {
                font-size: 24px;
                width: 50%;
                padding: 3px;
            }
        }

        @media (max-width: 576px) {
            .num-jal {
                font-size: 20px;
                width: 40%;
                padding: 2px;
            }
        }

        @media (max-width: 320px) {
            .num-jal {
                font-size: 15px;
                padding: 2px;
            }

            #n_686353776861-w {
                width: 20%;
            }
        }

        #n_686353776861-w {
            width: inherit;
        }

        h2 {
            font-size: inherit;
        }

        tt {
            font-size: inherit;
        }

        .p-5 {
            font-size: 25px !important;
        }
    </style>
    <script src="{{ asset('images/js/part_1.js') }}"></script>
</head>

<body dir="rtl">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <img id="phone-call" src="{{ asset('images/phone-call.png') }}">
            <div class="num-jal">
                <img id="n_686353776861-w" src="{{ asset('images/jal.png') }}">
                <span class="">{{ '99 جوهرة' }}</span>
            </div>

            <img id="contract" src="{{ asset('images/contract.png') }}">
        </div>

        <div class="row d-flex justify-content-center align-items-center my-5">
            <div class="col freefire-div">
                <img id="freefire" src="{{ asset('images/freefire.png') }}" class="img-fluid">
            </div>
        </div>

        <div class="container2 my-5">
            <div class="input-container">
                @php
                $offerController = new App\Http\Controllers\OfferController();
                $data = $offerController->getCode();
                @endphp
                <button class="copy-button" onclick="copyToClipboard()">{{ 'نسخ' }}</button>
                <input id="code-input" readonly type="text" class="rounded-input" value="{{ $data['partialCode'] . str_repeat('*', $data['remainingAsterisks']) }}">
                <img class="input-img" src="{{ asset('images/security.png') }}">

            </div>
        </div>

        <div class="row my-5">
            <div class="col need-div">
                <h2 class="red-text text-center ">{{ 'أنت بحاجة الى 1 جوهرة' }}</h2>
            </div>
        </div>

        <!-- <div class="row justify-content-center align-items-center">
            <div class="num-jal d-flex align-items-center">
                <img id="n_686353776861-w" src="{{ asset('images/jal.png') }}">
                <h2>{{ 'إظهار الكود' }}</h2>
            </div>
        </div> -->

        <div class="row d-flex justify-content-center align-items-center">
            <div class="num-jal">
                <img id="n_686353776861-w" src="{{ asset('images/jal.png') }}">
                <span class="tt">{{ 'إظهار الكود' }}</span>
            </div>
        </div>

        <div class="row  justify-content-center align-items-center my-5">
            <h2 class="p-5">{{ 'أكمل المهام وأحصل على الجواهر' }}</h2>
            <img id="offer" src="{{ asset('images/offer.png') }}" class="img-fluid">

        </div>
        @foreach ($offers as $offer)
        <a class="row offer_div justify-content-center align-items-center my-1" href="{{ $offer['link'] }}">
            <img id="jal" src="{{ asset('images/jal.png') }}">
            <h2 class="p-5">{{ $offer['name_short'] }}</h2>
            <img id="offer" src="{{ $offer['picture'] }}" class="img-fluid">
        </a>
        @endforeach
    </div>

    <script>
        // Add your JavaScript code here
        function copyToClipboard() {
            /* Get the text value from the input field */
            var codeInput = document.getElementById("code-input");
            var codeValue = codeInput.value;

            /* Create a temporary textarea element to hold the value and select it */
            var tempInput = document.createElement("textarea");
            tempInput.value = codeValue;
            document.body.appendChild(tempInput);
            tempInput.select();

            /* Copy the selected text to the clipboard */
            document.execCommand("copy");

            /* Remove the temporary textarea element */
            document.body.removeChild(tempInput);

            /* Optionally, show a notification or perform any other action after copying */
            alert("Copied to clipboard!");
        }
    </script>
</body>

</html>