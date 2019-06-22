<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// if session is set direct to login
if (isset($_SESSION['user'])){
    $select_sql = "SELECT tipo_usuario FROM `Usuario` WHERE cpf_usuario=?".$_SESSION['user'];
    $query = mysql_query($select_sql, $conn);
    if(isset($query)){
        if($query=="Cliente"){
            die('Não foi possível conectar com o banco de dados: ' . mysql_error());
        }
    }else{

    }

    header("Location: login.php");
    exit;
}
if (isset($_POST['btn-entrar'])) {
    $email = $_POST['input-email'];
    $upass = $_POST['input-senha'];

    $password = hash('sha256', $upass); // password hashing using SHA256
    $stmt = $conn->prepare("SELECT email_usuario, senha_usuario FROM `Usuario` WHERE email_usuario= ?");
    $stmt->bind_param("s", $email);
    /* execute query */
    $stmt->execute();
    //get result
    $res = $stmt->get_result();
    $stmt->close();

    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);

    $count = $res->num_rows;
    if ($count == 1 && $row['senha_usuario'] == $password) {
        $_SESSION['user'] = $row['cpf_usuario'];
        header("Location: login.php");
    } elseif ($count == 1) {
        $erro_email_msg = "Senha errada";
    } else $erro_email_msg = "Email não encontrado";
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
        <title>Entrar</title>

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
        <div class="container">
            <div class="row">
                <div class="col-md-4 offset-md-4 form-div login">
                    <form action="login.php" method="post">
                        <!-- Logo -->
                        <div class="form-group" center>
                            <a href="index.php">
                                <img src="cat_logo_100.png" alt="Cat logo" id="cat_logo">
                            </a>
                        </div>
                        <h3 class="text-center">Entrar</h3>
                        <!-- Mensagem de erro -->
                        <?php
                            if (isset($erro_email_msg)) {

                                ?>
                                <div class="form-group">
                                    <div class="alert alert-danger">
                                        <span class="glyphicon glyphicon-info-sign"></span> <?php echo $erro_email_msg; ?>
                                    </div>
                                </div>
                                <?php
                            }
                        ?>
                        <!--Email-->
                        <div class="form-group">
                            <label for="input-email">Email</label>
                            <input type="text" name="input-email" class="form-control form-control-lg" required>
                        </div>
                        <!--Senha-->
                        <div class="form-group">
                            <label for="input-senha">Senha</label>
                            <input type="password" name="input-senha" class="form-control form-control-lg" required>
                        </div>
                        <!--Botão Entrar-->
                        <div class="form-group">
                            <button type="submit" name="btn-entrar" class="btn btn-primary btn-block btn-lg">Entrar</button>
                        </div>

                        <!-- Texto você já possui conta e link -->
                        <p class="text-center">Não possui uma conta ? <a href="registro.php">Registre-se</a></p>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
</html>