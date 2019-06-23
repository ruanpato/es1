<!DOCTYPE html>
<html lang="br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <a class="navbar-brand" href="#">
            <img style="width:30px;" src="cat_logo_100.png"></img>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Perfil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="#">Consultas</a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link " href="#">Agendamentos</a>
            </li>
          </ul>

          <div class="inline-block">
                <button class="btn btn-primary">Sair</button>
            </div>
        </div>
      </nav>


      <div class="container mt-5">
    
        <div class="row">
            <div class="col text-center">
                <!-- Primeiro capo -->
                <div class="row mt-4">
                    <div class="col-6">
                        <p>TEXTO 0</p>
                    </div>
                    <div class="col-6">
                        <p>TEXTO 1</p>
                    </div>
                </div>
                <!-- Fim primeiro campo -->

                <!-- Inicio segundo campo -->
                <div class="row mt-4">
                    <div class="col-6">
                        <p>TEXTO 2</p>
                    </div>
                    <div class="col-6">
                        <p>TEXTO 3</p>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-8 border-rounded">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque illo dolore laboriosam necessitatibus dolorem quo ad, praesentium excepturi doloremque ab eum odio quasi laborum aliquam vitae modi veritatis? Deleniti, debitis?
                    </div>
                </div>

                <!-- Form começa aqui -->
                <form action="teste.php" method="post">

                <div class="row justify-content-center mt-4">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">Dinheiro</label>
                            <input type="text"
                                class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label for="">Status</label>

                                <select class="form-control" name="" id="">
                                    <option>Em andamento</option>
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