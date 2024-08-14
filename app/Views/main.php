<?= $this->extend('layouts/main_layout') ?>
<?= $this->section('content') ?>

<div class="container">
    <h2 class="text-center text-white mt-3 mb-3">Lei de Diretrizes Orçamentárias 2025</h2>
    <p class="text-justify text-white">
        Considerando a situação de calamidade em que ainda nos encontramos, conforme Decreto do Governo do Estado do Rio Grande do Sul,
        nº 57.646 de 30 de maio de 2024 e Decreto Municipal nº 20.807 de 08 de maio de 2024;
    </p>
    <p class="text-justify text-white">
        Considerando a flexibilização de vários mecanismos nos casos de ocorrência de calamidade pública e de estado de defesa ou de sítio, situações que sobrevém de forma imprevisível e que tem como característica causar um desequilíbrio
        na gestão pública de uma forma geral e que acabem por afetar a população conforme previsto no artigo 65 da Lei de Responsabilidade Fiscal;
    </p>
    <p class="text-justify text-white">
        Considerando que diversos munícipes enfrentam dificuldades por conta dos reflexos das severas inundações e enchentes recentes restando fragilizados e, em alguns casos privados de mobilidade urbana;
    </p>
    <p class="text-justify text-white">
        Considerando que na atualidade a população tem facilidade de acesso à internet e redes sociais;
    </p>
    <p class="text-justify text-white">
        Optamos por fazer a presente consulta de forma ampla e democrática, onde todos podem escolher uma área prioritária e indicar uma ação específica, e, a mais votada, ou indicada, estará na composição da fixação da despesa na LOA 2025.
    </p>
    <p class="text-justify mb-5 text-white">
        Neste sentido, solicitamos que o munícipe se identifique e em seguida escolha a área que entende que seja prioritária e na sequencia deixe sua opinião sobre um investimento.
    </p>

    <?= form_open('processar_frm') ?>
    <!-- <form action="processar_formulario.php" id="form" method="POST"> onsubmit="limparFormulario();"> -->

    <div class="row mb-3">
        <label for="nome" class="col-sm-2 col-form-label">Nome:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
    </div>

    <div class="row mb-3">
        <label for="cpf" class="col-sm-2 col-form-label">CPF:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" oninput="mascaraCPF(this)" id="cpf" name="cpf" placeholder="XXX.XXX.XXX-XX" required>
        </div>
    </div>

    <div class="row mb-3">
        <label for="bairro" class="col-sm-2 col-form-label">Bairro:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="bairro" name="bairro" required>
        </div>
    </div>

    <div class="row mb-3">
        <label for="telefone" class="col-sm-2 col-form-label">Telefone:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="telefone" name="telefone" oninput="mascaraTelefone(this)" maxlength="15" placeholder="(XX) XXXXX-XXXX" required>
        </div>
    </div>

    <div class="row mb-3">
        <label for="email" class="col-sm-2 col-form-label">e-mail:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="email" name="email" required>
        </div>
    </div>

    <fieldset class="row mb-3">
        <legend class="col-form-label col-sm-2 pt-0">Escolha a área prioritária:</legend>
        <div class="col-sm-10">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="opcao" id="saude" value="saude" checked>
                <label class="form-check-label" for="saude">
                    Saúde
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="opcao" id="saude" value="saude">
                <label class="form-check-label" for="saude">
                    Educação
                </label>
            </div>
            <div class="form-check disabled">
                <input class="form-check-input" type="radio" name="opcao" id="infraestrutura" value="infraestrutura">
                <label class="form-check-label" for="infraestrutura">
                    Infraestrutura
                </label>
            </div>
            <div class="form-check disabled">
                <input class="form-check-input" type="radio" name="opcao" id="assistenciasocial" value="assistenciasocial">
                <label class="form-check-label" for="assistenciasocial">
                    Assistência Social
                </label>
            </div>
            <div class="form-check disabled">
                <input class="form-check-input" type="radio" name="opcao" id="seguranca" value="seguranca">
                <label class="form-check-label" for="seguranca">
                    Segurança
                </label>
            </div>
        </div>
    </fieldset>

    <div class="form-floating mb-3">
        <textarea class="form-control" placeholder="Deixe uma sugestão aqui" id="sugestao" name="sugestao"></textarea>
        <label for="floatingTextarea">Sugestão</label>
    </div>

    <input type="submit" class="btn btn-primary mb-10" value="Cadastrar">

    <?= form_close() ?>

    <?php if (!empty($validation_errors)): ?>
        <div class="alert alert-danger mt-3">
            <?php foreach ($validation_errors as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>

<script>
    //document.querySelector('select[name="select_status"]').addEventListener('change', (e) => {
    function mascaraCPF(input) {
        // Remove qualquer caractere que não seja número
        let cpf = input.value.replace(/\D/g, '');

        // Limita o tamanho do CPF a 11 dígitos
        if (cpf.length > 11) {
            cpf = cpf.substring(0, 11);
        }

        // Aplica a máscara
        cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
        cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
        cpf = cpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2");

        // Atualiza o valor do campo de entrada
        input.value = cpf;
    }

    function mascaraTelefone(input) {
        // Remove qualquer caractere que não seja número
        let telefone = input.value.replace(/\D/g, '');

        // Limita o tamanho do telefone a 11 dígitos
        if (telefone.length > 11) {
            telefone = telefone.substring(0, 11);
        }

        // Aplica a máscara
        if (telefone.length <= 10) {
            // Máscara para telefones fixos
            telefone = telefone.replace(/(\d{2})(\d)/, "($1) $2");
            telefone = telefone.replace(/(\d{4})(\d)/, "$1-$2");
        } else {
            // Máscara para telefones celulares
            telefone = telefone.replace(/(\d{2})(\d)/, "($1) $2");
            telefone = telefone.replace(/(\d{5})(\d)/, "$1-$2");
        }

        // Atualiza o valor do campo de entrada
        input.value = telefone;
    }
</script>


<?= $this->endSection() ?>