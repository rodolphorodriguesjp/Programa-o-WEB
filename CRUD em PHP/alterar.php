<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<?php
$pdo = new PDO('mysql:host=localhost;dbname=aulaprogweb', 'root', '');

if (isset($_GET['cod_cliente'])) {
    $cod_cliente = (int)$_GET['cod_cliente'];
    //mount form whit data
    $sql = $pdo->prepare("SELECT * FROM tab_cliente WHERE cod_cliente = $cod_cliente");
    $sql->execute();
    $alunos = $sql->fetchAll();

    //montar formulário com os dados dos clientes
    foreach ($clientes as $cliente) {
        echo "<form method='POST'>";
        echo "<legend>Insira os dados abaixo</legend>";
        echo "<fieldset>";
        echo "<div>";
        echo "Nome: <input type='text' class='form-control' name='nome' value='" . $cliente['nome'] . "'>";
        echo "</div>";
        echo "<div>";
        echo "CPF: <input type='text' class='form-control' name='cpf' value='" . $cliente['cpf'] . "'>";
        echo "</div>";
        echo "<div>";
        echo "E-mail: <input type='text' class='form-control' name='e-mail' value='" . $cliente['e-mail'] . "'>";
        echo "</div>";
        echo "<div>";
        echo "<input type='submit' class='btn btn-primary' value='Enviar'>";
        echo "<input type='reset' class='btn btn-primary' value='Limpar Dados'>";
        echo "</div>";
        echo "<br>";
        echo "</fieldset>";
        echo "</form>";
    }

    
}

if (isset($_POST['nome'])) {
    
    //alterando dados da tabela tab_cliente com os dados do form
    $sql = $pdo->prepare("UPDATE tab_cliente SET nome = ?, cpf = ?, 'e-mail' = ? WHERE cod_cliente = $cod_cliente");
    $sql->execute(array($_POST['nome'], $_POST['cpf'], $_POST['e-mail']));
    echo "<h1>Usuário com id = $cod_cliente alterado com sucesso!</h1>";
    //fazer botao para voltar para a pagina de listagem
    echo "<a href='index.php'>Voltar</a>";

    
}