<?php
    include('verifica_login.php'); 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Controle de Produção</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
</head>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="https://kit.fontawesome.com/7d97d764a5.js" crossorigin="anonymous"></script>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light p-2">
  <a class="navbar-brand" href="pagina-maquinas.php">Painel de Maquinas</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item">
      <a class="nav-link" href="pagina-maquinas.php">Home</a>
      </li>
      <li class="nav-item">
        <button>
        <a class="nav-link" href="logout.php">Sair</a>
        </button>
      </li>
    </ul>
  </div>
</nav>
<button id="action-btn" class="btn btn-primary m-2"><i><img src="assets/simbolo-de-ferramenta-preenchido-com-filtro.png" width="28.61" height="23.2px " alt=""></i>Filtrar</button>
<script src="script/script.js"></script>
<div id="container">
 <form class="border p-4 m-2" action="" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Data inicial</label>
    <input class="m-2" type="date" name="dataInicial" class="form-control" placeholder="Insira data inicial">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Data Final</label>
    <input class="m-2" type="date"  name="dataFinal" class="form-control"  placeholder="Insira data final">
  </div>
  <input class="btn btn-primary m-2" type="submit" name="submit" value="Buscar">
</form>
</div>

<?php
include("conexaonova.php");
if($_SERVER['REQUEST_METHOD'] == "POST"){
  $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
  $sql = sprintf('SELECT * FROM thdados WHERE data BETWEEN "%s" AND "%s"', $dados['dataInicial'],$dados['dataFinal']);
}else{
  date_default_timezone_set('America/Sao_Paulo');
  $dataLocal = date('Y-m-d ', time());
  $sql = "SELECT * FROM thdados WHERE data LIKE '%" . $dataLocal .  "%'";
}
//$consulta = "SELECT * FROM thdados WHERE data BETWEEN 2022-08-25 AND 2022-08-29";
//$con = $mysqli->query($consulta) or die ($mysqli->error);
$con =  $mysqli->query($sql);
?>

<div class="display_flex">
  <div class="header_table">
    <h5><i class="fas fa-chart-pie" aria-hidden="true"></i>Atividade no Periodo</h5>
<table class="tables">
  <thead class="table-body">
  <tr>
    <td class="table-tr" scope="">data</td>
    <td class="table-tr" scope="">estado</td>
  </tr>
  </thead>
  <?php while($dado = $con->fetch_array()){
$timeStamp = strtotime($dado['data']);
$dataTabela = date('d/m/Y H:i', $timeStamp);
?>

<tbody>
  <tr class="table-body">
    <td class="table-tr" ><?php echo $dataTabela ?></td>
    <td class="table-tr"><?php echo $dado['estadoMaquina'] ?></td>
  </tr> 
  </tbody>
  <?php } ?>
</table>

  </div>
  <div class = "header_graph">
  <div class="header_graph_title">
    <h5><i class="fas fa-chart-pie" aria-hidden="true"></i>Atividade no Periodo</h5>
  </div>
<canvas class=" graph_size border" id="myChart"></canvas>
</div>
  </div>
 
<div class="header_graph_title_format">
  <div class="header_graph_title">
    <h5><i class="fas fa-chart-pie" aria-hidden="true"></i>Atividade no Periodo</h5>
  </div>
  <canvas class="graph "  id="estadoChart"></canvas>
</div>
  </div>
 
  <?php 
 $con =  $mysqli->query($sql);

  foreach($con as $data)
  {
    $tempo = $data['tempo'];
    $tempo_ligado = $data['tempo_ligado'];
    $tempo_desligado = $data['tempo_desligado'];
    $estado[] = $data['estado'];
    $count_button[] = $data['count_button'];
    $datas[] = $data['data'];
    $count_buttons = $data['count_button'];

  }
  if(empty($count_button)){
    $count_button = 0;
  }
  if(empty($estado)){
    $estado = 0;
  }
  if(empty($tempo)){
    $tempo = 0;
  }
  if(empty($tempo_ligado)){
    $tempo_ligado = 0;
  }
  if(empty($tempo_desligado)){
    $tempo_desligado = 0;
  }
