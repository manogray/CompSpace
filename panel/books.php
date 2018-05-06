<?php
  mysql_connect("database_devx.mysql.dbaas.com.br", "database_devx", "luis1995");
  mysql_select_db("database_devx");

  $comput = "computacao";
  $exat = "exatas";
  $eletro = "eletronica";
  $queryComput = sprintf("SELECT * FROM apostilas WHERE area = '$comput'");
  $resultComput = mysql_query($queryComput);
  $quantComput = mysql_num_rows($resultComput);
  $queryExat = sprintf("SELECT * FROM apostilas WHERE area ='$exat'");
  $resultExat = mysql_query($queryExat);
  $quantExat = mysql_num_rows($resultExat);
  $queryEletro = sprintf("SELECT * FROM apostilas WHERE area ='$eletro'");
  $resultEletro = mysql_query($queryEletro);
  $quantEletro = mysql_num_rows($resultEletro);
?>
<!DOCTYPE html>
<html>
  <?php include("head.php"); ?>
  <title>Developers Factory X - A maior biblioteca livre de computação do Brasil</title>
  <body>
    
    <?php include("banner.php"); ?>
    
    <h2>Developers Library</h2>
    
    <section>
      <a href="apostilas.php?area=exat" style="text-decoration: none; color: white;">
      <div class="apostila-content" style="background-image: url(images/exatasBan.jpg);">
        <p class="apostila-titulo" style="margin: 0; position: absolute; top: 40%; left: 40%; font-size: 250%; font-family: 'pdark'; background: rgba(0,0,0,0.7); padding: 0.7%">EXATAS</p>
        <p class="quant-apostila" style="display: block; margin: 0; position: absolute; bottom: 3%; left: 1%; font-size: 100%; font-family: Consolas; background: rgba(0,0,0,0.7); padding: 0.7%">Total: <?=$quantExat?></p>
      </div>
      </a>
      
      <a href="apostilas.php?area=comput" style="text-decoration: none; color: white; margin-bottom: 2%;">
      <div class="apostila-content" style="background-image: url(images/computacaoBan.jpg);">
        <p class="apostila-titulo" style="margin: 0; position: absolute; top: 40%; left: 31%; font-size: 250%; font-family: 'pdark'; background: rgba(0,0,0,0.7); padding: 0.7%">COMPUTACAO</p>
        <p class="quant-apostila" style="display: block; margin: 0; position: absolute; bottom: 3%; left: 1%; font-size: 100%; font-family: Consolas; background: rgba(0,0,0,0.7); padding: 0.7%">Total: <?=$quantComput?></p>
      </div>
      </a>
      
      <a href="apostilas.php?area=eletro" style="text-decoration: none; color: white; margin-bottom: 2%;">
      <div class="apostila-content" style="background-image: url(images/eletronicaBan.jpg);">
        <p class="apostila-titulo" style="margin: 0; position: absolute; top: 40%; left: 35%; font-size: 250%; font-family: 'pdark'; background: rgba(0,0,0,0.7); padding: 0.7%">ELETRONICA</p>
        <p class="quant-apostila" style="display: block; margin: 0; position: absolute; bottom: 3%; left: 1%; font-size: 100%; font-family: Consolas; background: rgba(0,0,0,0.7); padding: 0.7%">Total: <?=$quantEletro?></p>
      </div>
      </a>
    </section>

    <?php include("footer.php"); ?>

  </body>
</html>