<?php
    session_start();
    require_once("../class/conexaoCSdb.php");
    
    include("../class/Usuario.php");

        $retorno = "<div><img src='../images/loading.gif'></div>";

      	if(isset($_POST['acao']) && $_POST['acao'] == 'enviado') {
          $nick = $_POST['nick'];
          $senha = md5($_POST['senha']);
          
          if(empty($nick) || empty($senha)) {
            echo "<meta http-equiv='refresh' content='0, url=../'>";
          } else {
              $resultLoginNick = $mysqli->query("SELECT * FROM tb_usuarios WHERE BINARY nickmane = '$nick' AND BINARY senha = '$senha'");
              $resultLoginEmail = $mysqli->query("SELECT * FROM tb_usuarios WHERE BINARY email = '$nick' AND BINARY senha = '$senha'");
              $LoginNick = $resultLoginNick->fetch_assoc();
              $LoginEmail = $resultLoginEmail->fetch_assoc();

              $VerificaNick = $resultLoginNick->num_rows;
              $VerificaEmail = $resultLoginEmail->num_rows;

              if($VerificaNick == 1){
                $NovoUsuario = new Usuario($LoginNick['id'],$LoginNick['nome'],$LoginNick['nickmane'],$LoginNick['email'],$LoginNick['genero'],$LoginNick['nascimento'],$LoginNick['estado'],$LoginNick['cidade'],$LoginNick['universidade'],$LoginNick['curso'],$LoginNick['tipo'],$LoginNick['favoritos'], $LoginNick['perfil']);
                $_SESSION['UsuarioLogado'] = serialize($NovoUsuario);
                echo "<meta http-equiv='refresh' content='0, url=../panel/home.php'>";
              }

              if($VerificaEmail == 1){
                $NovoUsuario = new Usuario($LoginEmail['id'],$LoginEmail['nome'],$LoginEmail['nickmane'],$LoginEmail['email'],$LoginEmail['genero'],$LoginEmail['nascimento'],$LoginEmail['estado'],$LoginEmail['cidade'],$LoginEmail['universidade'],$LoginEmail['curso'],$LoginEmail['tipo'],$LoginEmail['favoritos'], $LoginEmail['perfil']);
                $_SESSION['UsuarioLogado'] = serialize($NovoUsuario);
                echo "<meta http-equiv='refresh' content='0, url=../panel/home.php'>";
              }else {
                $retorno = "<h3>Dados incorretos!</h3>";
              }
          }
            
        }
          
?>

<div>
  <?=$retorno?>
</div>