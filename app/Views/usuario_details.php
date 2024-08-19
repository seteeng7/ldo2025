<?= $this->extend('layouts/main_layout') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col card p-5">

            <div class="mb-4">
                <h4 class="text-info"><?= $usuario->nome ?></h4>
            </div>
            <hr>
            <div class="mb-4">
                <p class="opacity-50">CPF:</p>
                <h4><?= $usuario->cpf ?></h4>
            </div>
            <div class="mb-4">
                <p class="opacity-50">Bairro:</p>
                <h4><?= $usuario->bairro ?></h4>
            </div>
            <div class="mb-4">
                <p class="opacity-50">Telefone:</p>
                <h4><?= $usuario->telefone ?></h4>
            </div>
            <div class="mb-4">
                <p class="opacity-50">e-mail:</p>
                <h4><?= $usuario->email ?></h4>
            </div>
            <div class="mb-4">
            <p class="opacity-50">Opção:</p>
            <h4><?= OPCAO_LIST[$usuario->opcao] ?></h4>
            </div>
            <div class="mb-4">
                <p class="opacity-50">Sugestão:</p>
                <h4><?= $usuario->sugestao ?></h4>
            </div>
            <div class="text-center">
                <a href="<?= site_url('/admin') ?>" class="btn btn-primary px-5">Voltar</a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>