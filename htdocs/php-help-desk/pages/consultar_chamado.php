<? require_once '../scripts/validador_acesso.php' ?>

<?php
// array com chamados
$chamados = array();

// abrir arquivo com a lista de chamados
$arquivo = fopen("../../../htdocsPrivate/php-help-desk/lista_chamados.txt", "r");

// enquanto houver registros a serem recuperados
while (!feof($arquivo)) { // testa pelo fim do arquivo
  $registro = fgets($arquivo);
  $chamados[] = $registro;
}

// fechamento do arquivo
fclose($arquivo);
?>

<html>

<head>
  <meta charset="utf-8" />
  <title>App Help Desk</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <style>
    .card-consultar-chamado {
      padding: 30px 0 0 0;
      width: 100%;
      margin: 0 auto;
    }
  </style>
</head>

<body>
  <? require_once '../components/navbar.php' ?>

  <div class="container">
    <div class="row">

      <div class="card-consultar-chamado">
        <div class="card">
          <div class="card-header">
            Consulta de chamado
          </div>

          <div class="card-body">

            <?php
            foreach ($chamados as $chamado) {
              $chamado_dados = explode("#", $chamado);

              // Verifica se o acesso é do tipo "Usuário"
              if ($_SESSION['perfil_id'] == 2) {
                // Exibe somente chamados feitos pelo próprio usuário
                if ($_SESSION['id'] != $chamado_dados[0]) {
                  continue;
                }
              }

              if (count($chamado_dados) < 3) {
                continue;
              }
            ?>
              <div class="card mb-3 bg-light">
                <div class="card-body">
                  <h5 class="card-title"><?= $chamado_dados[1] ?></h5>
                  <h6 class="card-subtitle mb-2 text-muted"><?= $chamado_dados[2] ?></h6>
                  <p class="card-text"><?= $chamado_dados[3] ?></p>
                </div>
              </div>
            <? } ?>

            <div class="row mt-5">
              <div class="col-6">
                <a class="btn btn-lg btn-warning btn-block" href="./home.php">Voltar</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>