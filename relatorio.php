<?php
ob_start();
session_start();
require_once 'dbconnect.php';

$select_sql = "SELECT Relatorio.fk_id_agendamento, Relatorio.descricao_relatorio, Animal.nome_animal, Usuario.nome_usuario, Animal.especie_animal, Animal.raca_animal, Agendamento.valor_agendamento, Agendamento.status_agendamento FROM Relatorio INNER JOIN Agendamento ON Relatorio.fk_id_agendamento=Agendamento.id_agendamento  INNER JOIN Animal ON Agendamento.fk_id_animal=Animal.id_animal INNER JOIN Usuario ON Animal.fk_cpf_dono=Usuario.cpf_usuario WHERE Relatorio.fk_id_agendamento=".$_SESSION['register_selected'];
if($aux = mysqli_query($conn, $select_sql)->fetch_array()){
    
}
?>
<!DOCTYPE html>
<html lang="br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="cat_logo.png">
    <title>Atendimento</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>

</head>
<body>
   <!-- Nav -->
   <nav class="navbar navbar-expand-lg bg-primary navbar-light">
        <a class="navbar-brand" href="#">
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


      <div class="container mt-5">
    
        <div class="row">
            <div class="col text-center">
                <!-- Primeiro capo -->
                <div class="row mt-4">
                    <div class="col-6">
                        <?php echo "<p>Animal: ".aux['nome_animal']."</p>"; ?>
                    </div>
                    <div class="col-6">
                        <?php echo "<p>Dono: ".aux['nome_usuario']."</p>"; ?>
                    </div>
                </div>
                <!-- Fim primeiro campo -->

                <!-- Inicio segundo campo -->
                <div class="row mt-4">
                    <div class="col-6">
                        <?php echo "<p>Espécie: ".aux['especie_animal']."</p>"; ?>
                    </div>
                    <div class="col-6">
                        <?php echo "<p>Raça: ".aux['raca_animal']."</p>"; ?>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <?php echo "<div class=\"col-8 border-rounded\">".aux['descricao_relatorio']."</div>"; ?>    
                </div>

                <!-- Form começa aqui -->
                <form action="teste.php" method="post">

                <div class="row justify-content-center mt-4">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">Dinheiro</label>
                            <input type="text"
                                class="form-control" name="dinherio" id="" aria-describedby="helpId" placeholder="R$">
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label for="">Status</label>
                                <select class="form-control" name="option-concluido" id="">
                                    <option>Concluido</option>
                                </select>
                        </div>
                    </div>
                </div>
                <!-- Fim da row -->

                <div class="row justify-content-center mt-4 mb-4">
                    <div class="col-9">
                        
                    <label>Descrição da Eleição</label>
                        <textarea class="form-control" cols="20" rows="5" name="descricao" class="form-control" placeholder="O pato é inutil"></textarea>
                    </div>
                </div>

                <!-- Botão -->
                <button action type="button" class="mb-4 btn btn-primary">Enviar</button>

                </form>
            </div>
            
        </div>


    </div>

</body>
</html>