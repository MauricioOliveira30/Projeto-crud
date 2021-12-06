<?php
include('conexao.php');

try {
    $sql = "SELECT * from venda";
    $qry = $con->query($sql);
    $venda = $qry->fetchAll(PDO::FETCH_OBJ);
    //echo "<pre>";
    //print_r($clientes);
    //die();
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documento do Senac</title>
</head>

<body>

    <h1>Lista de Vendas</h1>
    <hr>
    <a href="frmvendas.php">Novo Cadastro</a>
    <hr>
    <table border=1>
        <thead>
            <tr>
                <th>id</th>
                <th>Idproduto</th>
                <th>Idvendedor</th>
                <th>Quantidade</th>
                <th colspan=2>Ações</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($venda as $vendas) { ?>
                <tr>
                    <td><?php echo $vendas->idvendas ?></td>
                    <td><?php echo $vendas->vendas ?></td>
                    <td><?php echo $vendas->idproduto ?></td>
                    <td><?php echo $vendas->idvendedores ?></td>
                    <td><?php echo $vendas->qtd ?></td>
                    <td><a href="frmvendas.php?idvendas=<?php echo $vendas->idvendas ?>">Editar</a></td>
                    <td><a href="frmvendas.php?op=del&idvendas=<?php echo  $vendas->idvendas ?>">Excluir</a></td>

                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="index.php">Voltar</a>
</body>

</html>