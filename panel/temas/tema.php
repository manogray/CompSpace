<!DOCTYPE html>
<html>
  <?php include("../head.php"); ?>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <style>
	.mySlides {display:none}
	.demo {cursor:pointer}
  </style>
  <body>
    
    <?php include("../banner.php"); ?>
	
    <?php
    	mysql_set_charset('utf8');
    	$temaID = $_GET['id'];
    	$linhaTema = mysql_fetch_assoc(mysql_query("SELECT * FROM temas WHERE id = '$temaID'"));
    	$layouts = explode(",",$linhaTema['layouts']);
    	$sistemas = explode("-",$linhaTema['compatibilidade']);
    	if($sistemas[0] == 1){
          $sist1 = "<i style='float: right; margin-right: 16%;' class='fa fa-windows' aria-hidden='true'></i>";
        }
    
    	if($sistemas[1] == 1){
          $sist2 = "<i style='float: right; margin-right: 16%;' class='fa fa-linux' aria-hidden='true'></i>";
        } 
     
    	if($sistemas[2] == 1){
          $sist3 = "<i style='float: right; margin-right: 16%;' class='fa fa-apple' aria-hidden='true'></i>";
        }
    ?>
    <title><?=$linhaTema['nome']?></title>
    <section class="corpo">

    <h3 style="margin-top: 8%; text-align: left; font-weight: bolder;"><?=$linhaTema['nome']?></h3>
    <div class="tema-content">
    <div class="layout-slide">
<div class="w3-content" style="max-width:1200px">
  <?php
  	$contador = 0;
  	while($contador < count($layouts)){
  ?>
  <img class="mySlides" src="../images/<?=$layouts[$contador]?>" style="width:100%">
  <?php
    $contador = $contador + 1;
    }
  ?>

  <div class="w3-row-padding w3-section">
    <?php
    	$contador = 0;
    	while($contador < count($layouts)){
    ?>
    <div class="w3-col s4">
      <img class="demo w3-opacity w3-hover-opacity-off" src="../images/<?=$layouts[$contador]?>" style="width:100%" onclick="currentDiv(<?=$contador + 1?>)">
    </div>
    <?php
      $contador = $contador + 1;
    }
    ?>
  </div>
</div>

<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
     dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
  }
  x[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " w3-opacity-off";
}
</script>
    </div>
      <div class="tema-back" style="background: url(../<?=$linhaTema['capa']?>); background-size: cover; background-position: center center;">
      </div>
    <div class="info-instrucoes">
      <ul style="list-style: none;">
        <li>Recomendado que tire todos os ícones de seu desktop antes da instalação do tema.</li>
        <li>Para a instalação deste tema é necessário que baixe e instale o programa <a href="https://www.rainmeter.net/">Rainmeter</a></li>
        <li>O tema é feito em programa gratuito e open source, então, sinta-se livre para modificar</li>
        <li>Abaixo você encontra sugestões de como arrumar seu desktop com as skins <?=$linhaTema['nome']?></li>
        <li>Bom proveito!</li>
      </ul>
    </div>
    </div>
      
      <div class="download-area">Download <?=$linhaTema['nome']?> <span><?=$sist1?><?=$sist2?><?=$sist3?></span> <a class="botaoDev download-button">Download</a></div>

    </section>

    <?php include("../footer.php"); ?>

  </body>
</html>
