<?= $this->extend('layouts/main_layout') ?>
<?= $this->section('content') ?>

<div class="col-sm-12 col-12 p-1">
    <div class="card p-3">

        <h4><i class="fa-solid fa-users me-2"></i>Gráfico</h4>
        
        <canvas id="chartjs_chart" height="400px"></canvas>

        <?php
        $eixox = "";            
        $total = null;   

        foreach ($chart_labels as $chart) {
            $datax     = OPCAO_LIST[$chart->opcao];
            $eixox         .= "'$datax'" . ",";
            $dataTotal     = $chart->total;
            $total .= "'$dataTotal'" . ",";
        }

        ?>


    </div>
</div>

<script>
    // chartjs
    <?php if (count($usuarios) != 0) : ?>

        new Chart(
            document.querySelector('#chartjs_chart'), {
                type: 'bar',
                data: {
                    labels: [<?= $eixox; ?>],   //['Saúde', 'Educação', 'Infraestrutura', 'Assistência Social', 'Segurança'],
                    datasets: [{
                                label: "Quantidade de cada Opção",
                                backgroundColor: "rgba(255,99,132,0.2)",
                                borderColor: "rgba(255,99,132,1)",
                                borderWidth: 2,
                                hoverBackgroundColor: "rgba(255,99,132,0.4)",
                                hoverBorderColor: "rgba(255,99,132,1)",
                                data: [<?= $total; ?>],
  }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                },
            }
        );

    <?php endif; ?>
</script>

<?= $this->endSection() ?>