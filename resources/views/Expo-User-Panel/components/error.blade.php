<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ env('APP_NAME') }} | Error</title>
    <style type="text/css">
        * {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        body {
            padding: 0;
            margin: 0;
        }

        #notfound {
            position: relative;
            height: 100vh;
        }

        #notfound .notfound {
            position: absolute;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        .notfound {
            max-width: 520px;
            width: 100%;
            line-height: 1.4;
            text-align: center;
        }

        .notfound .notfound-404 {
            position: relative;
            height: 240px;
        }

        .notfound .notfound-404 h1 {
            font-family: 'Montserrat', sans-serif;
            position: absolute;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            font-size: 252px;
            font-weight: 900;
            margin: 0px;
            color: #262626;
            text-transform: uppercase;
            letter-spacing: -40px;
            margin-left: -20px;
        }

        .notfound .notfound-404 h1>span {
            text-shadow: -8px 0px 0px #fff;
        }

        .notfound .notfound-404 h3 {
            font-family: 'Cabin', sans-serif;
            position: relative;
            font-size: 16px;
            font-weight: 700;
            text-transform: uppercase;
            color: #262626;
            margin: 0px;
            letter-spacing: 3px;
            padding-left: 6px;
        }

        .notfound h2 {
            font-family: 'Cabin', sans-serif;
            font-size: 20px;
            font-weight: 400;
            text-transform: uppercase;
            color: #000;
            margin-top: 0px;
            margin-bottom: 25px;
        }

        .notfound .notfound-404 {
            height: 162px;
        }

        .notfound .notfound-404 h1 {
            font-size: 162px;
            height: 150px;
            line-height: 162px;
        }

        .notfound h2 {
            font-size: 16px;
        }

        button {
            border: 1px solid #000;
            border-radius: 7px;
            outline: none;
            background: #fff;
            padding: 8px 15px;
            transition: 0.3s;
        }

        button:hover {
            background: #000;
            color: #fff;
        }
    </style>
</head>

<body>
    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404">
                <h3>Error Occurred!</h3>
                <h1>
                    @foreach ($err_code as $digit)
                        <span>{{ $digit }}</span>
                    @endforeach
                </h1>
            </div>
            <h2>{{$message }}</h2>
            <button id="back">Return Back</button>
        </div>
    </div>
    <script type="text/javascript">
        let back = document.getElementById("back");
        back.addEventListener("click", function() {
            window.history.back();
        })
    </script>
</body>

</html>
