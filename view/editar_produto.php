<?php
// Incluir o controlador
require_once '../controller/ProdutoController.php';

// Verificar se o ID foi passado via GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Criar o controlador
    $controller = new ProdutoController();

    // Carregar os dados do cliente pelo ID
    $produto = $controller->buscarProduto($id);  // Agora você chama o método corretamente
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Processar a edição do cliente

    // Verificar se o ID está presente
    if (isset($id)) {
        // Pegar os dados do formulário
        $nome = $_POST['nome_produto'];
        $quantidade = $_POST['quantidade'];
        $cod = $_POST['cod_produto'];

        // Atualizar o cliente chamando o método de alterar
        $controller->alterar($id, $nome, $quantidade, $cod);

        // Redirecionar ou mostrar mensagem de sucesso
        header('Location: index.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produtos</title>
    <link rel="stylesheet" href="css/editar_produto.css"> <!-- Linkando o arquivo CSS -->
</head>
<body>
    <h1>Editar Produto</h1>

    <form method="POST">
        <label for="nome">Nome</label>
        <input type="text" name="nome_produto" value="<?= isset($produto['nome_produto']) ? $produto['nome_produto'] : ''; ?>" required><br>

        <label for="email">Quantidade</label>
        <input type="text" name="quantidade" value="<?= isset($produto['quantidade']) ? $produto['quantidade'] : ''; ?>" required><br>

        <label for="telefone">Código Produto</label>
        <input type="text" name="cod_produto" value="<?= isset($produto['cod_produto']) ? $produto['cod_produto'] : ''; ?>" required><br>

        <button type="submit">Alterar Cliente</button>
    </form>  
</body>
</html>

