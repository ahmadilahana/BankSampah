<!DOCTYPE html>
<html>

<head>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        /* Float four columns side by side */
        .column {
            float: left;
            width: 50%;
            padding: 0 10px;
        }

        /* Remove extra left and right margins, due to padding in columns */
        .row {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            margin: 0 -5px;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Style the counter cards */
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            /* this adds the "card" effect */
            padding: 16px;
            text-align: center;
            background-color: #f1f1f1;
        }

        /* Responsive columns - one column layout (vertical) on small screens */
        @media screen and (max-width: 600px) {
            .column {
                width: 100%;
                display: block;
                margin-bottom: 20px;
            }
        }

        .button {
            display: inline-block;
            border-radius: 4px;
            background-color: #f4511e;
            border: none;
            color: #FFFFFF;
            text-align: center;
            font-size: 20px;
            padding: 10px;
            width: 200px;
            transition: all 0.5s;
            cursor: pointer;
            margin: 5px;
        }

        .button span {
            cursor: pointer;
            display: inline-block;
            position: relative;
            transition: 0.5s;
        }

        .button span:after {
            content: '\00bb';
            position: absolute;
            opacity: 0;
            top: 0;
            right: -20px;
            transition: 0.5s;
        }

        .button:hover span {
            padding-right: 25px;
        }

        .button:hover span:after {
            opacity: 1;
            right: 0;
        }

    </style>
</head>

<body>

    <div class="row">
        <div class="column">
            <div class="card">
                <h3>Reset Password</h3>
                <p>untuk melakukan reset password silahkan klik link dibawah</p>
                <p><a href="{{ url('/'.$token.'/reset_password') }}">{{ url('/'.$token.'/reset_password') }}</a></p>
                <p>atau</p>
                <a href={{url('/'.$token.'/reset_password')}} style="text-decoration: none; color:white;">
                    <button class="button" style="vertical-align:middle"><span>Click Here </span>
                </a>
            </div>
        </div>
    </div>
    </div>

</body>

</html>
