<?php
// CONEXAO COM O ARQUIVO DO BANCO
require 'conexao.php';

$id = 0;

if(!empty($_GET['id']))
{
    $id = $_REQUEST['id'];
}

if(!empty($_POST))
{
    $id = $_POST['id'];

    //Delete do banco:
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM produtos where IDPROD = ?";
    $sql2 = "DELETE FROM preco where IDPRECO = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $q = $pdo->prepare($sql2);
    $q->execute(array($id));
    Banco::desconectar();
    header("Location: index.php");
}
?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Deletar Produto</title>
    </head>
<!-- INICIO DO CORPO DA PAGINA -->
    <body>
        <div >
            <div>
                <div class="navbar">
                    <h2>Excluir Produto</h2>
                </div>
                <br>
                <form class="form-horizontal" action="delete.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id;?>" />
                    <div> 
                        <h3>Deseja excluir o produto?</h3>
                    </div>
                    <div>
                        <button class="btn bt-vm" type="submit">Sim</button>
                        <a href="index.php" class="btn bt-am">Não</a>
                    </div>
                </form>
            </div>
        </div>
    </body>
<!-- FIM DO CORPO DA PAGINA -->
    </html>