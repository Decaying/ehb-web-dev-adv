<?php
    $auth = $serviceFactory->getAuthenticationManager();

    function navLink($descr, $controller = null, $action = null, $class = null, $displayAsListItem = true) {
        if (isActivePage($controller, $action)) {
            if ($class !== null)
                $class .= ' ';
            $class .= 'active';
        }

        if ($displayAsListItem)
            echo '<li'. addClassAttrWhen($displayAsListItem, $class). '>';

        echo '<a ' . addClassAttrWhen(!$displayAsListItem, $class) . 'href="' . asLink($controller, $action) . '">' . $descr . '</a></li>';
    }

    function isActivePage($controller, $action) {
        global $controllerName;
        global $viewName;

        $controller = $controller === null ? DEFAULT_CONTROLLER : $controller;
        $action = $action === null ? DEFAULT_ACTION : $action;

        return $controller === $controllerName && $action === $viewName;
    }

    function asLink($controller = null, $action = null) {
        $link = SITE_ROOT . '/';

        if ($controller !== null)
        {
            $link .= $controller;

            if ($action !== null) {
                $link .= '/' . $action;
            }
        }

        return $link;
    }

    function addClassAttrWhen($when, $class) {
        if ($when && $class !== null)
            return ' class="' . $class . '" ';
        else
            return ' ';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Custom Bikes</title>

    <link href="<?php echo SITE_ROOT; ?>/css/index.css" rel="stylesheet">

    <link rel="icon" href="<?php echo SITE_ROOT; ?>/favicon.ico">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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
                <?php navLink('Custom Bikes', null, null, "navbar-brand", false); ?>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php
                    navLink('Overview', 'bikes');
                    if ($auth->isUserLoggedIn()) {
                        navLink('Contact', 'contact');
                        navLink('Logout', 'login', 'logout');

                        $user = $auth->getUser();
                        if ($user !== null && $user->isAdmin()){
                            navLink('Admin', 'manage');
                        }
                    } else {
                        navLink('Login', 'login');
                        navLink('Register', 'login', 'register');
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