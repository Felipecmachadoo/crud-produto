<?php
require_once '../controller/ProdutoController.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $controller = new ProdutoController();
    $controller->excluir($id);
}
?>
