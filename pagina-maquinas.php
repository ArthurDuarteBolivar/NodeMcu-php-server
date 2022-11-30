<?php
    include('verifica_login.php'); 
?>
<!DOCTYPE html>
<html>
    
<head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pagina de Maquinas</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<style>
    .maquinas{
  display: flex;
  border: 1px solid black;
  box-shadow: 0 6px 6px -2px #989898;
  flex-direction: column;
  margin: 10px;
  margin-top: 10px;
  margin-right: 900px;
  padding: 10px;
  
}
@media only screen and (max-device-width: 900px) {
    .widht{
      min-width: 300px;
    }
  }
h2{
  border-bottom: 1px solid black;
}
</style>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light p-2">
  <a class="navbar-brand" href="pagina-maquinas.php">Painel de Maquinas</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <button>
        <a class="nav-link" href="logout.php">Sair</a>
        </button>
      </li>
    </ul>
  </div>
</nav>
<p>Seja Bem vindo, <?php echo $_SESSION['usuario'];?></p>
<a class="text-decoration-none" href="index.php">
<div class="maquinas  d-block widht  ">
  <h2>Máquina 1</h2>
  <p>fabricação de componentes</p>

    <?php
  include("conexaonova.php");
  $sql = "SELECT * from thdados ORDER BY id DESC LIMIT 1";
  $con =  $mysqli->query($sql);
  foreach($con as $data)
  {
    $estado = $data['estado'];
    $tempo = $data['tempo'];
    $count_button = $data['count_button'];
    $datas = $data['data'];
  }
if($estado == 1){
  $maquinaEstado = "Desligado";
}else{
  $maquinaEstado = "Ligado";
}
  ?>
 <button class="btn btn-secondary"><?php echo $maquinaEstado?></button>
</div>
</a>
<footer class="text-center text-white fixed-bottom" style="background-color: #21081a;">
  <!-- Grid container -->
  <div class="container p-4"></div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2022 Copyright:
    <a class="text-white" href="#">Arthur Duarte</a>
  </div>
  <!-- Copyright -->
</footer>
<script  src="https://code.jquery.com/jquery-3.3.1.slim.min.js"  integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"  crossorigin="anonymous"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"  integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"  crossorigin="anonymous"></script>
<script  src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"  integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"  crossorigin="anonymous"></script>
</body>

</html>





