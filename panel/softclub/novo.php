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
    <form method="post" id="novo-top">
      <p><input type="text" name="titulo" id="novo-top-titulo" maxlenght="60" placeholder="Digite o nome do tópico!" style="width: 100%; border-bottom: 2px solid;"></p>
      Categoria:&nbsp;<select name="categoria">
        <option value="">None</option>
        <optgroup label="Hardware">
          <option value="Processadores">Processadores</option>
          <option value="Placa-mãe">Placa-mãe</option>
          <option value="Memória RAM">Memória RAM</option>
          <option value="HDD">HDD</option>
          <option value="Externos">Externos</option>
        </optgroup>
        <optgroup label="Programação">
          <option value="C/C++">C/C++</option>
          <option value="Java">Java</option>
          <option value="HTML/PHP/JS">HTML/PHP/JS</option>
          <option value="Node.js">Node.js</option>
          <option value="Python">Python</option>
          <option value="Lógica de Programação">Lógica de Programação</option>
        </optgroup>
        <optgroup label="Eletrônica">
          <option value="Arduino">Arduino</option>
          <option value="Raspberry">Raspberry</option>
          <option value="Embarcados">Embarcados</option>
        </optgroup>
        <optgroup label="Software">
          <option value="S. Operacionais">S. Operacionais</option>
          <option value="Photoshop">Photoshop</option>
          <option value="CorelDraw">CorelDraw</option>
          <option value="Rainmeter">Rainmeter</option>
          <option value="CodeBlocks">CodeBlocks</option>
          <option value="Unity">Unity</option>
        </optgroup>
      <option value="Outros">Outros</option>
      </select>
      <textarea name="corpo" placeholder="Explique sua dúvida aqui." style="width: 100%; height: 250px; border: 2px solid #DCDCDC; margin: 0; background-color: #000000; color: #32CD32;"></textarea>
      <input type="reset" value="Limpar" class="botao">&nbsp;<input name="envia" type="submit" value="Enviar" class="botao">
    </form>
    <?php
      if($_POST['envia'] == 'Enviar') {
        $titulo = $_POST['titulo'];
        $corpo = $_POST['corpo'];
        $categoria = $_POST['categoria'];
        if(!empty($categoria) && !empty($corpo) && !empty($titulo)) {
          mysql_query("INSERT INTO topicos (usuario, nome_top, corpo_top, categoria, data, hora) VALUES ('$nickname', '$titulo', '$corpo', '$categoria', '$dateA', '$hour')");
          echo "<meta http-equiv='refresh' content='0, url=recentes.php'>";
        }
      }
    ?>
    <br>
    <br>
    <br>
    <br>

    </section>


    <?php include("footer-soft.php"); ?>
  </body>
</html>
