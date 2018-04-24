<?php
  $con = mysql_connect('database_devx.mysql.dbaas.com.br','database_devx','luis1995');
  mysql_select_db('database_devx');
?>

<!DOCTYPE html>
<html>
  <?php include("head-soft.php"); ?>
  <title>SoftClub</title>
  <body>
    
    <?php include("banner-soft.php");
      date_default_timezone_set('America/Manaus');
      $nickname = $_SESSION['user_session'];
      $dateA = date("d/m/Y");
      $hour = date('H:i');
    ?>

    <section>

    <br>
    <br>
    <br>
    <br>
    <form method="post"><?=$nickname?>: &nbsp; <textarea name="coment" style="width: 100%; height: 150px; border: none; margin: 0;"></textarea>
      <?php
        $coment = $_POST['coment'];
        if(!empty($coment)) {
          mysql_query("INSERT INTO comentarios (usuario, comentario, hora, data) VALUES ('$nickname', '$coment', '$hour', '$dateA')");
          echo "<meta http-equiv='refresh' content='0, url=home.php'>";
        }
      ?>
    </form>
    <br>
    <ul class="comentario">
      <?php
        $query = sprintf("SELECT usuario, comentario, hora, data FROM comentarios order by id desc");
        $dados = mysql_query($query, $con) or die(mysql_error());
        $linha = mysql_fetch_assoc($dados);
        $total = mysql_num_rows($dados);
        
        if($total > 0) {
          do {
      ?>
      <li><p><pre>&nbsp;&nbsp;<strong><?=$linha['usuario']?></strong></pre>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$linha['comentario']?> <pre>&#09; &#09; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$linha['hora']?> de <?=$linha['data']?> </pre></p></li>
      <?php
          }while($linha = mysql_fetch_assoc($dados));
        } else {
          echo "<p>Nenhum Comentário!</p>";
        }
      ?>
    </ul>
    <br>
    <br>
    <br>
    <br>

    </section>


    <?php include("footer-soft.php"); ?>
  </body>
</html>
