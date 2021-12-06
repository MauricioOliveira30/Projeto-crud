    <?php

    $idvendedores = isset($_GET["idvendedores"]) ? $_GET["idvendedores"] : null;
    $op = isset($_GET["op"]) ? $_GET["op"] : null;


    try {
        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $bd = "bdprojeto";
        $con = new PDO("mysql:host=$servidor;dbname=$bd", $usuario, $senha);

        if ($op == "del") {
            $sql = "delete  FROM  vendedor where idvendedores=:idvendedores";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idvendedores", $idvendedores);
            $stmt->execute();
            header("Location:listarvendedores.php");
        }


        if ($idvendedores) {
            //estou buscando os dados do cliente no BD
            $sql = "SELECT * FROM  vendedor
            where idvendedores= :idvendedores";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idvendedores", $idvendedores);
            $stmt->execute();
            $vendedores = $stmt->fetch(PDO::FETCH_OBJ);
            //var_dump($cliente);
        }
        if ($_POST) {
            if ($_POST["idvendedores"]) {
                $sql = "UPDATE vendedor SET vendedores=:vendedores,  dataadmissao=:dataadmissao, salario=:salario WHERE idvendedores =:idvendedores";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":vendedores", $_POST["vendedores"]);
                $stmt->bindValue(":dataadmissao", $_POST["dataadmissao"]);
                $stmt->bindValue(":salario", $_POST["salario"]);
                $stmt->bindValue(":idvendedores", $_POST["idvendedores"]);
                $stmt->execute();
            } else {
                $sql = "INSERT INTO vendedor(vendedores,dataadmissao,salario) VALUES (:vendedores,:dataadmissao,:salario)";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":vendedores", $_POST["vendedores"]);
                $stmt->bindValue(":dataadmissao", $_POST["dataadmissao"]);
                $stmt->bindValue(":salario", $_POST["salario"]);
            
                $stmt->execute();
            }
            header("Location:listarvendedores.php");
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
        <h1>Cadastro de Vendedores</h1>
        <form method="POST">
            Vendedores <input type="text" name="vendedores" value="<?php echo isset($vendedores) ? $vendedores->vendedores : null ?>"><br>
            Data de Admissão <input type="date" name="dataadmissao" value="<?php echo isset($vendedores) ?$vendedores->dataadmissao : null ?>"><br>
            Salário <input type="text" name="salario" value="<?php echo isset($vendedores) ? $vendedores->salario : null ?>"><br>
            <input type="hidden" name="idvendedores" value="<?php echo isset($vendedores) ? $vendedores->idvendedores : null ?>">
            <input type="submit">
        </form>
        <a href="listarvendedores.php">Voltar</a>
    </body>

    </html>