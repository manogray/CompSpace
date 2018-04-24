<?php
session_start();
require_once("config.php");
require_once("functions.php");

//Pega o nome e a sala que o usuário soliciou entrar
$nome = isset($_POST["txtNome"])?strip_tags($_POST["txtNome"]):"";
$sala = isset($_POST["slSala"])?(int)$_POST["slSala"]:1;

//Se o nome não estiver em branco, executa uma rotina de limpeza delete_olde_entries() e inicia o chat.
if(!empty($nome)){
    delete_old_entries();
    start_chat();
}


?>
<html>
<head>
<title>Chat</title>
<style>
.tab{
    background-color:#000;
    color:#FFF;
    font-size:12px;
    font-weight:bold;
    padding:4px;
}
</style>
</head>
<body>
<div style="text-align:center">

<h1>Chat Online</h1>

<hr />

Escolha um Nickname e a Sala

<form action="index.php" method="post">
<table width="200" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td width="70" class="tab">Nome</td>
    <td width="130">
        <input type="text" name="txtNome" id="txtNome" />
    </td>
   </tr>
  <tr>
    <td class="tab">Sala</td>
    <td>
    <select name="slSala">
    <?php
    //Lista todas as salas cadastradas no banco de dados
    $tbSala = $conn->prepare("select * from salas");
    $tbSala->execute();
    while($linha=$tbSala->fetch(PDO::FETCH_ASSOC)){
        echo "<option value='$linha[id_sala]'>$linha[nm_sala]</option>";
    }
    ?>
    </select>
    </td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><label>
      <input type="submit" name="btnEntrar" id="btnEntrar" value="Entrar" />
    </label></td>
    </tr>
</table>
</form>


</div>
</body>
</html>
