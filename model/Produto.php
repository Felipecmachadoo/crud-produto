<?php
class Produto {
    private $conexao;
    private $tableName = "produtos";  // Nome da tabela no banco

    private $id;
    private $nome;
    private $quantidade;
    private $cod;

    public function __construct($db) {
        $this->conexao = $db;
    }

    // Método para inserir um novo cliente
    public function inserirProduto($nome, $quantidade, $cod): bool {
        try {
            $comandoSQL = "INSERT INTO " . $this->tableName . " (nome_produto, quantidade, cod_produto) 
                           VALUES (:nome_produto, :quantidade, :cod_produto)";
            
            $acesso = $this->conexao->prepare($comandoSQL);
            
            $acesso->bindParam(":nome_produto", $nome, PDO::PARAM_STR);
            $acesso->bindParam(":quantidade", $quantidade, PDO::PARAM_STR);
            $acesso->bindParam(":cod_produto", $cod, PDO::PARAM_STR);
            
            if ($acesso->execute()) {
                return true; 
            } else {
                throw new Exception("Erro ao executar a consulta.");
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
            return false;  
        }
    }

    // Método para carregar um cliente específico pelo id
    public function carregarProduto($cod) {
        try {
            $comandoSQL = "SELECT * FROM " . $this->tableName . " WHERE id = :id";
    
            $acesso = $this->conexao->prepare($comandoSQL);
            
            // Corrigir bindParam para passar o valor correto
            $acesso->bindParam(":id", $cod, PDO::PARAM_INT);  // Aqui bindParam foi corrigido
    
            if ($acesso->execute()) {
                return $acesso->fetch(PDO::FETCH_ASSOC);
            } else {
                throw new Exception("Erro ao executar a consulta");
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

    // Método para carregar todos os clientes
    public function carregarTodos() {
        $comandoSQL = "SELECT * FROM " . $this->tableName;
        $acesso = $this->conexao->prepare($comandoSQL);
    
        if ($acesso->execute()) {
            $resultados = $acesso->fetchAll(PDO::FETCH_ASSOC);
            return $resultados ? $resultados : [];  // Retorna um array vazio se não houver resultados
        } else {
            throw new Exception("Erro ao executar a consulta");
        }
    }

    // Método para alterar os dados de um cliente
    public function alterarProduto($id, $nome, $quantidade, $cod): bool {
        try {
            // Verifica se o cliente existe
            $comandoSQL = "SELECT id FROM " . $this->tableName . " WHERE id = :id";
            $acesso = $this->conexao->prepare($comandoSQL);
            $acesso->bindParam(":id", $id, PDO::PARAM_INT);
            $acesso->execute();
            
            if ($acesso->rowCount() == 0) {
                echo "Produto não encontrado.";
                return false;
            }

            // Atualiza os dados do cliente
            $comandoSQL = "UPDATE " . $this->tableName . " SET nome_produto = :nome_produto, quantidade = :quantidade, cod_produto = :cod_produto WHERE id = :id";
            $acesso = $this->conexao->prepare($comandoSQL);
            $acesso->bindParam(":nome_produto", $nome, PDO::PARAM_STR);
            $acesso->bindParam(":quantidade", $quantidade, PDO::PARAM_STR);
            $acesso->bindParam(":cod_produto", $cod, PDO::PARAM_STR);
            $acesso->bindParam(":id", $id, PDO::PARAM_INT);

            if ($acesso->execute()) {
                return true; // Cliente alterado com sucesso
            } else {
                throw new Exception("Erro ao executar a atualização.");
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

    // Método para excluir um cliente
    public function excluirProduto($id): bool {
        try {
            // Verifica se o cliente existe
            $comandoSQL = "SELECT id FROM " . $this->tableName . " WHERE id = :id";
            $acesso = $this->conexao->prepare($comandoSQL);
            $acesso->bindParam(":id", $id, PDO::PARAM_INT);
            $acesso->execute();
            
            if ($acesso->rowCount() == 0) {
                echo "Produto não encontrado.";
                return false;
            }

            // Exclui o cliente
            $comandoSQL = "DELETE FROM " . $this->tableName . " WHERE id = :id";
            $acesso = $this->conexao->prepare($comandoSQL);
            $acesso->bindParam(":id", $id, PDO::PARAM_INT);

            if ($acesso->execute()) {
                return true; // Cliente excluído com sucesso
            } else {
                throw new Exception("Erro ao excluir o produto.");
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }
}
?>
