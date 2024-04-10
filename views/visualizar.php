<?php $this->layout('template', ['title' => $title]) ?>


<!-- Body Internal -->
<section class="section-body-content">
    <div class="header_table">
        <h1>Usuários Registrados</h1>
    </div>

    <div class="responsive">
        <table class="tabela_de_registros">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>NickName</th>
                    <!-- <th>Numero</th>
                    <th>Bairro</th>
                    <th>Cidade</th> -->
                    <th>Ver Perfil</th>
                    <!-- <th>Deletar</th> -->
                </tr>
            </thead>
            <tbody>
                <?php if (isset($usuarios) && !empty($usuarios)) : ?>
                <?php foreach ($usuarios as $usuario) : ?>
                <tr>
                    <td><?= $usuario['nome'] ?></td>
                    <td><?= $usuario['email'] ?></td>
                    <td><?= $usuario['nickname'] ?></td>
                    <td>
                        <a class="color-achor-editar" href="/user-perfil/id=<?= $usuario['id'] ?>">Ver
                            Perfil</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else : ?>
                <tr>
                    <td style='text-align:center;' colspan="7">Não há usuários registrados</td>
                </tr>
                <?php endif; ?>
            </tbody>

        </table>
    </div>
</section>