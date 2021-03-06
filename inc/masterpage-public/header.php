<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link type="text/css" href="./../resources/bootstrap-4-1-1-dist/css/bootstrap.min.css" rel="stylesheet">

    <!--My CSS-->
    <link type="text/css" href="./../resources/font-awesome-4-7-0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript" src="./../resources/bootstrap-4-1-1-dist/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="./../resources/bootstrap-4-1-1-dist/js/bootstrap.bundle.min.js"></script>

    <title>Webware</title>
</head>

<body>
    <!--body container-->
    <div>
        <nav class="navbar navbar-expand-md bg-primary navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="./../public/index.php?index">Webware</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar2SupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse text-center justify-content-end" id="navbar2SupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link <?php if(isset($_GET['index'])) echo 'active'; ?>" href="./../public/index.php?index">
                                <i class="fa fa-home"></i> Início</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if(isset($_GET['about'])) echo 'active'; ?>" href="./../public/about.php?about">
                                <i class="fa fa-drivers-license-o"></i> Acerca</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if(isset($_GET['contacts'])) echo 'active'; ?>" href="./../public/contacts.php?contacts">
                                <i class="fa fa-envelope"></i> Contactos</a>
                        </li>
                    </ul>
                    <a class="btn navbar-btn btn-dark ml-2 text-white" href="./../public/sign-in.php">
                        <i class="fa fa-sign-in"></i> Entrar</a>
                    <a class="btn navbar-btn btn-dark ml-2 text-white" href="./../public/sign-up.php">
                        <i class="fa fa-user-plus"></i> Registar</a>
                </div>
            </div>
        </nav>