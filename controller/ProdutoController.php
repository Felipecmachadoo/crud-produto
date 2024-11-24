<?php

require_once('C:/xampp/htdocs/php-mvc/model/Database.php');
require_once('C:/xampp/htdocs/php-mvc/model/Produto.php');

class ProdutoController {
    private $db;
    private $produtoModel;

    // Construtor que inicializa a conexão com o banco e o modelo Cliente
    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->produtoModel = new Produto(db: $this->db);
    }

    // Método para incluir um novo cliente
    public function incluir(): void {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // Validação básica
            if (!empty($_POST['nome_produto']) && !empty($_POST['quantidade']) && !empty($_POST['cod_produto'])) {
                $nome = $_POST['nome_produto'];
                $quantidade = $_POST['quantidade'];
                $cod = $_POST['cod_produto'];

                // Validação de email
                if (!filter_var($quantidade, FILTER_VALIDATE_INT)) {
                    $_SESSION['mensagem'] = "Quantidade inválido!";
                    header('Location: ../view/form_cliente.php'); // Redireciona para o formulário
                    exit();
                }

                // Inserir cliente no banco de dados
                $sucesso = $this->produtoModel->inserirProduto($nome, $quantidade, $cod);

                // Mensagem de sucesso ou erro
                if ($sucesso) {
                    $_SESSION['mensagem'] = "Produto inserido com sucesso!";
                } else {
                    $_SESSION['mensagem'] = "Erro ao inserir o produto.";
                }
            } else {
                $_SESSION['mensagem'] = "Por favor, preencha todos os campos.";
            }

            // Redireciona para a página principal após o envio
            header('Location: ../index.php');
            exit();
        }
    }

    // Método para listar todos os clientes
    public function listarTodos() {
        // Chama o método carregarTodos do modelo Cliente para obter os dados
        $produtos = $this->produtoModel->carregarTodos();
        
        // Se não houver clientes, retorna um array vazio
        return $produtos ?: [];
    }

    // Método para buscar clientes por nome
    public function buscarProduto($id) {
        $produto = $this->produtoModel->carregarProduto($id);

        // Retorna os resultados encontrados ou um array vazio
        return $produto ?: [];
    }

    // Método para alterar um cliente
    public function alterar($id, $nome, $quantidade, $cod) {
        // Chama o método do modelo que altera os dados do cliente
        $sucesso = $this->produtoModel->alterarProduto($id, $nome, $quantidade, $cod);

        if ($sucesso) {
            $_SESSION['mensagem'] = "Produto alterado com sucesso!";
        } else {
            $_SESSION['mensagem'] = "Erro ao alterar o produto.";
        }

        // Redireciona para a página de listagem após a alteração
        header('Location: ../index.php');
        exit();
    }

    // Método para excluir um cliente
    public function excluir($id) {
        // Chama o método do modelo que exclui o cliente
        $sucesso = $this->produtoModel->excluirProduto($id);

        if ($sucesso) {
            $_SESSION['mensagem'] = "Produto excluído com sucesso!";
        } else {
            $_SESSION['mensagem'] = "Erro ao excluir produto.";
        }

        // Redireciona para a página de listagem após a exclusão
        header('Location: ../index.php');
        exit();
    }
}
?>


