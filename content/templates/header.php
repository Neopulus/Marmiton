<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= App::getInstance()->title ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="./content/templates/css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="./content/templates/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="./content/templates/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation -->
    <nav id="nav" class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="?p=index.home">
                    <img src="./content/img/logo.png" alt="Brand">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse">
                <ul id="menu" class="sf-menu nav navbar-nav menu-left">
                    <li><a href="?p=index.home">Accueil</a></li>
                    <li><a href="?p=recipe.form_add">Ajouter une recette</a></li>
                </ul>
                <div class="sf-menu nav navbar-nav menu-right">
                    <form  method="post" action="?p=recipe.search"  id="searchform">
                        <input  type="text" name="keyword">
                        <input  type="submit" name="submit" value="Search">
                    </form>
                </div>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>