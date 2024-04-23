<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title><?= $title ?></title>
    <meta charset="utf8" />
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/cadastro.css">
    <link rel="stylesheet" href="assets/css/visualizar_usuario.css">
</head>

<body>
    <!-- Body -->
    <main class="cMain">
        <!-- Header -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Gestor Users</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">

                        <?php if ($this->section('sidebar')) : ?>

                            <?= $this->section('sidebar') ?>

                        <?php else : ?>

                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="<?= '/' ?>">Home</a>
                            </li>
                            <li class=" nav-item">
                                <a class="nav-link" href="<?= '/register-users' ?>">Cadastrar Usuário</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= '/visualizar' ?>">Visualizar</a>
                            </li>

                        <?php endif; ?>

                    </ul>
                </div>
            </div>
        </nav>

        <!-- carrega conteúdo de forma dinâmica -->
        <?= $this->section('content') ?>

        <!-- Footer -->
        <footer class="footer_page">
            <p>Todos Direito reservados 2023</p>
        </footer>

        <script src="assets/js/via_cep.js"></script>

    </main>

</body>

</html>