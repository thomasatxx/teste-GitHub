<?php
// CONEXAO COM O ARQUIVO DO BANCO
require 'conexao.php';

// SELECT DOS PRODUTOS
$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (null == $id) {
    header("Location: index.php");
} else {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM produtos join preco on produtos.IDPROD = preco.IDPRODUTO WHERE IDPROD = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Banco::desconectar();
}
?>

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
        <div>
            <div>
                <div class="navbar">
                    <h2>Informações do Produto</h2>
                </div>
                <br>
                <div>

                    <div>
                        <label>Nome:</label>                        
                            <input class="form-control" name="nome" value="<?php echo $data['NOME']; ?>" disabled>                       
                    </div>

                    <div>
                        <label>Cor:</label>
                            <input class="form-control" name="nome" value="<?php echo $data['COR']; ?>" disabled>
                    </div>

                    <div>
                        <label>Preço:</label>
                            <input class="form-control" onkeypress="$(this).mask('R$ #.##0,00', {reverse: true});" name="nome" value="<?php echo $data['PRECO']; ?>" disabled>
                    </div>

                    <br/>
                    <div>
                        <a href="index.php" class="btn bt-am">Voltar</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
<!-- FIM DO CORPO DA PAGINA -->

<!-- SCRIPS PARA FORMATAÇAO DE MOEDA -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

</html>