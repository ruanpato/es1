<?php
$consultas_em_aberto=0;$consultas_concluidas=0;$agendamentos=NULL;
ob_start();
session_start();
require_once 'dbconnect.php';

if (isset($_SESSION)){
    // Consultas Em aberto
    $select_sql = "SELECT COUNT(*) as consultas_em_aberto FROM Agendamento WHERE status_agendamento=\"Em Aberto\" AND fk_cpf_funcionario=".$_SESSION['user'].";";
    if($aux = mysqli_query($conn, $select_sql)->fetch_array()){
        $consultas_em_aberto = $aux['consultas_em_aberto'];
    }
    // Consultas encerradas
    $select_sql = "SELECT COUNT(*) as qtd FROM Agendamento WHERE status_agendamento!=\"Em Aberto\"  AND fk_cpf_funcionario=".$_SESSION['user'].";";
    if($aux = mysqli_query($conn, $select_sql)->fetch_array()){
        $consultas_concluidas = $aux['qtd'];
    }
}else{ // Sessão não está aberta
    header("Location: index.php");
    session_unset();
    header("Location: login.php");
    exit;
}

if (isset($_POST['btn-registro'])) {
    $_SESSION['register_selected']=$_POST['btn-registro'];
    header("Location: relatorio.php");
}
?>

<!DOCTYPE html>
<html lang="br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
    <link rel="icon" href="cat_logo.png">
    <title>Agendamentos</title>
</head>
<body>
    <!-- Nav -->
    <nav class="navbar navbar-expand-lg bg-primary navbar-light">
        <a class="navbar-brand" href="agendamentos.php">
            <img style="width:30px;" src="cat_logo.png"></img>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
          <ul class="navbar-nav mr-auto">
            <!-- Agendamentos -->
            <li class="nav-item">
                <a href="agendamentos.php" class="btn btn-primary" role="button" aria-pressed="true">Agendamentos</a>
            </li>
            <!-- Relatórios -->
            <li class="nav-item">
                <a href="relatorios.php" class="btn btn-primary" role="button" aria-pressed="true">Relatórios</a>
            </li>
            <!-- Perfil -->
            <li class="nav-item">
                <a href="perfil.php" class="btn btn-primary" role="button" aria-pressed="true">Perfil</a>
            </li>
          </ul>

          <div class="inline-block"> 
                <a href="index.php" class="btn btn-danger" role="button" aria-pressed="true">Sair</a>   
            </div>
        </div>
    </nav>
    <!-- Nav -->

    <?php
        echo '<div class="container mt-5"><div class="row mb-5"><div class="col-lg-3 col-md-3 col-sm-3"></div><div class="col-lg-3 col-md-3 col-sm-3"><div class="card bg-success"><div class="card-body">';
        echo 'Consultas em aberto: ';
        echo $consultas_em_aberto;
        echo '</div></div></div>';
        echo '<div class="col-lg-3 col-md-3 col-sm-3"><div class="card bg-info"><div class="card-body">';
        echo 'Consultas fechadas: ';
        echo $consultas_concluidas;
        echo '</div></div></div></div>';
    ?>
    

      <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Data Horário</th>
                    <th>Status</th>
                    <th>Dono</th>
                    <th>Animal</th>
                    <th>Espécie</th>
                </tr>
            </thead>
            <tbody>
                <!-- print lines of agendamento -->
                <?php
                    $select_sql = ("SELECT Agendamento.id_agendamento, Agendamento.data_agendamento, Agendamento.status_agendamento, Usuario.nome_usuario, Animal.nome_animal, Animal.especie_animal FROM Agendamento INNER JOIN Animal ON Agendamento.fk_id_animal=Animal.id_animal INNER JOIN Usuario ON Agendamento.fk_cpf_usuario=Usuario.cpf_usuario WHERE Agendamento.fk_cpf_funcionario=".$_SESSION['user']." ORDER BY Agendamento.data_agendamento DESC");
                    $rows = $conn->query($select_sql);
                    
                    while( $linha = $rows->fetch_array() ){
                        echo "<tr>";
                        echo "<td><button type=\"submit\" method=\"post\" style=\"vertical-align:middle\" name=\"btn-relatorio\" class=\"btn btn-light btn-block btn-lg\"><span>".$linha['id_agendamento']."</span></button></td>";
                        echo "<td>".$linha['data_agendamento']."</td>";
                        echo "<td>".$linha['status_agendamento']."</td>";
                        echo "<td>".$linha['nome_usuario']."</td>";
                        echo "<td>".$linha['nome_animal']."</td>";
                        echo "<td>".$linha['especie_animal']."</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>