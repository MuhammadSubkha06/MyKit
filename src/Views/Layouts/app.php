<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $title ?? 'MyKit' ?></title>

    <link rel="icon" type="image/svg+xml" href="/assets/images/logo.svg">

    <link rel="shortcut icon" type="image/svg+xml" href="/assets/images/logo.svg">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link href="/assets/css/style.css" rel="stylesheet">

</head>

<body class="bg-light">

    <?php require __DIR__ . '/../partials/navbar.php'; ?>

    <div class="container py-4">

        <?= $content ?>

    </div>

    <?php require __DIR__ . '/../partials/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>

</html>
