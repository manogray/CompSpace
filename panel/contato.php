<!DOCTYPE html>
<html>
  <?php include("head.php"); ?>
  <body>
    
    <?php include("banner.php"); ?>

    <section>
    <h2>Developers Factory X</h2>

    <h3><strong>Possui alguma dúvida ?</strong></h3>
    <p>Então escreve ela logo aí embaixo que vamos ter o prazer de responder.</p>
    <p>Ou caso seja uma sugestão, reclamação, correção ou qualquer outra coisa, escreve pra gente também =D</p>

    <br>
    <br>

    <form method="post">
      
      <input  class="caixa-texto" type="text" name="nome" placeholder="Insira seu nome" maxlength="100"><br><br>
      
      <input  class="caixa-texto" type="text" name="idade" placeholder="Idade" maxlength="3"><br><br>
      
      <input class="caixa-texto" type="text" name="email" placeholder="E-mail"><br><br>

      <textarea class="caixa-texto" name="texto" placeholder="Escreva sua mensagem!"></textarea><br><br>
      
      <input type="submit" value="Enviar!">
    </form>
    
    <?php
    $conexao = pg_connect("host=contatosdevfac.postgresql.dbaas.com.br port=5432 dbname=contatosdevfac user=contatosdevfac password=luis1995");
    
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $email = $_POST['email'];
    $msg = $_POST['texto'];
    
    $resultado = empty($nome) || empty($idade) || empty($email) || empty($msg);
    
    if(!$resultado) {
      $sql = "INSERT INTO tb_mensagens (nome,idade,email,mensagem) VALUES ($nome,$idade,$email,$msg)";
    
      pg_query($conexao,$sql);
      echo "Enviado!";
      pg_close($conexao);
    }
    
    ?>  

    </section>

    <?php include("footer.php"); ?>
  </body>
</html>
