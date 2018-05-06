<?php
  mysql_connect('database_devx.mysql.dbaas.com.br','database_devx','luis1995');
  mysql_select_db('database_devx');

  session_start();

  $user = $_SESSION['user_session'];

  $amigo = $_SESSION['amigo_session'];
?>
<script src="js/jquery-3.2.1.js"></script>
<meta charset="utf-8">
<link rel="stylesheet" href="css/estiloBUG.css">
            <ul>
              <?php
                $query3 = sprintf("SELECT * FROM mensagens_chat WHERE (BINARY remetente = '$user' AND BINARY destinatario = '$amigo') OR (BINARY remetente = '$amigo' AND BINARY destinatario = '$user') order by id asc");
                $result3 = mysql_query($query3);
                $linha3 = mysql_fetch_assoc($result3);
                $total3 = mysql_num_rows($result3);
                
                if($total3 > 0) {
          
                  do {
                    if($linha3['remetente'] == $user) {
                      $class = 'eu';
                    } else {
                      $class = '';
                    }
              ?>
              <li class="<?=$class?>"><p><?=$linha3['mensagem']?></p></li><br>
              <?php
                  }while($linha3 = mysql_fetch_assoc($result3));
                }
              ?>
            </ul>