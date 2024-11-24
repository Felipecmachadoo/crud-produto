<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Produtos</title>
    <link rel="stylesheet" href="css/produto_list.css">
</head>
<body>
    <h1>Lista de Produtos</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Código Produto</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once "../controller/ProdutoController.php";
            
            // Criando o controlador
            $controller = new ProdutoController();
            // Se houver um termo de pesquisa, busque os clientes com base nesse termo
            $produtos = $controller->listarTodos();
            
            foreach ($produtos as $produto) { 
                echo "<tr>"
                    . "<td>" . $produto['id'] . "</td>"
                    . "<td>" . $produto['nome_produto'] . "</td>"
                    . "<td>" . $produto['quantidade'] . "</td>"
                    . "<td>" . $produto['cod_produto'] . "</td>"
                    . "<td>"
                        // Link para editar cliente
                        . "<a href='editar_produto.php?id=" . $produto['id'] . "' class='btn edit'>Editar</a>"
                        // Link para excluir cliente
                        . "<a href='excluir_produto.php?id=" . $produto['id'] . "' class='btn delete' onclick='return confirm(\"Tem certeza que deseja excluir este cliente?\");'>Excluir</a>"
                    . "</td>"
                    . "</tr>"; 
            }
            ?>
        </tbody>
    </table>
</body>
</html>


