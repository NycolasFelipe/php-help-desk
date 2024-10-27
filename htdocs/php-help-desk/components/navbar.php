<?php
$current_page = basename($_SERVER["REQUEST_URI"], ".php");
$is_index_page = str_contains($current_page, "index") || str_contains($current_page, "php-help-desk");
?>

<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href=<?= $is_index_page ? "pages/home.php" : "../pages/home.php" ?>>
        <img
            src=<?= $is_index_page ? "./img/logo.png" : "../img/logo.png" ?>
            width="30" height="30"
            class="d-inline-block align-top"
            alt="Logo">
        App Help Desk
    </a>
    <ul class="navbar-nav d-flex flex-row align-items-center">
        <li class="nav-item">
            <p class="py-0 pr-4 m-0" style="color: rgba(255,255,255,.5); pointer-events: none;">
                <? if (!$is_index_page) echo isset($_SESSION['email']) ? $_SESSION['email'] : "" ?>
            </p>
        </li>
        <? if (!$is_index_page) { ?>
            <li class="nav-item">
                <a href="../scripts/logoff.php" class="nav-link">SAIR</a>
            </li>
        <? } ?>
    </ul>
</nav>