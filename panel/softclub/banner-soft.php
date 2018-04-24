<header>
  <a href="index.php" id="logo-soft"><img src="images/Logo2.png"></a>
    <nav id=navi-soft>
      <ul id="menu-soft">
        <li><a href="recentes.php">Recentes</a></li>
        <li><a href="#">Populares</a></li>
        <li><a href="novo.php">Novo</a></li>
        <li><a href="http://developersfactoryx.com">Developers</a></li>
        <?php $usuario = $_SESSION['user_session'];?>
        <li></li>
        <a href="http://developersfactoryx.com/panel/perfil.php"><button class="user-soft"><?=$usuario?> &#9660;<br><button id="logout-soft">&nbsp;&nbsp;&nbsp;<a href="?go=sair">&nbsp;&nbsp;&nbsp;Logout</a></button></button></a>
        <li></li>
      </ul>
    </nav>
</header>

<?php
  if(@$_GET['go'] == 'sair') {
    unset($_SESSION['user_session']);
    unset($_SESSION['password_session']);
    echo "<meta http-equiv='refresh' content='0, http://developersfactoryx.com'>";
  }
?>