<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Custom Bikes</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script lang="javascript">
        $(function() {
            $("#searchButton").prop("disabled",true);

            $("#searchInput").keypress(function () {
                if ($(this).val()) {
                    $("#searchButton").prop("disabled",false);
                } else {
                    $("#searchButton").prop("disabled",true);
                }
            });
        });
    </script>
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Custom Bikes</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <!--<li class="active"><a href="#">About <span class="sr-only">(current)</span></a></li>-->
                    <li><a href="/about">About</a></li>
                </ul>
                <form class="navbar-form navbar-right" role="search" action="/search" method="get">
                    <div class="form-group">
                        <input type="text" class="form-control" name="q" id="searchInput" placeholder="What are you looking for?">
                        <button type="submit" class="btn btn-default" id="searchButton">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </nav>