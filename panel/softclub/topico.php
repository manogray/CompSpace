<?php
  $con = mysql_connect('database_devx.mysql.dbaas.com.br','database_devx','luis1995');
  mysql_select_db('database_devx');
?>

<?php
  $id = $_GET['id'];
  
  $query = sprintf("SELECT usuario, nome_top, corpo_top, categoria, data, hora FROM topicos WHERE id = '$id'");
  $dados = mysql_query($query, $con) or die(mysql_error());
  $linha = mysql_fetch_assoc($dados);
  $total = mysql_num_rows($dados);
  date_default_timezone_set('America/Manaus');
  $dateA = date("d/m/Y");
  $hour = date('H:i');
?>

<!DOCTYPE html>
<html>
  <?php include("head-soft.php"); ?>
  <title><?=$linha['nome_top']?></title>
  <body>
    <?php include("banner-soft.php")?>
    <section>
      <div class="titulo-topico"><strong><?=$linha['nome_top']?></strong></div>
      <div class="corpo-topico">
        <pre style="margin: 0;"><div style="display: inline; color: #D3D3D3;">Feito por <strong style="color: #FF0000;"><?=$linha['usuario']?></strong></div>&nbsp;<div style="display: inline; padding-left: 59%; color: #D3D3D3;">Postado em <?=$linha['data']?> - <?=$linha['hora']?></div></pre>
        <br>
        <p style="margin-left: 5%; color: #32CD32;"><?=$linha['corpo_top']?></p>
        <br>
        <pre style="color: #32CD32;">Categoria:&nbsp;<?=$linha['categoria']?></pre>
      </div>
      
      <div>
        
    <br>
    <ul class="comentario">
      <?php
        $query2 = sprintf("SELECT usuario, resposta, hora, data FROM respostas WHERE topico_id = '$id'");
        $dados2 = mysql_query($query2, $con) or die(mysql_error());
        $linha2 = mysql_fetch_assoc($dados2);
        $total2 = mysql_num_rows($dados2);
        
        if($total2 > 0) {
          do {
      ?>
      
      <div class="titulo-topico"><strong>RE:<?=$linha['nome_top']?></strong></div>
      <div class="corpo-topico">
        <pre style="margin: 0;"><div style="display: inline; color: #D3D3D3;">Respondido por <strong style="color: #FF0000;"><?=$linha2['usuario']?></strong></div>&nbsp;<div style="display: inline; padding-left: 49%; color: #D3D3D3;">Postado em <?=$linha2['data']?> - <?=$linha2['hora']?></div></pre>
        <br>
        <p style="margin-left: 5%; color: #32CD32;"><?=$linha2['resposta']?></p>
        <br>
        <pre style="color: #32CD32;">Categoria:&nbsp;<?=$linha['categoria']?></pre>
      </div>
      
      <?php
          }while($linha2 = mysql_fetch_assoc($dados2));
        } else {
          echo "<p>Nenhuma resposta</p>";
        }
      ?>
    </ul>
        
        <form method="post"><div style="margin-bottom: 0px; margin-top: 3%"><?=$usuario?></div> &nbsp; <textarea name="resposta" placeholder="Sabe a resposta ? Digite..." style="width: 100%; height: 150px; border: 2px solid black; color: #32cd32; background-color: black; margin-top: 0px;"></textarea>
          <input type="submit" name="enviado" value="Responder" style="border-radius: 10px; cursor: pointer; margin-top: 1%;">
      <?php
        $resposta = $_POST['resposta'];
        if(!empty($resposta)) {
          mysql_query("INSERT INTO respostas (usuario, resposta, topico_id, hora, data) VALUES ('$usuario', '$resposta', '$id', '$hour', '$dateA')");
          echo "<meta http-equiv='refresh' content='0, url=topico.php?id=$id'>";
        }
      ?>
    </form>
    
    </div>
    </section>
    <?php include("footer-soft.php")?>
  </body>
</html>
