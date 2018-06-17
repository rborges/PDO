<?php

use FRAMEWORK\Model\Config;

$loggin = Config::isLoggedIn();

if ($loggin)
{
    $usuario = $_SESSION['nome'];
}
?>

<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title> <?= $this->titulo ?></title>

        <!-- Bootstrap Core CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="assets/css/thumbnail-gallery.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Alfamídia</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li class="dropdown">
                        <li><a href="clientes">Clientes</a></li>

                    </ul>



                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#" class="btn btn-info btn-lg saleoffrate cart"  data-toggle="modal" data-target="#modal-cart">
                                <span class="glyphicon glyphicon-shopping-cart"></span>
                            </a>
                        </li>
                        <?php if ($loggin): ?>
                            <li class="dropdown">
                                <p>
                                    Olá, <?php echo $usuario ?></b> | <a id="logout" href="">Sair</a>
                                </p>
                                </div>
                            </li>
                        <?php else: ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
                                <ul id="login-dp" class="dropdown-menu">
                                    <li>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form class="form" role="form" method="post"  accept-charset="UTF-8" id="login-nav">
                                                    <div class="form-group">
                                                        <label class="sr-only" for="email">Email</label>
                                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="sr-only" for="senha">Senha</label>
                                                        <input type="password" class="form-control" name="senha" id="senha" placeholder="Password" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" id="login" class="btn btn-primary btn-block">Entrar</button>
                                                    </div>

                                                </form>

                                            </div>
                                            <div class="bottom text-center">
                                                Novo aqui? <a href="login"><b>Cadastre-se</b></a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>

                </div>
                <!-- /.navbar-collapse -->


            </div>
            <!-- /.container -->
        </nav>

        <!-- Page Content -->
        <div class="container">

            <div class="row">

                <?php
                $this->content();
                ?>
            </div>

            <hr>

            <!-- Footer -->
            <footer>
                <div class="row">
                    <div class="col-lg-12">
                        <p>Copyright &copy; rodrigo.oborges@gmail.com <?= date('Y') ?></p>
                    </div>
                </div>
            </footer>
            <div class="modal fade" id="modal-cart" role="dialog">
                <div class="modal-dialog modal-lg">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Minhas Compras</h4>
                            <div class="mensagem-cart"></div>
                        </div>
                        <div class="modal-body">
                            <?php include "www/home/grid.php"; ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container -->

        <!-- jQuery -->
        <script src="assets/js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/custom.js"></script>
    </body>


</html>
