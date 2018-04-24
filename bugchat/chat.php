<?php
  mysql_connect('database_devx.mysql.dbaas.com.br','database_devx','luis1995');
  mysql_select_db('database_devx');
?>

<!DOCTYPE html>
<html>
  <?php include("head.php");
    $user = $_SESSION['user_session'];
  ?>
  <title>BugChat</title>
  <body class="chatWallpaper">
    <h2>Mensagens</h2>
    <aside id="users_online">
      <ul>
        <?php
          $gray = 'sim';
          $query = sprintf("SELECT * FROM tb_usuarios WHERE BINARY chat = '$gray' AND nickmane != '$user'");
          $result = mysql_query($query);
          $linha = mysql_fetch_assoc($result);
        
          do {
        ?>
        <li id="<?=$linha['nickmane']?>">
          <div class="imgSmall"><img src="users/default.jpg" border="0"></div>
          <?php
            $cor = 'white';
            $tipo = '';
            if ($linha['tipo'] == 'adm') {
              $cor = 'red';
              $tipo = '(Adm)';
            }
          ?>
          <a href="?friend=<?=$linha['nickmane']?>" id="<?=$user?>:<?=$linha['nickmane']?>" class="comecar"><strong style="color: <?=$cor?>;"><?=$linha['nickmane']?> <?=$tipo?></strong></a>
          <span id="<?=$linha['nickmane']?>" class="status <?=$linha['status']?>"></span>
        </li>
        <?php
          }while($linha = mysql_fetch_assoc($result));
        ?>
      </ul>
    </aside>
    <aside>
      <?php
        $display = 'none';
        if(isset($_GET['friend'])) {
          $display = 'block';
          $_SESSION['amigo_session'] = $_GET['friend'];
          $amigo = $_GET['friend'];
          //echo "<meta http-equiv='refresh' content='17, url=chat.php?friend=$amigo'>";
        } else {
          //echo "<meta http-equiv='refresh' content='5, url=chat.php'>";
        }
      ?>
      
      <div class="window" style="display: <?=$display?>" id="janela">
        <?php
          $query2 = sprintf("SELECT * FROM tb_usuarios WHERE BINARY nickmane = '$amigo'");
          $result2 = mysql_query($query2);
          $linha2 = mysql_fetch_assoc($result2);
        ?>
        <div class="header_window"><a class="close" href="chat.php">X </a><span class="name"><strong><?=$amigo?></strong></span><span id="5" class="status <?=$linha2['status']?>"></span></div>
        <div class="body_window" id="corpo-wind" onload="scroll()">
          <div class="mensagens" id="msgg">
            
          </div>
        </div>
        <div class="send_message" id="3:5">
          <textarea autofocus type="text" name="mensagem" class="msg" id="3:5"></textarea>
       </div>
      </div>
    </aside>
    <aside id="menu-lateral">
      <ul>
        <li>
          <div><a href="http://developersfactoryx.com">Developers</a></div>
        </li>
        <li>
          <div><a href="#">SoftClub</a></div>
        </li>
        <li>
          <div><a href="?go=sair">Sair</a></div>
          <?php
            if(@$_GET['go'] == 'sair') {
            unset($_SESSION['user_session']);
            unset($_SESSION['password_session']);
            $up = mysql_query("UPDATE tb_usuarios SET status='off' WHERE BINARY nickmane = '$user'");
            echo "<meta http-equiv='refresh' content='0, ./'>";
            }
          ?>
        </li>
      </ul>
    </aside>
    <aside id="chats">
    </aside>
    <script src="js/jquery-3.2.1.js"></script>
  <script>
    $.noConflict();
    
    $(document).ready(function() {
      $('#msgg').load('msgs.php');
      $('users_online').load();
      $('#corpo-wind').animate({scrollTop: $('#corpo-wind')[0].scrollHeight}, 1);
      refresh();
    });
    
    function refresh()
    {
      setTimeout(function() {
        $('#msgg').load('msgs.php');
        $('users_online').load();
        $('#corpo-wind').animate({scrollTop: $('#corpo-wind')[0].scrollHeight}, 1);
        refresh();
      }, 1000);
    }
    
    
    $('body').on('keyup', '.msg', function(e){
      if(e.which == 13) {
        var mensagem = $(this).val();
        var profile = '<?=$user?>';
        var colega = '<?=$amigo?>';
        
        $.ajax({
          type: 'POST',
          url: 'submit.php',
          data: {mensagem: mensagem, user: profile, friend: colega},
          success: function(retorno) {
            if(retorno == 'ok'){
              $('.msg').val('');
            } else {
              $('.msg').val('');
              alert("Ocorreu um erro ao enviar a mensagem!");
            }
          }
        });
      }
    });
  </script>
  </body>
</html>