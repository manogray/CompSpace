<?php
  session_start();
  if(!isset($_SESSION['user_session']) && !isset($_SESSION['password_session'])) {
    echo "<meta http-equiv='refresh' content='0, url=http://developersfactoryx.com'>";
  }
?>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/estiloSOFT.css">
  <link rel="icon" href="images/icone-soft.png" type="image/x-icon">
  <link rel="shortcut icon" href="images/icone-soft.png" type="image/x-icon">
</head>