<?php
//Informações para conexão com o banco de dados
$servidor = "database_devx.mysql.dbaas.com.br";
$tipo_servidor = "mysql";
$nome_do_banco = "database_devx";
$usuario = "database_devx";
$senha = "luis1995";

//instancia um objeto da classe PDO chamado $conn
$conn = new PDO("$tipo_servidor:host=$servidor;dbname=$nome_do_banco",$usuario,$senha);

?>
