<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?></title>

    <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="<?= base_url('assets/bootstrap/bootstrap.min.css') ?>">

     <!-- Fontawesome -->
     <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/all.min.css') ?>">

</head>
<body>

    <?= $this->include('layouts/top_bar') ?>
    
    <!-- render section -->
    <?= $this->renderSection('content') ?>

    <!-- Botstrap JS -->
    <script src="<?= base_url('assets/bootstrap/bootstrap.bundle.min.js') ?>"></script>

</body>
</html>