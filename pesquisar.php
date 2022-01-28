 <!DOCTYPE html>
 <html lang="pt-br">

 <head>
     <meta charset="utf-8">

     <link rel="stylesheet" type="text/css" href="style.css">
     <title>Informações do Produto</title>
 </head>
<!-- INICIO DO CORPO DA PAGINA -->
 <body>
     <div>

         <div class="navbar">
             <h2>Informações do Produto</h2>
         </div>
         <br>
         <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbname = "teste";
            //Criar a conexao
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

            $pesquisar = $_POST['pesquisar'];
            $result_prod = "SELECT * FROM produtos join preco on produtos.IDPROD = preco.IDPRODUTO WHERE nome LIKE '%$pesquisar%' LIMIT 5";
            $resultado_prod = mysqli_query($conn, $result_prod);

            while ($rows_prod = mysqli_fetch_array($resultado_prod)) {

                echo "Nome do Produto: " . $rows_prod['NOME'] . "<br>";
                echo "Cor do Produto: " . $rows_prod['COR'] . "<br>";
                echo "Preço do Produto: " . $rows_prod['PRECO'] . "<br>";
            }
            ?>
            <br>
         <div>
             <a href="index.php" class="btn bt-am">Voltar</a>
         </div>


     </div>
     </div>
 </body>
<!-- FIM DO CORPO DA PAGINA -->
 </html>