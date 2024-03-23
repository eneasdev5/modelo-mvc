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
    <main class="cMainEl">
        <!-- Header -->
        <nav class="nav-menu">
            <?php if ($this->section('sidebar')) : ?>
                <ul class="menu">
                    <?= $this->section('sidebar') ?>
                </ul>
            <?php else : ?>

                <ul class="menu">
                    <li><a href="<?= '/' ?>">Início</a></li>
                    <li><a href="<?= '/register-users' ?>">Cadastrar Usuário</a></li>
                    <li><a href="<?= '/visualizar' ?>">Visualizar Usuário</a></li>
                </ul>
            <?php endif; ?>

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