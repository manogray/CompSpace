<?php
  mysql_connect('database_devx.mysql.dbaas.com.br','database_devx','luis1995');
  mysql_select_db('database_devx');
?>
<!DOCTYPE html>
<html>
  <?php include("panel/head.php"); ?>
  <title>Registro</title>
  <body style="background: url(panel/images/cadastro-back.jpg); background-size: 100%;">

    <section>
      <h2>Developers Factory X</h2>
      
    <form method="post" class="login">
      <input type="hidden" name="acao" value="enviado">
      <table id="cad_table">
        <tr>
          <td><input type="text" name="nick" placeholder="Login" maxlength="16" class="inputDev" autofocus></td>
        </tr>
        <tr>
          <td><input type="password" name="senha" placeholder="Senha" maxlength="15" class="inputDev"></td>
        </tr>
        <tr>
          <td><input type="email" name="email" placeholder="E-mail" class="inputDev"></td>
        </tr>
        <tr>
          <td>
            <input type="text" name="genero" placeholder="Gênero" class="inputDev">
          </td>
        </tr>
        <tr>
          <td><input type="date" name="nascimento" id="nascimento" class="inputDev" placeholder="00/00/0000"></td>
        </tr>
        <tr>
          <td><input type="text" name="estado" placeholder="Estado" class="inputDev"></td>
        </tr>
        <tr>
          <td><input type="text" name="cidade" placeholder="Cidade" class="inputDev"></td>
        </tr>
        <tr>
          <td><input type="submit" value="Registrar" class="botaoDev" style="padding: 3%;"> &nbsp; Já tem registro ? <a href="./" class="linkDev">Login</a></td>
        </tr>
      
      <?php
      	if(isset($_POST['acao']) && $_POST['acao'] == 'enviado') {
          $nick = $_POST['nick'];
          $senha = $_POST['senha'];
          $email = $_POST['email'];
          $genero = $_POST['genero'];
          $nascimento = $_POST['nascimento'];
          $estado = $_POST['estado'];
          $cidade = $_POST['cidade'];
          $tipo = 'user';
          
          if(empty($nick) || empty($senha)) {
            echo "<script>alert('Preencha todos os campos!'); history.back();</script>";
          } else {
            $query1 = mysql_num_rows(mysql_query("SELECT * FROM tb_usuarios WHERE BINARY nickmane = '$nick'"));
            $query2 = mysql_num_rows(mysql_query("SELECT * FROM tb_usuarios WHERE BINARY email = '$email'"));
            if ($query1 == 1 || $query2 == 1) {
              echo "<script>alert('Usuário já cadastrado!'); </script>";
            } else {
              mysql_query("INSERT INTO tb_usuarios (nickmane, email, senha, genero, nascimento, estado, cidade, tipo) VALUES ('$nick', '$email', '$senha', '$genero', '$nascimento', '$estado', '$cidade', '$tipo')");
              echo "<script>alert('Usuário cadastrado com sucesso!'); </script>";
              echo "<meta http-equiv='refresh' content='0, url=index.php'>";
            }
          }
        }
          
      ?>
      </table>
    </form>  

    </section>
    
  </body>
</html>