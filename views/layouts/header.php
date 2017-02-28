<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Чат</title>
        <link href="/template/css/bootstrap.min.css" rel="stylesheet">
        <link href="/template/css/font-awesome.min.css" rel="stylesheet">
        <link href="/template/css/animate.css" rel="stylesheet">
        <link href="/template/css/main.css" rel="stylesheet">
        <!--[if lt IE 9]>
        <script src="/template/js/html5shiv.js"></script>
        <script src="/template/js/respond.min.js"></script>
        <![endif]-->
        <!-- include Cycle2 -->

    </head><!--/head-->

    <body>
        <header id="header"><!--header-->
            <div class="header_top"><!--header_top-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-4 padding-right">
                            Для добавления и комментирования сообщений выполните вход*
                        </div>
                        <div class="col-sm-6 col-sm-offset-5 padding-right">
                        <div class="row">
                        <div id="error">Авторизируйтесь!</div>
                        </div>
                        </div>
                    </div>
                </div>
            </div><!--/header_top-->

            <div class="header-middle"><!--header-middle-->
                <div class="container">
                    <div class="row">

                        <div class="col-sm-4 col-sm-offset-4 padding-right">

                                <ul class="nav navbar-nav">

                                    <li><a href="http://oauth.vk.com/authorize?client_id=5874138&redirect_uri=http://lightit/&response_type=code" class="vk" data-vk>Вход через ВКонтакте</a></li>
                                    <li><a href="/user/logout/" class="vk">Выход</a></li>
                                </ul>

                        </div>
                    </div>
                </div>
            </div><!--/header-middle-->
        </header><!--/header-->