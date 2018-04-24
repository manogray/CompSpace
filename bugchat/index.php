<?php
  mysql_connect('database_devx.mysql.dbaas.com.br','database_devx','luis1995');
  mysql_select_db('database_devx');

  session_start();
  if(!isset($_SESSION['user_session']) && !isset($_SESSION['password_session'])) {
?>

<!DOCTYPE html>
<html>
  <?php include("head-out.php"); ?>
  <title>Login</title>
  <body class="loginWallpaper">

    <section>
    <div style="background-color: rgba(105, 105, 105, 0.6); margin-left: 30%; width: 40%; border-radius: 10px;">
    <h2>Bugchat</h2>
      
    <form method="post" class="login">
      <table id="login_table">
        <tr>
          <td><input type="text" name="nick" placeholder="Login" maxlength="50" class="txt" autofocus></td>
        </tr>
        <tr>
          <td><input type="password" name="senha" placeholder="Senha" maxlength="15" class="txt"></td>
        </tr>
        <tr>
          <td><input type="submit" value="Entrar" id="btnEntrar"><td>
        </tr>
        <tr>
          <td><input type="hidden" name="acao" value="enviado"></td>
        </tr>
      
      <?php
        }else {
    	  echo "<meta http-equiv='refresh' content='0, url=chat.php'>";
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
              $_SESSION['password_session'] = $senha;
              $agora = date('Y-m-d H:i:s');
              $limite = date('Y-m-d H:i:s', strtotime('+3 min'));
              $up = mysql_query("UPDATE tb_usuarios SET entrada='$agora' WHERE BINARY nickmane= '$nick'");
              $up3 = mysql_query("UPDATE tb_usuarios SET limite='$limite' WHERE BINARY nickmane= '$nick'");
              $up2 = mysql_query("UPDATE tb_usuarios SET status='on' WHERE BINARY nickmane = '$nick'");
              echo "<meta http-equiv='refresh' content='0, url=./'>";
            } else {
              echo "<script>alert('Não foi possível fazer o login!'); </script>";
            }
          }
        }
          
      ?>
      </table>
      </div>
    </form>  

    </section>
    
  </body>
</html>