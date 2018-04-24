<?php
  mysql_connect('database_devx.mysql.dbaas.com.br','database_devx','luis1995');
  mysql_select_db('database_devx');

  mysql_set_charset('utf8');
?>

<!DOCTYPE html>
<html>
  <?php
  session_start();
  if(!isset($_SESSION['user_session']) || !isset($_SESSION['password_session'])) {
    echo "<meta http-equiv='refresh' content='0, url=../index.php'>";
  }
?>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../bugchat/css/estiloBUG.css">
  <link rel="icon" href="images/icone.png" type="image/x-icon">
  <link rel="shortcut icon" href="images/icone.png" type="image/x-icon">
  <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
</head>
  <?php
    $user = $_SESSION['user_session'];
  
    $result1 = mysql_query("SELECT * FROM tb_usuarios WHERE nickmane = '$user'");
    $linha1 = mysql_fetch_assoc($result1);
  ?>
  <title>Organizador - DevFacX</title>
  <body class="chatWallpaper">
    
    <aside id="users_online">
      <ul>  
        <li>
          <div><a href="?subjects">Disciplinas</a></div>
        </li>
        <li>
          <div><a>Extracurricular</a></div>
        </li>
      </ul>
    </aside>
    <aside id="menu-lateral">
      <ul>
        <li>
          <a href="desktop.php">
          <div style="display: inline;"><img style="width: 53px; border-radius: 32px;" src="users/<?=$user?>/<?=$linha1['perfil']?>"></div><div style="display: inline; font-size: 122%;"><?=$user?></div></a>
        </li>
        <li>
          <div><a href="home.php">Developers</a></div>
        </li>
        <li>
          <div><a href="perfil.php">Configurações</a></div>
        </li>
        <li>
          <div><a href="?go=sair">Sair</a></div>
          <?php
            if(@$_GET['go'] == 'sair') {
            unset($_SESSION['user_session']);
            unset($_SESSION['password_session']);
            $up = mysql_query("UPDATE tb_usuarios SET status='off' WHERE BINARY nickmane = '$user'");
            echo "<meta http-equiv='refresh' content='0, ../'>";
            }
          ?>
        </li>
      </ul>
    </aside>
    <div style="margin-left: 19%; margin-right: 19%; position: relative;">
      <h2 style="margin-bottom: 5%;">Desktop</h2>
      <?php if(!isset($_GET['subjects'])) {?>
      <?php
      	$favoritos = explode("-",$linha1['favoritos']);
        $indice = 0;
        while($favoritos[$indice] != "") {
          $id = $favoritos[$indice];
          $result2 = mysql_query("SELECT * FROM apostilas WHERE id = '$id'");
          $linha2 = mysql_fetch_assoc($result2);
          do {
      ?>
      <div class="linha-favorito" style="margin-left: 14%; margin-right: 14%; margin-top: 3%; padding: 1%;"><div style="display: inline;"><?=$linha2['nome']?></div><div class="abrir-favorito" style="display: inline; margin-left: 67%; position: absolute; right: 23%;"><a style="color: #00bfff; text-decoration: none;" href="apostilas/<?=$linha2['area']?>/<?=$linha2['diretorio']?>">Abrir</a></div><div class="excluir-favorito" style="display: inline; margin-left: 3%; position: absolute; right: 15%;"><a href="?delete=<?=$indice?>" style="color: red; text-decoration: none;">Excluir</a></div></div>
    <?php
          }while($linha2 = mysql_fetch_assoc($result2));
        $indice = $indice + 1;
        }
      if(!empty($_GET['delete'])) {
        $delete = $_GET['delete'];
        unset($favoritos[$delete]);
        $favor = implode("-", $favoritos);
        mysql_query("UPDATE tb_usuarios SET favoritos = '$favor' WHERE nickmane = '$user'");
        echo "<meta http-equiv='refresh' content='0, url=desktop.php'>";
      }
  
	  }else {
  		$univ = $linha1['universidade'];
  		$curso = $linha1['curso'];
  		$materias = $linha1['materias'];
  		if (empty($univ) || empty($curso)) {
    ?>
      <form method="post">
      Universidade:<input type="text" name="univ"><br><br>
      Curso:<input type="text" name="curso"><br><br>
        <input style="padding: 1%; border-radius: 2px;" type="submit" value="Enviar" name="acao">
      </form>
      <?php
          if($_POST['acao'] == "Enviar") {
            $universidade = $_POST['univ'];
            $cursoo = $_POST['curso'];
            mysql_query("UPDATE tb_usuarios SET universidade = '$universidade', curso = '$cursoo' WHERE nickmane = '$user'");
            echo "<meta http-equiv='refresh' content='0'>";
          }
      ?>
      <?php
        } else {?>
          
      <div style="margin-left: 14%; margin-right: 14%; text-align: center;"><div style="display: inline;"><?=$user?></div><div style="display: inline; margin-left: 6%; margin-right: 6%;"><?=$linha1['curso']?></div><div style="display: inline;"><?=$linha1['universidade']?></div></div>
        <div></div>

      <div style="margin-left: 14%; margin-right: 14%; text-align: center; margin-top: 4%;">
        <?php
          $materias = explode("-",$linha1['materias']);
          $indice2 = 0;
          while($materias[$indice2] != "") {
            $id2 = $materias[$indice2];
            $result3 = mysql_query("SELECT * FROM materias WHERE id = '$id2'");
            $linha3 = mysql_fetch_assoc($result3);
            do {
        ?>
        <div style="display: inline; float: left;"><?=$linha3['codigo']?></div> <div style="display: inline; float: left; margin-left: 5%;"><?=$linha3['nome']?></div><br><br>
        <?php
            }while($linha3 = mysql_fetch_assoc($result3));
            $indice2 = $indice2 + 1;
          }
      ?>
      </div>
      
      <?php
        }
	}
      ?>
    </div>
    <aside id="chats">
    </aside>
    <script src="js/jquery-3.2.1.js"></script>
  </body>
</html>