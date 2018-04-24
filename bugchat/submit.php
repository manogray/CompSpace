<?php
  if(isset($_POST['mensagem'])){
    mysql_connect('database_devx.mysql.dbaas.com.br','database_devx','luis1995');
    mysql_select_db('database_devx');
    
    $mensagem = strip_tags(trim($_POST['mensagem']));
    $user = strip_tags(trim($_POST['profile']));
    $amigo = strip_tags(trim($_POST['colega']));
    
    $aaa = 'aaa';
    
    echo "<script>alert('<?=$user?>')</script>"
    
    if(!empty($mensagem)){
      mysql_query("INSERT INTO mensagens_chat (remetente, mensagem, destinatario) VALUES ('$user', '$mensagem', '$amigo')");
      echo 'ok';
    }
  }
?>