?>


  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
  const labels = <?php echo json_encode($datas)?>;

  const data = {
    labels: labels,
    datasets: [{
      label: 'Produção',
      backgroundColor: 'rgb(102, 205, 170)',
      borderColor: 'rgb(127,0,255)',
      data: <?php echo json_encode($count_button) ?>,
    }]
  };

  const config = {
    type: 'bar',
    data: data,
    options: {}
  };
</script>
<script>
  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );

</script>
<?php 
 $con =  $mysqli->query($sql);

  foreach($con as $data)
  {
    $estado[] = $data['estado'];
    $estadoDesligado[] = $data['estadoDesligado'];
    $datas[] = $data['data'];
  }

?>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
  const labelsEstado = <?php echo json_encode($datas)?>;

  const dataEstado = {
    labels: labelsEstado,
    datasets: [{
      label: 'Maquina desligada',
      backgroundColor: 'rgb(30,144,255)',
      borderColor: 'rgb(30,144,255)',
      data: <?php echo json_encode($estadoDesligado) ?>,
      fill: 1,
      barPercentage: 2.0,
      categoryPercentage: 1.0
    },
    {
      label: 'Maquina Ligada',
      backgroundColor: 'rgb(255, 140, 0)',
      borderColor: 'rgb(230, 230, 250)',
      data: <?php echo json_encode($estado) ?>,
      fill: 1,
      barPercentage: 2.0,
      categoryPercentage: 1.0
    }]
  };

  const config2 = {
    type: 'bar',
    data: dataEstado,
    options: {
      legend: false,
      scales:{

        y:{
          beginAtZero: true,
          ticks: {
            display: false
          }
        },
        x: {
          ticks: {
            maxTicksLimit :  6
          }
        }

      }
    }
  };
</script>
<script>
  const estadoChart = new Chart(
    document.getElementById('estadoChart'),
    config2
  );
</script>
<?php
  include("conexaonova.php");
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $sql = sprintf('SELECT SUM(count_button) FROM  thdados WHERE data BETWEEN "%s" AND "%s"', $dados['dataInicial'],$dados['dataFinal']);
  }else{
    $dataAtual = date('Y-m-d');
    $sql = "SELECT SUM(count_button) FROM  thdados WHERE data LIKE '%" . $dataAtual .  "%'";
  }
  $con =  $mysqli->query($sql);
  foreach($con as $data)
  {
    $count_button = $data['SUM(count_button)'];
  }
  $tempo = $tempo/1000;
  $english_format_number = number_format($tempo);
  $tempo_ligado = $tempo_ligado/60;
  $tempo_desligado = $tempo_desligado/60;
  $english_format_numberr = number_format($tempo_desligado);
  $english_format_numberrs = number_format($tempo_ligado);
  ?>
<div class="d-flex m-2 p-2 border">
    <div class="border m-1 p-5 bg-light rounded">
    <i><img src="assets/caixas.png" width="48.61" height="43.2px " alt=""></i>
      <span>Quantidade de ciclos</span>
      <strong class="m-2"><?php echo $english_format_numberrs ?></strong>      
    </div>
    <div class="border m-1 p-5 bg-light rounded">
      <i><img src="assets/relogio (1).png" width="48.61" height="43.2px " alt=""></i>
      <span>Tempo Ligada</span>
      <strong class="m-2"><?php echo $tempo_ligado ?> m</strong>
    </div>
    <div class="border m-1 p-5 bg-light rounded">
      <i><img src="assets/relogio.png" width="48.61" height="43.2px " alt=""></i>
      <span>Tempo Desligada</span>
      <strong class="m-2"><?php echo $english_format_numberr ?> m</strong>
    </div>
    <div class="border m-1 p-5 bg-light rounded">
      <i><img src="assets/caixas.png" width="48.61" height="43.2px " alt=""></i>
      <span>Tempo de produção</span>
      <strong class="m-2"><?php echo $english_format_number ?> s</strong>
      </div>
</div>
<script  src="https://code.jquery.com/jquery-3.3.1.slim.min.js"  integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"  crossorigin="anonymous"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"  integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"  crossorigin="anonymous"></script>
<script  src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"  integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"  crossorigin="anonymous"></script>
  </body>

</html>
