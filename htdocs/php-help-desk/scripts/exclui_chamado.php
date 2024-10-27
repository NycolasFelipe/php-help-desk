<?php
require_once "./delete_line_in_file.php";
session_start();

$file_path = "../../../htdocsPrivate/php-help-desk/lista_chamados.txt";

function getLineWithString($fileName, $str)
{
    $lines = file($fileName);
    foreach ($lines as $lineNumber => $line) {
        if (strpos($line, $str) !== false) {
            return $line;
        }
    }
    return -1;
}

// usuario admin
if ($_SESSION['perfil_id'] == 1) {
    $search_string = getLineWithString($file_path, $_POST['chamado']);
    if ($search_string !== -1) {
        deleteLineInFile($file_path, $search_string);
    }
}
// usuário comum
elseif (($_SESSION['perfil_id'] == 2)) {
    $search_string = $_SESSION['id'] . '#' . $_POST['chamado'];
    deleteLineInFile($file_path, $search_string);
}
