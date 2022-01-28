<?php
require 'conexao.php';


//Acompanha os erros de validação
// Processar so quando tenha uma chamada post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeErro = null;
    $corErro = null;
    $precoErro = null;

    if (!empty($_POST)) {
        $validacao = True;
        $novoUsuario = False;
        if (!empty($_POST['nome'])) {
            $nome = $_POST['nome'];
        } else {
            $nomeErro = 'Por favor digite o nome!';
            $validacao = False;
        }


        if (!empty($_POST['cor'])) {
            $cor = $_POST['cor'];
        } else {
            $corErro = 'Por favor digite a cor!';
            $validacao = False;
        }

        if (!empty($_POST['preco'])) {
            $preco = $_POST['preco'];
        } else {
            $precoErro = 'Por favor digite o preço!';
            $validacao = False;
        }

    }

//Inserindo no Banco:
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO produtos (nome, cor) VALUES(?,?)";
        $sql_sel = "SELECT * from produtos order by desc limit 1";          
        $sql2 = "INSERT INTO preco (preco, idproduto) VALUES (?,?)";
        $prepare_ins = $pdo->prepare($sql);
        $prepare_ins->execute(array($nome, $cor));
        $prepare_sel = $pdo->prepare($sql_sel);
        $prepare_sel->execute(array());
        $prepare_sql2 = $pdo->prepare($sql2);
        $prepare_sql2->execute(array($preco, $sql_sel['IDPROD']));
        Banco::desconectar();
        header("Location: index.php");
    }
}
?>
  <!-- FIM INSERRIR NO BANCO -->

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Adicionar Produto</title>
</head>

    <!-- CORPO DA PAGINA -->
<body>
<div>
    <div>
        <div >
            <div class="navbar">
                <h2> Adicionar Produto </h2>
            </div>
            <br>
            <div >
                <form action="insert.php" method="post">

                    <div <?php echo !empty($nomeErro) ? 'error ' : ''; ?>">
                        <label>Nome:</label>
                        <div>
                            <input size="50" class="form-control" name="nome" type="text" placeholder="Nome"
                                   value="<?php echo !empty($nome) ? $nome : ''; ?>">
                            <?php if (!empty($nomeErro)): ?>
                                <span class="text-danger"><?php echo $nomeErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div <?php echo !empty($corErro) ? 'error ' : ''; ?>">
                        <label>Cor:</label>
                        <div>
                            <input size="20" class="form-control" name="cor" type="text" placeholder="Cor"
                                   value="<?php echo !empty($cor) ? $cor : ''; ?>">
                            <?php if (!empty($corErro)): ?>
                                <span class="text-danger"><?php echo $corErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div <?php echo !empty($precoErro) ? 'error ' : ''; ?>">
                        <label>Preço:</label>
                        <div>
                            <input size="20" class="form-control" onkeypress="$(this).mask('R$ #.##0,00', {reverse: true});" name="preco" type="text" placeholder="Preço"
                                   value="<?php echo !empty($preco) ? $preco : ''; ?>">
                            <?php if (!empty($precoErro)): ?>
                                <span class="text-danger"><?php echo $precoErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    
                    </div>
                    <div>
                        <br/>
                        <button class="btn bt-az" type="submit">Adicionar</button>
                        
                        <a href="index.php"  class="btn bt-am">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

</body>
 <!-- FIM DO CORPO DA PAGINA -->

 <!-- SCRIPTS PARA MASCARA DE MOEDA -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
</html>