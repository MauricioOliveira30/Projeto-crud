<?php
include('conexao.php');

try {
    $sql = "SELECT * from cliente";
    $qry = $con->query($sql);
    $clientes = $qry->fetchAll(PDO::FETCH_OBJ);
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

    <h1>Lista de Clientes</h1>
    <hr>
    <a href="frmclientes.php">Novo Cadastro</a>
    <hr>
    <table border=1>
        <thead>
            <tr>
                <th>id</th>
                <th>Cliente</th>
                <th>email</th>
                <th colspan=2>Ações</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $cliente) { ?>
                <tr>
                    <td><?php echo $cliente->idcliente ?></td>
                    <td><?php echo $cliente->nome ?></td>
                    <td><?php echo $cliente->email ?></td>
                    <td><a href="frmclientes.php?idcliente=<?php echo $cliente->idcliente ?>">Editar</a></td>
                    <td><a href="frmclientes.php?op=del&idcliente=<?php echo  $cliente->idcliente ?>">Excluir</a></td>

                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="index.php">Voltar</a>
</body>

</html>