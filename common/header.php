<!doctype html>
<html class="no-js" lang="">

    <head>
        <meta charset="utf-8">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="manifest" href="<?php echo $path; ?>../site.webmanifest">
        <link rel="apple-touch-icon" href="icon.png">
        <link rel="stylesheet" href="<?php echo $path; ?>../assets/css/normalize.css">
        <link rel="stylesheet" href="<?php echo $path; ?>../node_modules/@fortawesome/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css">
        <link rel="stylesheet" href="<?php echo $path; ?>../assets/css/main.css">
        <meta name="theme-color" content="#fafafa">
    </head>

    <body>
        <!--[if IE]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
      <![endif]-->

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="<?php echo $path; ?>../index.php">
                <img src="<?php echo $path; ?>../assets/img/reciclagem.png" width="30" height="30" class="d-inline-block align-top" alt="">
                Waste Online</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $path; ?>../pages/grupos.php">Grupos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $path; ?>../pages/users.php">Usuários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $path; ?>../pages/pontuacao.php">Pontuação</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $path; ?>../pages/fechamento.php">Encerrar Arrecadação</a>
                    </li>
                </ul>
            </div>
        </nav>
