<?php
session_start();

//usuario autenticado
$autenticado = false;
$usuario_id = null;
$usuario_perfil_id = null;

$perfis = array(
    1 => 'Administrativo',
    2 => 'Usuário'
);

//usuarios do sistema
$usuarios = array(
    array('id' => 1, 'email' => 'adm@teste.com.br', 'senha' => '1234', 'perfil_id' => 1),
    array('id' => 2, 'email' => 'user@teste.com.br', 'senha' => '1234', 'perfil_id' => 1),
    array('id' => 3, 'email' => 'jose@teste.com.br', 'senha' => '1234', 'perfil_id' => 2),
    array('id' => 4, 'email' => 'maria@teste.com.br', 'senha' => '1234', 'perfil_id' => 2)
);

foreach ($usuarios as $user) {
    if ($_POST['email'] == $user['email'] && $_POST['senha'] == $user['senha']) {
        $autenticado = true;
        $usuario_id = $user['id'];
        $usuario_perfil_id = $user['perfil_id'];
    }
}

if ($autenticado) {
    $_SESSION['autenticado'] = true;
    $_SESSION['id'] = $usuario_id;
    $_SESSION['perfil_id'] = $usuario_perfil_id;

    header('Location: ../pages/home.php');
} else {
    $_SESSION['autenticado'] = false;
    header('Location: ../index.php?erro=login_invalido');
}
