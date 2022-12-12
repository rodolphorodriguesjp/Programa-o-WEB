<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crud PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <?php
    $pdo = new PDO("mysql:host=localhost;dbname=aulaprogweb", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);

    if(isset($_GET['delete'])){
        $cod_cliente = (int) $_GET['delete'];
        $pdo->exec("DELETE FROM tab_cliente WHERE cod_cliente = $cod_cliente");
        echo "<h2>Cliente excluido com sucesso!</h2>";
    }

    if(isset($_POST['nome'])){
        $sql = $pdo->prepare("INSERT INTO `tab_cliente`Values (null,?,?,?)" );
        $sql->execute(array($_POST['nome'], $_POST['cpf'], $_POST['e-mail']));

        echo "<h2>Cliente cadastrado com sucesso!</h2>";
        
    }

?>


<div class="container">
    <form method="POST">
        <legend>
            <H1 align="center">Cadastro de Clientes</H1>
        </legend>
        <fieldset>
            <div>
                Nome: <input type="text" class="form-control" name="nome">
            </div>
            <div>
                CPF: <input type="text" class="form-control" name="cpf">
            </div>
            <div>
                E-mail: <input type="text" class="form-control" name="e-mail">
            </div>
            
            
            <div>
                <input type="submit" class="btn btn-primary" value="Enviar">

                <input type="reset" class="btn btn-primary" value="Limpar Dados">
            </div>

        </fieldset>

    </form>
</div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<?php 
$sql = $pdo->prepare("SELECT * FROM `tab_cliente`");
$sql->execute();
$alunos = $sql->fetchAll();

echo "<table class='table table-striped table-hover'>";
echo "<thead>";
echo "<tr>";
echo "<th scope='col' colspan'2' aling='center'>Ações</th>";

echo "<th scope='col'>Nome</th>";
echo "<th scope='col'>CPF</th>";
echo "<th scope='col'>E-mail</th>";
echo "</tr>";
echo "</thead>";

foreach ($clientes as $cliente) {
    echo "</tr>";
    echo'<td align="center">
    <a href="?delete=' . $cliente['cod_cliente'] . '">( X )</a> </td>';
    echo '<td align="center"> 
    <a href="alterar.php?cod_aluno=' . $cliente['cod_cliente'] . '">( Alterar )</a> </td>';

    echo "<td>" . $cliente['nome'] . "</td>";
    echo "<td>" . $cliente['cpf'] . "</td>";
    echo "<td>" . $cliente['e-mail'] . "</td>";
    echo "</tr>";
}


?>

  </body>
</html>
