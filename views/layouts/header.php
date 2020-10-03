<?php

use system\App;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <link href="../../css.css" rel="stylesheet">

    <title><?=$title ?? gethostname()?></title>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
</head>
<body class="d-flex flex-column">
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">GitHub</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/site">Home <span class="sr-only">(current)</span></a>
                </li>
                <?php if (App::getUserId()) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="/home/getrepositories">Search</a>
                </li>
                <? endif;?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
                <?php if (App::getUserId()) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="/site/logout">Выйти(<?=App::getUserLogin()?>)</a>
                </li>
                <? else:?>

                <li class="nav-item">
                    <a class="nav-link" href="/site/signup">Регистрация</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/site/login">Войти</a>
                </li>
                <? endif;?>

            </ul>
            <form class="form-inline my-2 my-lg-0" id="searchGitHub" action="/home/getrepositories" method="get">
                <input name="q" class="form-control mr-sm-2" type="text" id = 'searchGitHub-q' placeholder="Search" aria-label="Search">
                <input type="submit" value="Search" class="btn btn-outline-success my-2 my-sm-0">
            </form>
        </div>
    </nav>
</header>
