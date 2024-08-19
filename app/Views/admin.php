<?= $this->extend('layouts/main_layout') ?>
<?= $this->section('content') ?>

<?php if (count($usuarios) > 0): ?>
    <section class="container mt-3">
        <div class="row">
            <div class="col">
                <h3>Questionário LDO 2025</h3>
                <table class="table table-striped table-bordered" id="table_usuarios">
                    <thead class="table-secondary">
                        <tr>
                            <th width="70%">Cidadão</th>
                            <th width="20%" class="text-center">Opção</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td>
                                    <a href="<?= site_url('usuario_details/' . encrypt($usuario->id)) ?>" style="text-decoration: none;"><?= $usuario->nome ?></a><br>
                                </td>
                                <td class="text-center">
                                <?= OPCAO_LIST[$usuario->opcao] ?>
                                </td>
                                
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-center">
            <a href="create_pdf_report" target="_blank" class="btn btn-secondary px-4"><i class="fa-solid fa-file-pdf me-2"></i>Criar Relatório em PDF</a>
        </div>
        
    </section>
<?php else: ?>
    <section class="container mt-3">
        <div class="row">
            <div class="col text-center">
                Não foram encontradas tarefas.
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- Datatables -->
 
<script>
    $(document).ready(function() {
        $('#table_usuarios').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "Nada encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(filtrado de _MAX_ registros no total)",
                "search": "Pesquisar:",
                "paginate": {
                    "first": "Primeiro",
                    "last": "Último",
                    "next": "Próximo",
                    "previous": "Anterior"
                },
            }
        });
    });

</script>

<?= $this->endSection() ?>