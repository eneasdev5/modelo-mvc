<?php $this->layout('template', ['title' => $title]) ?>


<?php $this->start('sidebar') ?>
<li class="nav-item">

    <a class="nav-link" href="<?= '/visualizar' ?>">Visualizar</a>
</li>

<?php $this->stop() ?>

<div class="row">
    <div>
        <p>Nome: <b>Teste Nome</b></p>
    </div>
</div>