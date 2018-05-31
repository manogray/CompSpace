<?php
  require_once("class/conexaoCSdb.php");

  session_start();
  if(isset($_SESSION['UsuarioLogado'])) {
    echo "<meta http-equiv='refresh' content='0, url=panel/home.php'>";
  }
?>

<!DOCTYPE html>
<html>
  <?php include("panel/head.php"); ?>
  <title>Login</title>
  <body style="background: url(panel/images/background4.jpg); background-size: 100%;">

    <section>
    <div class="cardLogin">
    <img src="panel/images/Logo1.png" class="logoLogin">
      
    <form method="post" class="Login" action="validacao/loginFunc.php">
      <div class="contentLogin">
          <input type="text" name="nick" placeholder="Login" maxlength="50" class="inputDev" autofocus>
          <input type="password" name="senha" placeholder="Senha" maxlength="15" class="inputDev">
          
          <input type="hidden" name="acao" value="enviado">
      </div>
      <div class="painelBotaoLogin">
            <input type="submit" value="Entrar" class="botaoDev" style="padding: 6px 64px;">
            <a href="cadastro.php" class="linkDev">Cadastre-se</a>
      </div>
    </form>  
    </div>
    </section>
    
  </body>
</html>