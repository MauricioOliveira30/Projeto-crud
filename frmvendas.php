    <?php

    $idvendas = isset($_GET["idvendas"]) ? $_GET["idvendas"] : null;
    $op = isset($_GET["op"]) ? $_GET["op"] : null;


    try {
        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $bd = "bdprojeto";
        $con = new PDO("mysql:host=$servidor;dbname=$bd", $usuario, $senha);

        if ($op == "del") {
            $sql = "delete  FROM  venda where idvendas=:idvendas";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idvendas", $idvendas);
            $stmt->execute();
            header("Location:listarvendas.php");
        }


        if ($idvendas) {
            //estou buscando os dados do cliente no BD
            $sql = "SELECT * FROM  venda
            where idvendas= :idvendas";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idvendas", $idvendas);
            $stmt->execute();
            $vendas = $stmt->fetch(PDO::FETCH_OBJ);
            //var_dump($cliente);
        }
        if ($_POST) {
            if ($_POST["idvendas"]) {
                $sql = "UPDATE venda SET vendas=:vendas,  idproduto=:idproduto, idvendedores=:idvendedores WHERE idvendas =:idvendas";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":vendas", $_POST["vendas"]);
                $stmt->bindValue(":idproduto", $_POST["idproduto"]);
                $stmt->bindValue(":idvendedores", $_POST["idvendedores"]);
                $stmt->bindValue(":idvendas", $_POST["idvendas"]);
                $stmt->execute();
            } else {
                $sql = "INSERT INTO venda(vendas,idproduto,qtd,idvendedores) VALUES (:vendas,:idproduto,:qtd,:idvendedores)";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":vendas", $_POST["vendas"]);
                $stmt->bindValue(":idproduto", $_POST["idproduto"]);
                $stmt->bindValue(":qtd", $_POST["qtd"]);
                $stmt->bindValue(":idvendedores", $_POST["idvendedores"]);
                $stmt->execute();
            }
            header("Location:listarvendas.php");
        }
    } catch (PDOException $e) {
        echo "erro" . $e->getMessage;
    }

    ?>
    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Projeto CRUD</title>
    </head>

    <body>
        <h1>Cadastro de Vendas</h1>
        <form method="POST">
            Vendas <input type="text" name="vendas" value="<?php echo isset($vendas) ? $vendas->vendas : null ?>"><br>
            Produto <input type="text" name="idproduto" value="<?php echo isset($vendas) ? $vendas->idproduto : null ?>"><br>
            Quantidade <input type="text" name="qtd" value="<?php echo isset($vendas) ? $vendas->qtd : null ?>"><br>
            Vendedores <input type="text" name="idvendedores" value="<?php echo isset($vendas) ? $vendas->idvendedores : null ?>"><br>
            <input type="hidden" name="idvendas" value="<?php echo isset($vendas) ? $vendas->idvendas : null ?>">
            <input type="submit">
        </form>
        <a href="listarprodutos.php">Voltar</a>
    </body>

    </html>