<?php
include("conexao.php");
//declarando a vairavel
$count_button = $_GET['count_button'] ?? '';
$estado = $_GET['estado'] ?? '';
$estadoDesligado = $_GET['estadoDesligado'] ?? '';
$estadoMaquina = $_GET['estadoMaquina'] ?? '';
$tempo = $_GET['tempo'] ?? '';
$tempo_ligado = $_GET['tempo_ligado'] ?? '';
$tempo_desligado = $_GET['tempo_desligado'] ?? '';
//preparando para enviar
$sql = "INSERT INTO thdados (count_button,estado,estadoDesligado,estadoMaquina, tempo, tempo_ligado, tempo_desligado) VALUES (:count_button, :estado, :estadoDesligado, :estadoMaquina, :tempo, :tempo_ligado, :tempo_desligado)";

$stmt = $PDO->prepare($sql);

$stmt->bindParam(':count_button', $count_button);
$stmt->bindParam(':estado', $estado);
$stmt->bindParam(':estadoDesligado', $estadoDesligado);
$stmt->bindParam(':estadoMaquina', $estadoMaquina);
$stmt->bindParam(':tempo', $tempo);
$stmt->bindParam(':tempo_ligado', $tempo_ligado);
$stmt->bindParam(':tempo_desligado', $tempo_desligado);

//verificar se foi salvo
if($stmt->execute()){
	echo "salvo_com_sucesso";

}else{
	echo "erro_ao_salvar";
}
?>
