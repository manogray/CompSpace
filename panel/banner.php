<?php
  session_start();
  mysql_connect('database_devx.mysql.dbaas.com.br','database_devx','luis1995');
  mysql_select_db('database_devx');
  mysql_set_charset('utf8');

  if(!isset($_SESSION['user_session']) && !isset($_SESSION['password_session'])) {
    echo "<meta http-equiv='refresh' content='0, url=../'>";
  }
?>

<script type="text/javascript" src="http://code.jquery.com/jquery-3.2.1.js"></script>

<header>
    <nav id="navi">
      <a href="../../panel/home.php"><img style="width: 150px; height: auto; margin-top: 0.4%;" src="../../panel/images/Logo1.png"></a>
      <ul id="menu">
        <li><a href="../../panel/sobre.php">Sobre</a></li>
        <li><a href="../../panel/aulas">Aulas</a></li>
        <li><a href="../../panel/temas">Temas</a></li>
        <li><a href="../../panel/books.php">Dev.lib</a></li>
        <li><a href="#">Codes</a></li>
        <?php 
        	$usuario = $_SESSION['user_session'];
        	$resDUser = mysql_query("SELECT * FROM tb_usuarios WHERE nickmane = '$usuario'");
        	$dadosUser = mysql_fetch_assoc($resDUser);
        ?>
        <li>&nbsp;</li>
        <div id="user" style="background: url(../../panel/users/<?=$usuario?>/<?=$dadosUser['perfil']?>); background-size: cover; background-position: center center;">
          <div id="sub-user">
            <div class="sub-opcao-user"><a href="../../panel/perfil.php" style="color: inherit; text-decoration: none; margin-left: 7%;">Configurações</a></div>
            <div class="sub-opcao-user"><a href="../../panel/desktop.php" style="color: inherit; text-decoration: none; margin-left: 7%;">Organizador</a></div>
            <div class="sub-opcao-user"><a href="?go=sair" style="color: inherit; text-decoration: none; margin-left: 7%;">Logout</a></div>
          </div>
        </div>
      </ul>
    </nav>
</header>

<?php
  if(@$_GET['go'] == 'sair') {
    unset($_SESSION['user_session']);
    unset($_SESSION['password_session']);
    $up = mysql_query("UPDATE tb_usuarios SET status='off' WHERE BINARY nickmane = '$usuario'");
    echo "<meta http-equiv='refresh' content='0, ../'>";
  }
?>
