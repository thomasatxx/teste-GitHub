<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Página Inicial</title>
</head>

<!-- CORPO DA PAGINA -->
<body>
    <div>
        <div class="navbar">
            <h2>TESTE PHP</h2>
        </div>
    <br>
        <div>
            <form method="POST" action="pesquisar.php">
                <label>Pesquisar: </label>
                <input type="text" name="pesquisar">
                <input class="btn bt-az" type="submit" value="Pesquisar">
            </form>
        </div>

        </br>

        <p>
            <a class="btn bt-az" href="insert.php">Adicionar</a>
        </p>

        <div>
            <!-- TABELA PARA MOSTRAR OS REGISTROS  -->
            <table border="1">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nome Produto</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Cor</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'conexao.php';
                    $pdo = Banco::conectar();
                    $sql = 'SELECT * FROM `produtos` 
                        join preco on produtos.IDPROD = preco.IDPRODUTO 
                        ORDER BY IDPROD DESC';

                    foreach ($pdo->query($sql) as $row) {
                        echo '<tr>';
                        echo '<th scope="row">' . $row['IDPROD'] . '</th>';
                        echo '<td>' . $row['NOME'] . '</td>';
                        echo '<td>' . number_format($row['PRECO'], 2, ",", ".") . '</td>';
                        echo '<td>' . $row['COR'] . '</td>';
                        echo '<td width=250>';
                        echo '<a class="" href="select.php?id=' . $row['IDPROD'] . '">Info</a>';
                        echo ' ';
                        echo '<a class="" href="update.php?id=' . $row['IDPROD'] . '">Atualizar</a>';
                        echo ' ';
                        echo '<a class="" href="delete.php?id=' . $row['IDPROD'] . '">Excluir</a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    Banco::desconectar();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
<!-- FIM DO CORPO DA PAGINA -->
</html>