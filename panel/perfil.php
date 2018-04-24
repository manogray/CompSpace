<?php
  $con = mysql_connect('database_devx.mysql.dbaas.com.br','database_devx','luis1995');
  mysql_select_db('database_devx');
  mysql_set_charset('utf8');
?>

<!DOCTYPE html>
<html>
  <?php include("head.php"); ?>
  <title>Meu Perfil</title>
  <body>

    <?php include("banner.php");
      date_default_timezone_set('America/Manaus');
      $nickname = $_SESSION['user_session'];
      
      $query = sprintf("SELECT email, genero, cidade, estado, tipo, perfil, universidade, curso FROM tb_usuarios WHERE nickmane = '$nickname'");
      $result = mysql_query($query);
      $row = mysql_fetch_assoc($result);
    
      if(!$result) {
        $message = 'ERROR ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
      }
    ?>


    <section>
      <?php 
          $email = $row['email'];
          $genero = $row['genero'];
          $cidade = $row['cidade'];
          $estado = $row['estado'];
          $tipo = $row['tipo'];
          $perfil = $row['perfil'];
          $univ = $row['universidade'];
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
      
      <div class="perfil-info">
        <div class="avatar" style="background: url(<?=$imgg?>); background-size: cover; background-position-x: center;"><?=$type?></div>
        <div id="info_tab">
          <h3 style="position: relative; margin: 0; left: -10.4%; margin-bottom: 0.5%;"><?=$nickname?></h3>
          <span style="margin-left: 35%;"><i class="fa fa-flag-o" aria-hidden="true"></i> <?=$cidade?> <?=$estado?></span>
          <p><?=$curso?> - <?=$univ?></p>
          <a class="botaoDev" href="change.php" style="margin-left: 35%; padding: 0.6%;">Editar perfil</a>
        </div>
      </div>
      <?php
        if($_FILES['profile']['error'] != 0) {
          die("Não foi possível fazer o upload!");
          exit;
        }
          
        $dirFoto = "/home/storage/4/df/bb/developersfactoryx/public_html/panel/users/$usuario/";
        $nomeFinalperfil = $_FILES['profile']['name'];
          
        if(move_uploaded_file($_FILES['profile']['tmp_name'], $dirFoto . $nomeFinalperfil)) {
          mysql_query("UPDATE tb_usuarios SET perfil = '$nomeFinalperfil' WHERE nickmane = '$usuario'");
          echo "<meta http-equiv='refresh' content='0, url=perfil.php'>";
        }
      ?>
      
      
      <div class="control-panel" style="<?=$ddi?>">
        <?php
        	if($tipo == 'adm') {
      	?>
        <div class="links-uteis">
          <a class="botaoDev" style="padding: 2%;" href="https://mtfp.live/">Monsta FTP</a>
          <a class="botaoDev" style="padding: 2%;" href="https://pydio.com/">Pydio</a>
          <a class="botaoDev" style="padding: 2%;" href="https://phpmyadmin.locaweb.com.br/">PHPMyAdmin</a>
          <a class="botaoDev" style="padding: 2%;" href="http://www.net2ftp.com/">net2ftp</a>
          <a class="botaoDev" style="padding: 2%;" href="https://filezilla-project.org/">FileZilla</a>
      	</div>
        <div class="reportsBugs" style="margin-top: 1%; margin-bottom: 3%;">
          <div class="bugs-title"><strong>Report Bug</strong></div>
          <div class="list-bugs">
            <ul style="list-style-type: none;">
      <?php
        $query3 = sprintf("SELECT usuario, erro, detalhes FROM reportbug");
        $result3 = mysql_query($query3);
        $row3 = mysql_fetch_assoc($result3);
        $total = mysql_num_rows($result3);
    
        if(!$result3) {
          $message = 'ERROR ' . mysql_error() . "\n";
          $message .= 'Whole query: ' . $query3;
          die($message);
        }
          
        if($total > 0){
          do {
       ?>
          <li><?=$row3['erro']?>:&nbsp;&nbsp;<?=$row3['detalhes']?><pre>Relatado por <strong><?=$row3['usuario']?></strong></pre></li>
       <?php
          }while($row3 = mysql_fetch_assoc($result3));
        } else {
          echo "Sem reports";
        }
       ?>
        </ul>
          </div>
        </div>
        <?php
        }
      	if(($tipo == 'colab') || ($tipo == 'adm')) {
        ?>
        
        <div class="insere-pdf">
          <div class="pdf-title"><strong>Inserir novo livro</strong></div>
          <div class="formulario-pdf" style="margin-top: 2.4%;">
            <form method="post" enctype="multipart/form-data">
            <p><input class="inputDev" type="txt" name="nome" placeholder="Nome do Livro"></p>
            <p>Inserir pdf: <input type="file" name="pdf"></p>
            <p>Inserir capa: <input type="file" name="capa"></p>
            <p>Exatas<input type="radio" name="tabela" value="exatas">&nbsp;&nbsp;Computação<input type="radio" name="tabela" value="computacao">&nbsp;&nbsp;Eletrônica<input type="radio" name="tabela" value="eletronica"></p>
            <input type="reset" class="botaoDev" style="padding: 1%;" value="Limpar">&nbsp;&nbsp;<input type="submit" class="botaoDev" style="padding: 1%;" value="Inserir">
         </form>
          </div>
        </div>
        <?php
        }
        ?>
      </div>
        
      <?php
        if(($_FILES['pdf']['error'] != 0) || ($_FILES['capa']['error'] != 0)) {
          die("Não foi possível fazer o upload.");
          exit;
        }
        
        $dirComputacao = '/home/storage/4/df/bb/developersfactoryx/public_html/panel/apostilas/computacao/';
        $dirExatas = '/home/storage/4/df/bb/developersfactoryx/public_html/panel/apostilas/exatas/';
        $dirEletro = '/home/storage/4/df/bb/developersfactoryx/public_html/panel/apostilas/eletronica/';
        $dirCapas = '/home/storage/4/df/bb/developersfactoryx/public_html/panel/images/';
        $nomeFinalpdf = $_FILES['pdf']['name'];
        $nomeFinalcapa = $_FILES['capa']['name'];
          
        if($_POST['tabela'] == 'computacao') {
          if((move_uploaded_file($_FILES['pdf']['tmp_name'], $dirComputacao . $nomeFinalpdf)) && (move_uploaded_file($_FILES['capa']['tmp_name'], $dirCapas . $nomeFinalcapa))) {
            echo "Upload feito com sucesso!";
          } else {
            echo "Deu merda!";
          }
        } elseif ($_POST['tabela'] == 'eletronica') {
          if((move_uploaded_file($_FILES['pdf']['tmp_name'], $dirEletro . $nomeFinalpdf)) && (move_uploaded_file($_FILES['capa']['tmp_name'], $dirCapas . $nomeFinalcapa))) {
            echo "Upload feito com sucesso!";
          } else {
            echo "Deu merda!";
          }
        } elseif ($_POST['tabela'] == 'exatas') {
          if((move_uploaded_file($_FILES['pdf']['tmp_name'], $dirExatas . $nomeFinalpdf)) && (move_uploaded_file($_FILES['capa']['tmp_name'], $dirCapas . $nomeFinalcapa))) {
            echo "Upload feito com sucesso!";
          } else {
            echo "Deu merda!";
          }
             }
             
          
        $pdf = $nomeFinalpdf;
        $capa = $nomeFinalcapa;
        $tabela = $_POST['tabela'];
        $nome = $_POST['nome'];
        mysql_query("INSERT INTO apostilas (nome, diretorio, capa, area) VALUES ('$nome','$pdf','$capa','$tabela')");
      ?>
    </section>

    <?php include("footer.php"); ?>
  </body>
</html>
