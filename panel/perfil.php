<?php
  include("../class/conexaoCSdb.php");
?>

<!DOCTYPE html>
<html>
  <?php include("head.php"); ?>
  <title>Meu Perfil</title>
  <body>

    <?php include("banner.php");?>


    <section>
      <?php

		  if($usuarioLogado->Tipo == 'adm') {
            $type = "<div style='
    margin-left: 6.5%;
    background: red;
    position: absolute;
    bottom: 0%;
    left: 0%;
    padding: 0.4%;
    border-radius: 4px;
    color: black;
    text-shadow: none;
    font-weight: bolder;
'><i class='fa fa-terminal' aria-hidden='true'></i> Administrador</div>";
          }
      	  
      	  if($usuarioLogado->Tipo == 'colab') {
            $type = "<div style='
    margin-left: 6.5%;
    background: #00bfff;
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
      
      	  if($usuarioLogado->Tipo == 'user'){
            $type = '';
            $ddi = 'display: none;';
          }
        
      ?>
      
      <?php
        if(empty($usuarioLogado->Perfil)) {
          $imgg = "images/default.jpg";
        } else {
          $imgg = "users/".$usuarioLogado->Perfil;
        }
      ?>
      
      <div class="perfil-info">
        <div class="avatar" style="background: url(<?=$imgg?>); background-size: cover; background-position-x: center;"><?=$type?></div>
        <div id="info_tab">
          <h3 style="position: relative; margin: 0; left: -10.4%; margin-bottom: 0.5%; font-weight: 100;"><?=$usuarioLogado->Nickname?></h3>
          <span style="margin-left: 35%;"><i class="fa fa-flag-o" aria-hidden="true"></i> <?=$usuarioLogado->Cidade?> <?=$usuarioLogado->Estado?></span>
          <p><?=$usuarioLogado->Curso?> - <?=$usuarioLogado->Universidade?></p>
          <a class="botaoDev" href="change.php" style="margin-left: 35%; padding: 0.6%;">Editar perfil</a>
        </div>
      </div>
      <?php
        if($_FILES['profile']['error'] != 0) {
          die("Não foi possível fazer o upload!");
          exit;
        }
          
        $dirFoto = "/home/storage/4/df/bb/developersfactoryx/public_html/panel/users/$usuarioLogado->Nickname/";
        $nomeFinalperfil = $_FILES['profile']['name'];
          
        if(move_uploaded_file($_FILES['profile']['tmp_name'], $dirFoto . $nomeFinalperfil)) {
          $mysqli->query("UPDATE tb_usuarios SET perfil = '$nomeFinalperfil' WHERE nickmane = '$usuarioLogado->Nickname'");
          echo "<meta http-equiv='refresh' content='0, url=perfil.php'>";
        }
      ?>
      
      
      <div class="control-panel" style="<?=$ddi?>">
        <?php
        	if($usuarioLogado->Tipo == 'adm') {
      	?>
        <div class="reportsBugs" style="margin-top: 1%; margin-bottom: 3%;">
          <div class="bugs-title"><strong>Report Bug</strong></div>
          <div class="list-bugs">
            <ul style="list-style-type: none; padding: 9px 7px;">
      <?php
        $resultReports = $mysqli->query("SELECT usuario, erro, detalhes FROM reportbug");
        $linhaReports = $resultReports->fetch_assoc();
        $total = $resultReports->num_rows;
          
        if($total > 0){
          do {
       ?>
          <li><?=$linhaReports['erro']?>:&nbsp;&nbsp;<?=$linhaReports['detalhes']?><pre>Relatado por <strong><?=$linhaReports['usuario']?></strong></pre></li>
       <?php
          }while($linhaReports = $resultReports->fetch_assoc());
        } else {
          echo "Sem reports";
        }
       ?>
        </ul>
          </div>
        </div>
        <?php
        }
      	if(($usuarioLogado->Tipo == 'colab') || ($usuarioLogado->Tipo == 'adm')) {
        ?>
        
        <div class="insere-pdf">
          <div class="pdf-title"><strong>Inserir novo livro</strong></div>
          <div class="formulario-pdf" style="margin-top: 2.4%;">
            <form method="post" enctype="multipart/form-data">
            <input class="inputDev" type="txt" name="nome" placeholder="Nome do Livro"></p>
            <span>Inserir pdf:</span><input type="file" name="pdf">
            <span>Inserir capa:</span><input type="file" name="capa">
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
        $mysqli->query("INSERT INTO apostilas (nome, diretorio, capa, area) VALUES ('$nome','$pdf','$capa','$tabela')");
      ?>
    </section>

    <?php include("footer.php"); ?>
  </body>
</html>
