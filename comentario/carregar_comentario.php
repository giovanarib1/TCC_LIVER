<?php
include "../conexao.php"; // Certifique-se de incluir a conexão com o banco de dados
include "comentario/comentario.php"; // Certifique-se de incluir suas funções de carregarComentarios

$id_resenha = $_GET['id_resenha'];

ob_start(); // Iniciar o buffer de saída

carregarComentarios($id_resenha, $con); // Chame a função para carregar os comentários

$html = ob_get_clean(); // Capturar o conteúdo do buffer e limpar

echo $html; // Retornar o HTML dos comentários
?>
