<?php
ob_start();
session_start();
$nome=NULL;$cpf=NULL;$celular=NULL;$data_nascimento=NULL;$email=NULL;$senha=NULL;

function validaCPF($cpf) {
 
    // Extrai somente os números
    $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
     
    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
        
        return false;
    }
    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }
    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf{$c} * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf{$c} != $d) {
            return false;
        }
    }
    return true;
}

/*if (isset($_SESSION['user']) != "") {
    header("Location: index.php");
}*/
include_once 'dbconnect.php';

if (isset($_POST['btn-cadastrar'])) {   // Se o botão foi selecionado
    #$uname = trim($_POST['uname']); // get posted data and remove whitespace
    $nome = trim($_POST['input-nome']);
    $cpf = trim($_POST['input-cpf']);
    $celular = trim($_POST['input-telefone']);
    $data_nascimento = trim($_POST['input-data']);
    $email = trim($_POST['input-email']);
    $senha = trim($_POST['input-senha']);
    $confirma_senha = trim($_POST['input-confirma_senha']);
    #$tipo = default (cliente)
    $tipo_usuario = 'Cliente';
    $erro_cpf=0;
    $erro_email=0;
    // Verifica se as senhas são iguais
    if($senha != $confirma_senha){
        $erro_senha = 1;
        $count_errors = 1;
    }else{
        $erro_senha = 0;
        $count_errors = 0;
    }

    // hash password with SH    A256;
    $senha = hash('sha256', $senha);

    if(validaCPF($cpf)){ // Se o cpf é válido
        // Checa se o cpf já foi cadastrado
        $stmt = $conn->prepare("SELECT cpf_usuario FROM Usuario WHERE cpf_usuario=?");
        $stmt->bind_param("s", $cpf); // Parametro
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if($result->num_rows){
            $erro_cpf = 1; // CPF já foi cadastrado
        }
        $count_errors += $result->num_rows;
    }else{
        $count_errors += 1;
        $erro_cpf = 2;
    }
    // Checa se o email já foi cadastrado
    $stmt = $conn->prepare("SELECT email_usuario FROM Usuario WHERE email_usuario=?");
    $stmt->bind_param("s", $email); // Parametro
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    if($result->num_rows){
        $erro_email  = 1; // email já foi cadastrado
    }   
    $count_errors += $result->num_rows;

    if ($count_errors == 0) { // if email is
        $stmts = $conn->prepare("INSERT INTO Usuario(cpf_usuario, data_nascimento_usuario, email_usuario, nome_usuario, senha_usuario, tipo_usuario, telefone_usuario) VALUES(?, ?, ?, ?, ?, ?, ?)");
        $stmts->bind_param("sssssss", $cpf, $data_nascimento, $email, $nome, $senha, $tipo_usuario, $celular);
        $res = $stmts->execute();//get result
        $stmts->close();

        $cpf_usuario = mysqli_insert_id($conn);
        if ($cpf_usuario > 0) {
            $_SESSION['user'] = $cpf_usuario; // set session and redirect to index page
            if (isset($_SESSION['user'])) {
                print_r($_SESSION);
                header("Location: index.php");
                exit;
            }

        } else {
            $errTyp = "Aviso";
            $errMSG = "Ocorreu algum erro, tente novamente";
        }

    }else{
        // Erros de senha
        if($erro_senha == 1){
            $erro_senhas_msg = "As senhas não são iguais.";
        }else{
            $erro_senhas_msg = NULL;
        }
        // Erros de CPF
        if($erro_cpf == 1){ // CPF já cadastrado
            $erro_cpf_msg = "O CPF já foi cadastrado.";
        }else if($erro_cpf == 2){ // CPF inválido
            $erro_cpf_msg = "CPF inválido.";
        }else{ // Sem erro
            $erro_cpf_msg = NULL;
        }
        // Erros de email
        if($erro_email == 1){
            $erro_email_msg = "Email já cadastrado.";
        }else{
            $erro_email_msg = NULL;
        }
    }

}
?>

<!DOCTYPE html>
<html lang="br">
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="icon" href="cat_logo.png">
        <title>Registrar-se</title>

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
                <div class="col-md-4 offset-md-4 form-div registro">
                    <form action="registro.php" method="post">
                        <!-- Logo -->
                        <div class="form-group" center>
                            <a href="index.php">
                                <img src="cat_logo_100.png" alt="Cat logo" id="cat_logo">
                            </a>
                        </div>
                        <h3 class="text-center">Registrar-se</h3>
                        <!--Nome completo-->
                        <div class="form-group">
                            <label for="input-nome">Nome Completo</label>
                            <input type="text" name="input-nome" class="form-control form-control-lg" required value="<?php echo htmlspecialchars($nome); ?>">
                        </div>
                        <!-- Erro CPF -->
                        <?php
                            if (isset($erro_cpf_msg)) {

                                ?>
                                <div class="form-group">
                                    <div class="alert alert-danger">
                                        <span class="glyphicon glyphicon-info-sign"></span> <?php echo $erro_cpf_msg; ?>
                                    </div>
                                </div>
                                <?php
                            }
                        ?>
                        <!--CPF-->
                        <div class="form-group">
                            <label for="input-cpf">CPF</label>
                            <input type="text" name="input-cpf" class="form-control form-control-lg" required value="<?php echo htmlspecialchars($cpf); ?>">
                        </div>
                        <!--Celular-->
                        <div class="form-group">
                            <label for="input-telefone">Celular</label>
                            <input type="number" name="input-telefone" class="form-control form-control-lg" required value="<?php echo htmlspecialchars($celular); ?>">
                        </div>
                        <!--Data-->
                        <div class="form-group">
                            <label for="input-data">Data de nascimento</label>
                            <input type="date" name="input-data" class="form-control form-control-lg" required value="<?php echo htmlspecialchars($data_nascimento); ?>">
                        </div>
                        <!-- Erro Email -->
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
                            <input type="text" name="input-email" class="form-control form-control-lg" required value="<?php echo htmlspecialchars($email); ?>">
                        </div>
                        <!--Senha-->
                        <div class="form-group">
                            <label for="input-senha">Senha</label>
                            <input type="password" name="input-senha" class="form-control form-control-lg" required value="<?php echo htmlspecialchars($senha); ?>">
                        </div>
                        <!--Confirmar senha-->
                        <div class="form-group">
                            <label for="input-confirmar_senha">Confirmar senha</label>
                            <input type="password" name="input-confirma_senha" class="form-control form-control-lg" required value="<?php echo htmlspecialchars($senha); ?>">
                        </div>
                        <!--Botão confirmar cadastro-->
                        <div class="form-group">
                            <button type="submit" name="btn-cadastrar" class="btn btn-primary btn-block btn-lg">Confirmar cadastro</button>
                        </div>
                        <!-- Texto você já possui conta e link -->
                        <p class="text-center">Já possui uma conta ? <a href="login.php">Entrar</a></p>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
</html>