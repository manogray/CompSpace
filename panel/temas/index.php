<!DOCTYPE html>
<html>
  <?php include("../head.php"); ?>
  <title>Temas</title>
  <body>
    
    <?php include("../banner.php"); ?>
    
    <section>

    <div class="tema-list">
      <?php
      	$resultTemas = mysql_query("SELECT * FROM temas ORDER BY id");
      	while($linhaTemas = mysql_fetch_assoc($resultTemas)){
      ?>
      <div class="Tema">

        <div class="capa-tema" style="background: url(../<?=$linhaTemas['capa']?>); background-size: cover; background-position: center center;"></div>
        <div class="info-tema">
        	<p style="top: 5%; font-weight: bolder;"><?=$linhaTemas['nome']?></p>
        	<p style="top: 14%;"><?=$linhaTemas['info']?></p>
        	<p style="top: 18%;">Criado no Rainmeter</p>
        	<p style="top: 35%;"><a style="padding: 1%;" class="botaoDev" href="tema.php?id=<?=$linhaTemas['id']?>">Mais informações</a></p>
        </div>
      </div>
      <?php
        }
      ?>
    </div> 
      
    </section>

    <?php include("../footer.php"); ?>
  </body>
</html>

