<?php
  $con = mysql_connect('database_devx.mysql.dbaas.com.br','database_devx','luis1995');
  mysql_select_db('database_devx');
?>

<!DOCTYPE html>
<html>
  <?php include("head-soft.php"); ?>
  <title>Recentes</title>
  <?php include("recentes-content.php")?>
</html>
