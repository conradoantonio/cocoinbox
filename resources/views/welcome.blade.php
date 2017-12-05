<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login</title>

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
            src: url(../fonts/GandhiSans-BoldItalic-webfont.woff) format("woff");
        }
        .body-login{
            background: url('../img/bg_login.png');
            background-size: 100% 100%;
            background-repeat: no-repeat;
        }
        input::placeholder, h1.login-header {
            font-family: "Gandhi Sans"!important;
            color: #f09024!important;
        }
        h1.login-header{
            font-size: 5em;
            padding-top: 2.5em;
        }
        input.form-control{
            border: 0;
            outline: 0;
            border-bottom: 2px solid #F29100;
        }
        button{
            border: none;
            background: #3a7999;
            color: #f2f2f2;
            padding: 10px;
            font-size: 18px;
            border-radius: 5px;
            position: relative;
            box-sizing: border-box;
            transition: all 500ms ease;
        }
        button:hover {
            cursor: pointer;
            background: rgba(0,0,0,0);
            color: #3a7999;
            box-shadow: inset 0 0 0 3px #3a7999;
        }
        </style>
    </head>
    <body class="body-login">
        <div class="">
            <div class="col-lg-6 text-center">
                <div class="col-xs-12 col-sm-8 col-sm-push-2 col-sm-pull-2 col col-md-6 col-md-push-3 col-md-pull-3">
                    <div class="tiles white p-t-20 p-l-15 p-r-15 p-b-30">
                        <h1 class="login-header">Bienvenido</h1>
                        <form class="m-t-30 m-l-15 m-r-15" method="POST" action="login" autocomplete="off">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <div class="controls">
                                    <input type="text" class="form-control" id="user" name="user" placeholder="Usuario">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="controls">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                                </div>
                            </div>
                            <button class="" type="submit">Ingresar</button>
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
