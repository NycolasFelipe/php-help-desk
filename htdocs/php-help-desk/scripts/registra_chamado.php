<?php
session_start();

$titulo = str_replace('#', '', $_POST['titulo']);
$categoria = str_replace('#', '', $_POST['categoria']);
$descricao = str_replace('#', '', $_POST['descricao']);

$texto = $_SESSION['id'] . '#' . $titulo . '#' . $categoria . '#' . $descricao . PHP_EOL;

// Erro ao registrar - dados inválidos
if (strlen($titulo) < 1 || strlen($descricao) < 1) {
    header("Location: ../pages/abrir_chamado.php?resultado=erro");
}
// Sucesso
else {
    $arquivo = fopen('../../../htdocsPrivate/php-help-desk/lista_chamados.txt', 'a');
    fwrite($arquivo, $texto);
    fclose($arquivo);
    header("Location: ../pages/abrir_chamado.php?resultado=sucesso");
}
