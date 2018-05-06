<?php
  mysql_connect('database_devx.mysql.dbaas.com.br','database_devx','luis1995');
  mysql_select_db('database_devx');

  session_start();
  if(!isset($_SESSION['user_session']) && !isset($_SESSION['password_session'])) {
?>

<!DOCTYPE html>
<html>
  <?php include("panel/head.php"); ?>
  <title>Login</title>
  <body style="background: url(panel/images/background4.jpg); background-size: 100%;">

    <section>
    <div style="margin-left: 30%; margin-right: 30%; background: rgba(255,255,255,0.19); border-radius: 3px;">
    <h2>Developers Factory X</h2>
      
    <form method="post" class="login">
      <table id="login_table">
        <tr>
          <td><input type="text" name="nick" placeholder="Login" maxlength="50" class="inputDev" autofocus></td>
        </tr>
        <tr>
          <td><input type="password" name="senha" placeholder="Senha" maxlength="15" class="inputDev"></td>
        </tr>
        <tr>
          <td><input type="submit" value="Entrar" class="botaoDev" style="padding: 3%;"> &nbsp;<a href="cadastro.php"><input type="button" value="Registre-se" class="botaoDev" style="padding: 3%;"></a></td>
        </tr>
        <tr>
          <td><input type="hidden" name="acao" value="enviado"></td>
        </tr>
      
      <?php
        }else {
    	  echo "<meta http-equiv='refresh' content='0, url=panel/home.php'>";
        }
      ?>  
        
      <?php
      	if(isset($_POST['acao']) && $_POST['acao'] == 'enviado') {
          $nick = $_POST['nick'];
          $senha = $_POST['senha'];
          
          if(empty($nick) || empty($senha)) {
            echo "<script>alert('Preencha todos os campos!'); history.back();</script>";
          } else {
            $query1 = mysql_num_rows(mysql_query("SELECT * FROM tb_usuarios WHERE BINARY nickmane = '$nick' AND BINARY senha = '$senha'"));
            $query3 = mysql_num_rows(mysql_query("SELECT * FROM tb_usuarios WHERE BINARY email = '$nick' AND BINARY senha = '$senha'"));
            $query4 = sprintf("SELECT nickmane FROM tb_usuarios WHERE BINARY nickmane = '$nick' OR BINARY email = '$nick'");
            $result4 = mysql_query($query4);
            $row4 = mysql_fetch_assoc($result4);
            if (($query1 == 1) || ($query3 == 1)) {
              $_SESSION['user_session'] = $row4['nickmane'];
              $nomeee = $row4['nickmane'];
              $_SESSION['password_session'] = $senha;
              $up = mysql_query("UPDATE tb_usuarios SET status='on' WHERE BINARY nickmane = '$nomeee'");
              echo "<meta http-equiv='refresh' content='0, url=panel/home.php'>";
            } else {
              echo "<script>alert('Não foi possível fazer o login!'); </script>";
            }
          }
        }
          
      ?>
      </table>
    </form>  
    </div>
    </section>
    
  </body>
</html>