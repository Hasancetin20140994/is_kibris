<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="favicon.ico">

        <title>İş Kıbrıs</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- FontAwesome core CSS -->
        <link href="css/font-awesome.min.css" rel="stylesheet">

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/main.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <div id="top-nav" class="clearfix {{ Request::is('/') ? '' : 'white' }}">
            <nav class="navbar navbar-default">
                <div class="container">
                    <div class="logo_area">
                        <a href="/"><img src="img/logo_siyah.png"></a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav nav-left">
                            <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="/">Anasayfa <span class="sr-only">(current)</span></a></li>
                            <li class="{{ Request::is('is_ara') ? 'active' : '' }}"><a href="is_ara">İş Ara</a></li>
                            <li class="{{ Request::is('blog') ? 'active' : '' }}"><a href="blog">Blog</a></li>
                            <li class="{{ Request::is('isverenler') ? 'active' : '' }}"><a href="isverenler">İşverenler</a></li>
                            <li class="{{ Request::is('iletisim') ? 'active' : '' }}"><a href="iletisim">İletişim</a></li>
                        </ul>



                        <ul class="nav navbar-nav navbar-right">
                            <button type="button" class="btn_headers btn_giris_header">Giriş</button>
                            <button type="button" class="btn_headers btn_kayit_header">Kaydol</button>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        
<!--
        <div id="top-nav1" class="clearfix">
            <nav class="navbar navbar-default1">
                <div class="container1">
                    <div class="logo_area">
                        <a href="/"><img src="img/logo_siyah.png"></a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="/">Anasayfa <span class="sr-only">(current)</span></a></li>
                            <li><a href="is_ara">İş Ara</a></li>
                            <li><a href="blog">Blog</a></li>
                            <li><a href="isverenler">İşverenler</a></li>
                            <li><a href="iletisim">İletişim</a></li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <button type="button" class="btn_login1">Giriş</button>
                            <button type="button" class="btn_login2">Kaydol</button>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        -->