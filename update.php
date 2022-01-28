<?php
// CONEXAO COM O ARQUIVO DO BANCO
require 'conexao.php';

$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (null == $id) {
    header("Location: index.php");
}

if (!empty($_POST)) {

    $nomeErro = null;
    $corErro = null;

    $nome = $_POST['nome'];
    $cor = $_POST['cor'];
    $preco = $_POST['preco'];


    //Validação
    $validacao = true;
    if (empty($nome)) {
        $nomeErro = 'Por favor digite o nome!';
        $validacao = false;
    }

    if (empty($cor)) {
        $corErro = 'Por favor digite a cor!';
        $validacao = false;
    }

    if (empty($preco)) {
        $corPreco = 'Por favor digite o preço!';
        $validacao = false;
    }

    // update data
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE produtos  set nome = ?, cor = ? WHERE IDPROD = ?";
        $sql2 = "UPDATE preco set preco = ? WHERE IDPRECO = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $cor, $id));
        $q = $pdo->prepare($sql2);
        $q->execute(array($preco, $id));
        Banco::desconectar();
        header("Location: index.php");
    }
} else {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM produtos join preco on produtos.IDPROD = preco.IDPRODUTO WHERE IDPROD = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $nome = $data['NOME'];
    $cor = $data['COR'];
    $preco = $data['PRECO'];

    Banco::desconectar();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Atualizar Produto</title>
</head>

<!-- INCIO DO CORPO DA PAGINA -->
<body>
    <div>
        <div class="navbar">
            <h2> Atualizar Produto </h2>
        </div>

        <br>

        <div>
            <form action="update.php?id=<?php echo $id ?>" method="post">

                <div <?php echo !empty($nomeErro) ? 'error' : ''; ?>">
                    <label>Nome:</label>
                    <div>
                        <input class="form-control" name="nome" type="text" value="<?php echo !empty($nome) ? $nome : ''; ?>">
                        <?php if (!empty($nomeErro)) : ?>
                            <span><?php echo $nomeErro; ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div <?php echo !empty($corErro) ? 'error' : ''; ?>">
                    <label>Cor:</label>
                    <div>
                        <input class="form-control" name="cor" type="text" value="<?php echo !empty($cor) ? $cor : ''; ?>">
                        <?php if (!empty($corErro)) : ?>
                            <span><?php echo $corErro; ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div <?php echo !empty($corPreco) ? 'error' : ''; ?>">
                    <label>Preço:</label>
                    <div>
                        <input class="form-control" name="preco" onkeypress="$(this).mask('R$ #.##0,00', {reverse: true});" type="text" value="<?php echo !empty($preco) ? $preco : ''; ?>">
                        <?php if (!empty($corPreco)) : ?>
                            <span><?php echo $corPreco; ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <br/>

                <div>
                    <button type="submit" class="btn bt-vd">Atualizar</button>
                    <a href="index.php" class="btn bt-am">Voltar</a>
                </div>

            </form>
        </div>
    </div>

</body>
<!-- FIM DO CORPO DA PAGINA -->

<!-- SCRIPS PARA FORMATAÇÃO DE MOEDA -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
</html>