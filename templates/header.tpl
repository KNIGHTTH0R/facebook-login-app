<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Bernhard Wendel">
    <link rel="icon" href="/favicon.ico">

    <title>Facebook-Login-Test-App</title>

    <!-- Bootstrap core CSS -->
    <link href="/bower_components/bootstrap/dist/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/static/jumbotron-narrow.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="header clearfix">
			{if $logout}
            <nav>
                <ul class="nav nav-pills pull-right">
                    <!-- <li role="presentation" class="active"><a href="/">Home</a></li> -->
                    <li role="presentation"><a href="/logout.php">Logout</a></li>
                </ul>
            </nav>
			{/if}
            <h3 class="text-muted">Login-App</h3>
        </div>
