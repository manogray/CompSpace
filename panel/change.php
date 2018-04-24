<?php
  mysql_connect('database_devx.mysql.dbaas.com.br','database_devx','luis1995');
  mysql_select_db('database_devx');
?>

<!DOCTYPE html>
<html>
  <?php include("head.php");?>
  <?php
  	include("banner.php");
    date_default_timezone_set('America/Manaus');
    mysql_set_charset('utf8');
      $nickname = $_SESSION['user_session'];
      
      $query = sprintf("SELECT email, genero, cidade, estado, tipo, perfil, nome, senha, universidade, curso FROM tb_usuarios WHERE nickmane = '$nickname'");
      $result = mysql_query($query);
      $row = mysql_fetch_assoc($result);
    
      if(!$result) {
        $message = 'ERROR ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
      }
    ?>
  
  <?php   $nome = $row['nome'];
          $email = $row['email'];
          $genero = $row['genero'];
          $cidade = $row['cidade'];
          $estado = $row['estado'];
          $tipo = $row['tipo'];
          $perfil = $row['perfil'];
          $describe = $row['descricao'];
  		  $senha = $row['senha'];
  		  $universidade = $row['universidade'];
  		  $curso = $row['curso'];
          $type;

		  if($tipo == 'adm') {
            $type = "<div style='
    margin-left: 6.5%;
    background: red;
    position: absolute;
    bottom: 0%;
    left: 0%;
    max-width: 129px;
    padding: 0.4%;
    border-radius: 4px;
    color: black;
    text-shadow: none;
    font-weight: bolder;
'><i class='fa fa-terminal' aria-hidden='true'></i> Administrador</div>";
          }
      	  
      	  if($tipo == 'colab') {
            $type = "<div style='
    margin-left: 6.5%;
    background: #00bfff;
    max-width: 116px;
    padding: 0.4%;
    position: absolute;
    bottom: 0%;
    left: 0%;
    border-radius: 4px;
    color: black;
    text-shadow: none;
    font-weight: bolder;
'><i class='fa fa-superpowers' aria-hidden='true'></i> Colaborador</div>";
          }
      
      	  if($tipo == 'user'){
            $type = '';
            $ddi = 'display: none;';
          }
        
      ?>
      
      <?php
        if(empty($perfil)) {
          $imgg = "images/default.jpg";
        } else {
          $imgg = "users/".$usuario."/".$perfil;
        }
      ?>
  <title>Editar Perfil</title>
  <body>
    <div class="perfil-info" style="height: 111px;">
      <div class="avatar" style="background: url(<?=$imgg?>); background-size: cover; background-position-x: center; width: 95px; height: 95px;"></div>
      <p style="position: absolute; left: 15%; bottom: 0%; font-size: 28pt; color: silver;"><?=$nickname?></p>
    </div>
    <form class="formulario-editPerfil" method="post" enctype="multipart/form-data">
      <fieldset>
        <legend>Informações de Conta</legend>
        <p><i class="fa fa-user-circle-o" aria-hidden="true"></i> Nome <input type="text" name="nome" class="inputDev" placeholder="<?=$nome?>"></p>
        <p><i class="fa fa-envelope-o" aria-hidden="true"></i> Email <input type="text" name="email" class="inputDev" placeholder="<?=$email?>"></p>
        <p><i class="fa fa-building-o" aria-hidden="true"></i> Cidade <input type="text" name="cidade" class="inputDev" placeholder="<?=$cidade?>"></p>
        <p><i class="fa fa-flag-o" aria-hidden="true"></i> Estado <input type="text" name="estado" class="inputDev" placeholder="<?=$estado?>"></p>
        <p><i class="fa fa-university" aria-hidden="true"></i> Instituição <input style="width: 50%;" type="text" name="universidade" class="inputDev" placeholder="<?=$universidade?>"></p>
        <p><i class="fa fa-graduation-cap" aria-hidden="true"></i> Curso <input style="width: 50%;" type="text" name="curso" class="inputDev" placeholder="<?=$curso?>"></p>
      </fieldset>
        
      <fieldset>
        <legend>Alterar Senha</legend>
      <p>Senha antiga <input class="inputDev" type="password" name="oldpass"></p>
      <p>Nova senha <input class="inputDev" type="password" name="newpass"></p>
      </fieldset>
      
      <fieldset>
        <legend>Avatar</legend>
        <input type="file" name="avatar-user">
      </fieldset>
      
      <input type="submit" value="Salvar Alterações" name="enviar" class="botaoDev" style="position: relative; left: calc(50% - 382px); padding: 0.6%; margin-top: 2%; margin-bottom: 2%;">
    </form>
    <?php  
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $oldpass = $_POST['oldpass'];
        $newpass = $_POST['newpass'];
        $newNome = $_POST['nome'];
        $newEmail = $_POST['email'];
        $newCidade = $_POST['cidade'];
        $newEstado = $_POST['estado'];
        $newUniversidade = $_POST['universidade'];
        $newCurso = $_POST['curso'];
        $flagSenha = 0;
        $flagNome = 0;
        $flagEmail = 0;
        $flagCidade = 0;
        $flagEstado = 0;
        $flagUniversidade = 0;
        
        if(!empty($oldpass) && !empty($newpass)) {
          if($senha == $oldpass) {
            $trocaSenha = "senha ='".$newpass."'";
          } else {
            echo "<script>alert('Senha não corresponde!')</script>";
            echo "<meta http-equiv='refresh' content='0'";
          }
        }
        
        if((empty($oldpass) && !empty($newpass)) || (!empty($oldpass) && empty($newpass))){
          echo "<script>alert('Para alterar a senha, preencha os dois campos!')</script>";
        }
        
        if(!empty($newNome)){
          $trocaNome = "nome = '".$newNome."'";
          $flagSenha = 1;
        }
        
        if(!empty($newEmail)){
          $trocaEmail = "email = '".$newEmail."'";
          $flagSenha = 1;
          $flagNome = 1;
        }
        
        if(!empty($newCidade)){
          $trocaCidade = "cidade = '".$newCidade."'";
          $flagSenha = 1;
          $flagNome = 1;
          $flagEmail = 1;
        }
        
        if(!empty($newEstado)){
          $trocaEstado = "estado = '".$newEstado."'";
          $flagSenha = 1;
          $flagNome = 1;
          $flagEmail = 1;
          $flagCidade = 1;
        }
        
        if(!empty($newUniversidade)){
          $trocaUniversidade = "universidade = '".$newUniversidade."'";
          $flagSenha = 1;
          $flagNome = 1;
          $flagEmail = 1;
          $flagCidade = 1;
          $flagEstado = 1;
        }
        
        if(!empty($newCurso)){
          $trocaCurso = "curso = '".$newCurso."'";
          $flagSenha = 1;
          $flagNome = 1;
          $flagEmail = 1;
          $flagCidade = 1;
          $flagEstado = 1;
          $flagUniversidade = 1;
        }
        
        if(($flagSenha == 1) && !empty($trocaSenha)){
          $trocaSenha = $trocaSenha.",";
        }
        
        if(($flagNome == 1) && !empty($trocaNome)){
          $trocaNome = $trocaNome.",";
        }
        
        if(($flagEmail == 1) && !empty($trocaEmail)){
          $trocaEmail = $trocaEmail.",";
        }
        
        if(($flagCidade == 1) && !empty($trocaCidade)){
          $trocaCidade = $trocaCidade.",";
        }
        
        if(($flagEstado == 1) && !empty($trocaEstado)){
          $trocaEstado = $trocaEstado.",";
        }
        
        if(($flagUniversidade == 1) && !empty($trocaUniversidade)){
          $trocaUniversidade = $trocaUniversidade.",";
        }
        
        if(!empty($trocaSenha) || !empty($trocaNome) || !empty($trocaEmail) || !empty($trocaCidade) || !empty($trocaEstado) || !empty($trocaUniversidade) || !empty($trocaCurso)){
        	mysql_query("UPDATE tb_usuarios SET $trocaSenha $trocaNome $trocaEmail $trocaCidade $trocaEstado $trocaUniversidade $trocaCurso WHERE nickmane = '$nickname'");
          	echo "<meta http-equiv='refresh' content='0'";
        }else {
          echo "<script>alert('Nada a fazer')</script>";
        }
      }
    ?>
  </body>
</html>