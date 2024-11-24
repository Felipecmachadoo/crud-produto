<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/inserir_produto.css" rel="stylesheet">
    <title>Cadastrar Produto</title>
</head>
<body>
    <?php
    // Incluir o controlador
    require_once '../controller/ProdutoController.php';

    // Verificar se o formulário foi enviado (via POST)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Criar uma instância do controlador e chamar o método de inclusão
        $produtoControlador = new ProdutoController();
        $produtoControlador->incluir(); // Isso vai processar a inclusão no banco
    }
    ?>

    <h1>Cadastre seu Produto!</h1>
    
    <!-- O formulário envia os dados para a própria página -->
    <form action="inserir_produto.php" method="POST" class="form-produto">
        <label for="nome">Nome do produto </label>
        <input type="text" name="nome_produto" required><br>

        <label for="number">Quantidade </label>
        <input type="text" name="quantidade" required><br>

        <label for="cod">Código do Produto </label>
        <input type="text" name="cod_produto" required><br>

        <a href="../index.php" class="btn-submit"><button type="submit" class="btn-submit">Enviar</button></a>
    </form>
</body>
</html>
