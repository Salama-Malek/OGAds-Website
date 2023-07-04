<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" type="text/css" id="applicationStylesheet" href="{{ asset('bootstrap-4.3.1-dist/css/bootstrap.min.css') }}" />
    <style>
        /* Add your custom CSS styles here */
        .wrap-div {
            flex-wrap: nowrap;

        }

        .container2 {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .input-container {
            display: flex;
            align-items: center;
            background-color: #eaeaea;
            border-radius: 50px;
            padding: 10px;
        }

        .rounded-input {
            width: 100%;
            padding: 10px;
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
            font-size: 16px;
            line-height: 1;
        }

        .input-img {
            margin-right: 10px;
            width: 40px;
            padding-bottom: 40px;
        }


        .row {
            margin-bottom: 20px;

        }

        .col {
            text-align: center;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        span {
            display: block;
        }




        /* Media Queries */
        @media screen and (max-width: 320px) {

            /* Styles for small screens with width 320px or smaller */
            .row.d-flex.justify-content-between.align-items-center {}

            .col {
                flex-basis: 100%;
                max-width: 100%;
                text-align: center;
            }

            img {
                max-width: 50%;
                height: auto;
                margin: 0 auto;
            }

        }

        @media screen and (min-width: 321px) and (max-width: 767px) {

            /* Styles for small screens with width between 321px and 767px */
            .row.d-flex.justify-content-between.align-items-center {}

            .col {
                flex-basis: 50%;
                max-width: 50%;
            }

            img {
                max-width: 100%;
                height: auto;
            }

            #best-customer-experience {
                max-width: 350px !important;
                height: auto;
                margin: 0 auto;
            }
        }

        @media screen and (min-width: 768px) and (max-width: 991px) {

            /* Styles for medium screens */
            .col {
                flex-basis: 33.33%;
            }
        }

        @media screen and (min-width: 992px) {

            /* Styles for large screens and above */
            .col {
                flex-basis: 25%;
            }
        }

        /* Custom style for the second row */
        .row2 {
            display: flex;
            flex-wrap: nowrap;
        }

        /* Custom style for video frame */
        .video-frame {
            position: relative;
            /* overflow: hidden; */
        }

        .video-logo {
            position: absolute;
            bottom: 200px;
            border-radius: 50%;
            /* background-color: rgba(0, 0, 0, 0.5); */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logo_img {
            width: 80px;
        }
    </style>
    <script id="applicationScript" type="text/javascript" src="{{ asset('images/js/part_1.js') }}"></script>
</head>

<body dir="rtl">
    <div class="container">


        <div class="row wrap-div d-flex justify-content-between align-items-center">
            <img id="phone-call" src="{{ asset('images/phone-call.png') }}" srcset="{{ asset('images/phone-call.png') }} 1x, {{ asset('images/phone-call@2x.png') }} 2x">
            <img id="n_686424729144" src="{{ asset('images/n_686424729144.png') }}" srcset="{{ asset('images/n_686424729144.png') }} 1x, {{ asset('images/n_686424729144@2x.png') }} 2x">
            <img id="contract" src="{{ asset('images/contract.png') }}" srcset="{{ asset('images/contract.png') }} 1x, {{ asset('images/contract@2x.png') }} 2x">
        </div>

    </div>


    <div class="container">

        <div class="row row2 d-flex justify-content-around">
            <div class="col">
                <img id="clipboard" src="{{ asset('images/clipboard.png') }}">
                <span>سجل الدخول</span>
            </div>
            <div class="col">
                <img id="flexible" src="{{ asset('images/flexible.png') }}">
                <span>أكمل مهمة واحدة</span>
            </div>
            <div class="col">
                <img id="success" src="{{ asset('images/success.png') }}">
                <span>استمتع بجائزتك</span>
            </div>
        </div>
    </div>
    <form action="{{ route('handleLoginButtonClick') }}" method="POST">
        @csrf
        <div class="container2 my-5">
            <div class="input-container">
                <a href="{{ route('offer.index') }}">

                    <button class="copy-button">تسجيل دخول</button>
                </a>
                <input type="text" class="rounded-input" name="login_input" placeholder="أدخل معرف اللاعب" value="{{ old('login_input') }}">
                @if ($errors->has('login_input'))
                <div class="error">{{ $errors->first('login_input') }}</div>
                @endif
                <img class="input-img" src="{{ asset('images/login.png') }}">
            </div>
        </div>
    </form>
    <div class="container2">

        <div class="row d-flex justify-content-center my-5">
            <img id="best-customer-experience" src="{{ asset('images/best-customer-experience.png') }}">
        </div>
    </div>
    <div class="container my-5">
        <div class="row videos d-flex align-items-center justify-content-center">
            @foreach ($videos as $key => $video)
            <div class="col my-5">
                <div class="video-frame">
                    <div class="video-logo">
                        @if (isset($logos[$key]))
                        <img class="logo_img" src="{{ asset('storage/logos/' . $logos[$key]->image) }}">
                        @endif
                    </div>
                    @php
                    // Extract the YouTube video ID from the stored URL
                    $videoUrl = $video->url;
                    $videoId = getYoutubeVideoIdFromUrl($videoUrl);
                    @endphp
                    <iframe width="70%" height="200px" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
                <img id="stars" src="{{ asset('images/stars.png') }}">
            </div>
            @endforeach
        </div>
    </div>


</body>

</html>