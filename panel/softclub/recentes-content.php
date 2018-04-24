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
    <ul style="list-style-type: none;">
    <?php
        $query = sprintf("SELECT id, usuario, nome_top, categoria, data, hora FROM topicos order by id desc");
        $dados = mysql_query($query, $con) or die(mysql_error());
        $linha = mysql_fetch_assoc($dados);
        $total = mysql_num_rows($dados);
        
        if($total > 0) {
          do {
      ?>
      <li class="topico"><div><a href="topico.php?id=<?=$linha['id']?>"><?=$linha['nome_top']?></a></div><br><ul style="list-style-type: none; color: #32CD32"><li>Usuário: <?=$linha['usuario']?></li><li id="cat">Categoria: <?=$linha['categoria']?></li><li id="dat"><?=$linha['data']?> - <?=$linha['hora']?></li></ul></li>
      <br>
      <br>
      
      <?php
          }while($linha = mysql_fetch_assoc($dados));
        } else {
          echo "<p>Nenhum tópico</p>";
        }
      ?>
      </ul>

    </section>


    <?php include("footer-soft.php"); ?>
  </body>