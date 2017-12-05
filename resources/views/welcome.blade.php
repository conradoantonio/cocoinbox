<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login</title>
        <link rel="shortcut icon" href="{{ asset('img/favicon24x24.png')}}" />
        <link rel="stylesheet" href="{{ asset('plugins/pace/pace-theme-flash.css')}}"  type="text/css" media="screen"/>
        <link rel="stylesheet" href="{{ asset('plugins/boostrapv3/css/bootstrap.min.css')}}"  type="text/css"/>
        <link rel="stylesheet" href="{{ asset('css/style.css')}}" type="text/css"/>
        <style type="text/css">
        /* Change the white to any color ;) */
        input:-webkit-autofill {
            -webkit-box-shadow: 0 0 0px 1000px white inset !important;
        }
        @font-face {
            font-family: "Gandhi Sans";
            src: url({{url('')}}/fonts/GandhiSans-BoldItalic-webfont.woff) format("woff");
        }
        .body-login {
            background: url('{{url('')}}/img/bg_login.png');
            background-size: 100% 100%;
            background-repeat: no-repeat;
        }
        input::placeholder, h1.login-header {
            font-family: "Gandhi Sans"!important;
            color: #F7BF8E!important;
            font-size: 20px;
        }
        input:focus{
            border: 0;
            outline: 0;
            background-color: transparent!important;

            border-bottom: 2px solid #F29100!important;
        }
        input[type="text"], input[type="password"] {
            font-size:20px;
            font-family: "Gandhi Sans"!important;
            color: #F7BF8E!important;
        }
        h1.login-header {
            color: #f09024!important;
            font-size: 5em;
            padding-top: 1.7em;
            padding-bottom: 1.2em;
        }
        input.form-control {
            background-color: transparent;
            border: 0;
            outline: 0;
            border-bottom: 2px solid #F29100;
        }
        button{
            margin-top: 2.5em;
            font-style: italic;
            font-weight: bold;
            width: 260px;
            border: none;
            background: #CE181A;
            color: #f2f2f2;
            padding: 10px;
            font-size: 18px;
            position: relative;
            box-sizing: border-box;
            transition: all 500ms ease;
        }
        button:hover {
            cursor: pointer;
            background: rgba(0,0,0,0);
            color: #CE181A;
            box-shadow: inset 0 0 0 3px #CE181A;
        }
        .show-error{
            font-size: 12px;
            color: maroon;
            display: block;
            margin-top: 2%;
            margin-bottom: 3%;
        }
        </style>
    </head>
    <body class="body-login">
        <div class="">
            <div class="col-lg-6 text-center">
                <div class="col-xs-12 col-sm-8 col-sm-push-2 col-sm-pull-2 col col-md-8 col-md-push-2 col-md-pull-2">
                    <div class="p-t-20 p-l-15 p-r-15 p-b-30">
                        <h1 class="login-header">Bienvenido</h1>
                        <form class="m-t-30 m-l-15 m-r-15" method="POST" action="login" autocomplete="off">
                            {!! csrf_field() !!}
                            <div class="form-group {{ $errors->has('user') || $errors->has('status') ? ' error' : '' }}">
                                <div class="controls">
                                    <input type="text" class="form-control" id="user" name="user" value="{{ @session('account') ? session('account') : '' }}" placeholder="Usuario">
                                    @if ($errors->has('user'))
                                        <span class="show-error">
                                            <strong>{{ $errors->first('user') }}</strong>
                                        </span>
                                    @endif
                                    @if ($errors->has('status'))
                                        <span class="show-error">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="controls">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                                </div>
                                @if ($errors->has('password'))
                                    <span class="show-error">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button class="" type="submit">INGRESAR</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('js/jquery.js') }}"></script>
        <script src="{{ asset('js/sweetalert.min.js') }}"></script>
        <script src="{{ asset('plugins/boostrapv3/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/pace/pace.min.js') }}" type="text/javascript"></script>
    </body>
</html>
