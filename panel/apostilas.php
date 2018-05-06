<?php
  $con = mysql_connect('database_devx.mysql.dbaas.com.br','database_devx','luis1995');
  mysql_select_db('database_devx');

  mysql_set_charset('utf8');

  $area = $_GET['area'];
  
  if($area == 'exat') {
    $image = 'images/exatas.png';
    $word = 'exatas';
    $title = 'Exatas';
  }

  if($area == 'comput') {
    $image = 'images/computacao.png';
    $word = 'computacao';
    $title = 'Computação';
  }

  if($area == 'eletro') {
    $image = 'images/eletronica.png';
    $word = 'eletronica';
    $title = 'Eletrônica';
  }
?>
<!DOCTYPE html>
<html>
<?php include("head.php");?>
<title><?=$title?></title>
<?php include("banner.php");?>
<body>
<section>
  <div class="apostila-list">
  <?php
    $query = sprintf("SELECT * FROM apostilas WHERE area = '$word' order by nome");
    $dados = mysql_query($query, $con) or die(mysql_error());
    $total = mysql_num_rows($dados);
    $result1 = mysql_query("SELECT * FROM tb_usuarios WHERE nickmane = '$usuario'");
    $linha1 = mysql_fetch_assoc($result1);
    $favoritos = explode("-", $linha1['favoritos']);
    $resultCategorias = mysql_query("SELECT DISTINCT categoria FROM apostilas WHERE area = '$word' order by categoria");
    $Categorias = mysql_fetch_assoc($resultCategorias);
    
    if($total > 0) {
      do {
        $catAtual = $Categorias['categoria'];
        $dados3 = mysql_query("SELECT * FROM apostilas WHERE categoria = '$catAtual' order by nome");
        $encoding = 'UTF-8';
        ?>
    	<div class="content-categoria">
    	<div class="titulo-categoria">
        <?=mb_convert_case($catAtual, MB_CASE_UPPER, $encoding)?>
        </div>
    	<?php
        while($linha3 = mysql_fetch_assoc($dados3)){
        $per = array_search($linha3['id'], $favoritos);
        if($per === FALSE) {
          $image = "<i class='fa fa-star-o' style='color: silver; font-size: 25pt;' aria-hidden='true'></i>";
          $add = "?ind=".$linha3['id'];
        } else {
          $image = "<i class='fa fa-star' style='color: #00bfff; font-size: 25pt;' aria-hidden='true'></i>";
          $add = "";
        }
       
  ?>
    <div class="apostila-link">
      <a href="apostilas/<?=$word?>/<?=$linha3['diretorio']?>"><div class="capa-livro" style="background: url('images/<?=$linha3['capa']?>'); background-size: cover; background-position: center center;"></div></a>
      <div class="favorite"></div>
      <div class="nome-livro"><?=$linha3['nome']?></div>
    </div>
    <?php
      }
      ?>
    </div>
      <?php
      }while($Categorias = mysql_fetch_assoc($resultCategorias));
    } else {
        echo "<p>Sem livros!</p>";
    }
    if(!empty($_GET['ind'])) {
      $novo = $_GET['ind'];
      if(!empty($linha1['favoritos'])) {
        $favor = $linha1['favoritos']."-".$novo;
      } else {
        $favor = $novo;
      }
      mysql_query("UPDATE tb_usuarios SET favoritos = '$favor' WHERE nickmane = '$usuario'");
      echo "<meta http-equiv='refresh' content='0, url=../'>";
    }
    ?>
  </div>
</section>
  <?php include("footer.php");?>
</body>
</html>