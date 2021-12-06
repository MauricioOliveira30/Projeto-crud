    <?php
    include('conexao.php');

    try {
        $sql = "SELECT * from vendedor";
        $qry = $con->query($sql);
        $vendedor = $qry->fetchAll(PDO::FETCH_OBJ);
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

        <h1>Lista de Vendedores</h1>
        <hr>
        <a href="frmvendedores.php">Novo Cadastro</a>
        <hr>
        <table border=1>
            <thead>
                <tr>
                    <th>id</th>
                    <th>Vendedores</th>
                    <th>Data de Admissão</th>
                    <th>Salário</th>
                    <th colspan=2>Ações</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($vendedor as $vendedores) { ?>
                    <tr>
                        <td><?php echo $vendedores->idvendedores ?></td>
                        <td><?php echo $vendedores->vendedores ?></td>
                        <td><?php echo $vendedores->dataadmissao ?></td>
                        <td><?php echo $vendedores->salario ?></td>
                        <td><a href="frmvendedores.php?idvendedores=<?php echo $vendedores->idvendedores ?>">Editar</a></td>
                        <td><a href="frmvendedores.php?op=del&idvendedores=<?php echo  $vendedores->idvendedores ?>">Excluir</a></td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="index.php">Voltar</a>
    </body>

    </html>