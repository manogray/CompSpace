<?php
  session_start();
  if(!isset($_SESSION['user_session']) && !isset($_SESSION['password_session'])) {
    echo "<meta http-equiv='refresh' content='0, url=index.php'>";
  }
?>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/estiloBUG.css">
  <link rel="icon" href="images/icone.png" type="image/x-icon">
  <link rel="shortcut icon" href="images/icone.png" type="image/x-icon">
  <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
</head>