<?php
  mysql_connect('database_devx.mysql.dbaas.com.br','database_devx','luis1995');
  mysql_select_db('database_devx');
?>

<!DOCTYPE html>
<html>
  <?php include("head.php");?>
  <title>ReportBug</title>
  <body>
    <form method="post">
      <table id="bug_table">
        <tr>
          <td>Erro</td>
          <td>Link quebrado&nbsp;<input type="radio" name="erro" value="linkcrash">&nbsp;&nbsp;&nbsp;Informação errada&nbsp;<input type="radio" name="erro" value="infoerrada">&nbsp;&nbsp;&nbsp;Outros&nbsp;<input type="radio" name="erro" value="outros"></td>
        </tr>
        <tr>
          <td>Especifique o erro</td>
          <td><textarea name="detalhes" style="border: none; border-radius: 5px; width: 350px; height: 90px;"></textarea></td>
        </tr>
        <tr>
          <td></td>
          <td><input type="submit" value="Enviar" name="enviar" class="botao">&nbsp;&nbsp;<a style="text-decoration: none; color: #00bfff; cursor: pointer;" href="home.php">Voltar ao site</a></td>
        </tr>
      </table>
    </form>
    <?php
      $erro = $_POST['erro'];
      $detalhes = $_POST['detalhes'];
      $usuario = $_SESSION['user_session'];
      if($_POST['enviar'] == 'Enviar') {
        if(empty($erro) || empty($detalhes)) {
          echo "<script>alert(Preencha todos os campos!)</script>";
        }
    
        mysql_query("INSERT INTO reportbug (usuario, erro, detalhes) VALUES ('$usuario', '$erro','$detalhes')");
        echo "<meta http-equiv='refresh' content='0, url=/.'>";
      }
    ?>
  </body>
</html>