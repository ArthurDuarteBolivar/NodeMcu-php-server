<?php
	try{
		$HOST = "localhost";
		$BANCO = "nodemcu";
		$USUARIO = "root";
		$SENHA = "5691";
		$PDO = new PDO("mysql:host=" . $HOST . ";dbname=" . $BANCO . ";charset=utf8", $USUARIO, $SENHA);

	}catch (PDOException $erro){
		echo "Erro de conexao, detalhes: " . $erro->getMessage();
	}