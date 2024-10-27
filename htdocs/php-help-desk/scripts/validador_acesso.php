<?php
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] == false) {
    header("Location: ../index.php?erro=acesso_nao_autorizado");
}
