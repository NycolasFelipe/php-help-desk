<? require_once '../scripts/validador_acesso.php' ?>

<?php
// array com chamados
$chamados = array();

// abrir arquivo com a lista de chamados
$arquivo = fopen("../../../htdocsPrivate/php-help-desk/lista_chamados.txt", "r");

// enquanto houver registros a serem recuperados
// testa pelo fim do arquivo
while (!feof($arquivo)) {
  $registro = explode('#', fgets($arquivo));

  // ignorar registros inválidos
  if (count($registro) < 2) {
    continue;
  }

  // monta estrutura do chamado
  $chamado = array(
    'id' => $registro[0],
    'titulo' => $registro[1],
    'categoria' => $registro[2],
    'descricao' => $registro[3]
  );

  /*
    adiciona registro somente se
    1. usuário for admin ou
    2. chamado ter sido criado por esse mesmo usuário
  */
  if ($_SESSION['perfil_id'] == 2) {
    // Exibe somente chamados feitos pelo próprio usuário
    if ($_SESSION['id'] != $chamado['id']) {
      continue;
    }
  }

  $chamados[] = $chamado;
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
  <script>
    // Excluir chamado
    function excluirChamado(e) {
      const chamadoHtml = e.parentNode;
      const titulo = chamadoHtml.querySelector('.card-title').innerText;
      const categoria = chamadoHtml.querySelector('.card-subtitle').innerText;
      const descricao = chamadoHtml.querySelector('.card-text').innerText;

      const chamado = `${titulo}#${categoria}#${descricao}`;

      const data = new FormData();
      data.append('chamado', chamado);

      const xhr = new XMLHttpRequest();
      xhr.open('POST', '../scripts/exclui_chamado.php', true);
      xhr.onload = function() {
        if (xhr.status !== 200) {
          // Server does not return HTTP 200 (OK) response.
          return;
        }
        console.log(this.statusText);
      }
      xhr.send(data);
      window.location.reload();
    }
  </script>
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
            <? foreach ($chamados as $chamado) { ?>
              <div class="card mb-3 bg-light">
                <div class="card-body">
                  <h5 class="card-title"><?= $chamado['titulo'] ?></h5>
                  <h6 class="card-subtitle mb-2 text-muted"><?= $chamado['categoria'] ?></h6>
                  <p class="card-text"><?= $chamado['descricao'] ?></p>
                  <? if ($_SESSION['perfil_id'] == 1) { ?>
                    <p class="card-text fs-6 text-muted mb-0"><small>Chamado criado por usuário com id: <?= $chamado['id'] ?></small></p>
                  <? } ?>
                  <button type="button" class="btn" onclick="excluirChamado(this)" style="position: absolute; top: 20px; right: 20px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                      <path
                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 
                        1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 
                        .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                    </svg>
                  </button>
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