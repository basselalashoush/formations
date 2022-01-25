<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title><?php echo isset($title_for_layout) ? $title_for_layout : 'Mon Site'; ?></title>
    <link rel="stylesheet" href="http://bootstrapdocs.com/v2.3.2/docs/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= BASE_URL; ?>/css/app.css">
</head>

<body>
    <div class="contents">
        <?= $contents; ?>

    </div>

</body>
<script type="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</html>