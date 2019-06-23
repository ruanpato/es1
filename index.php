<?php
    if (!isset($_SESSION)) {//Verificar se a sessão não já está aberta.
        session_unset();
    }
?>
<!DOCTYPE html>
<html lang="br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- Bootstrap 4 CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
        <link rel="icon" href="cat_logo.png">
        <title>Bem vindo</title>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-md bg-primary navbar-light">
            <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="cat_logo.png" alt="Logo" style="width:30px;">
            </a>
            <div id="navbarsExample04" class="collapse navbar-collapse">    
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="login.php" class="btn btn-primary" role="button" aria-pressed="true">Entrar</a>
                    </li>
                    <li class="nav-item">
                        <a href="registro.php" class="btn btn-secondary" role="button" aria-pressed="true">Registrar-se</a>
                    </li>
                </ul>
            </div>
            </div>
        </nav>
        <!-- /Navbar -->
    </head>
    <body>
    </body>
</html>
</html>