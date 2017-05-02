<?php
    $userRepository = $serviceFactory->getUserRepository();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Custom Bikes</title>

    <link href="<?php echo SITE_ROOT; ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo SITE_ROOT; ?>/css/index.css" rel="stylesheet">

    <link rel="icon" href="<?php echo SITE_ROOT; ?>/favicon.ico">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="<?php echo SITE_ROOT; ?>/js/index.js" lang="javascript"></script>
</head>
<body>
    <nav class="container navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo SITE_ROOT . "/"; ?>">Custom Bikes</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo SITE_ROOT . "/bikes"; ?>">Overview</a></li>
                    <?php if ($userRepository->isUserLoggedIn()) {
                        echo '<li><a href="' . SITE_ROOT . '/contact">Contact</a></li>';
                    } else {
                        echo '<li><a href="' . SITE_ROOT . '/login">Login</a></li>';
                        echo '<li><a href="' . SITE_ROOT . '/login/register">Register</a></li>';
                    } ?>
                </ul>
                <div class="navbar-right">
                    <form class="navbar-form" role="search" action="<?php echo SITE_ROOT . "/search"; ?>" method="get">
                        <?php echo '<a href="' . SITE_ROOT . '/cart" class="btn btn-success" id="shopping-cart" style="display: none;">'; ?>
                            <span class="glyphicon glyphicon-shopping-cart">
                                <span class="sr-only"># Items</span>
                            </span>
                            <span id="shopping-cart-counter"></span>
                        </a>
                        <div class="form-group">
                            <input type="text" class="form-control" name="q" id="searchInput" placeholder="What are you looking for?">
                            <button type="submit" class="btn btn-default" disabled="disabled" id="searchButton">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="panel panel-success" id="toast-panel" style="display: none;">
            <div class="panel-heading" id="toast-content">
                <span id="toast-text"></span>
                <span class="glyphicon glyphicon-remove pull-right" id="close-toast"></span>
            </div>
        </div>
    </div>