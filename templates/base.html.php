<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/dist/style.min.css">
    <title><?= $title ?? 'Custom Framework' ?></title>
</head>
<body <?= isset($bodyClass) ? "class='$bodyClass'" : '' ?>>
<section class="search-section">
    <form action="/index.php" method="GET" class="search-form">
        <input type="hidden" name="action" value="movie-index">
        <div class="search-wrapper">
            <input type="text" name="q" placeholder="Szukaj..." class="search-input">
            <button type="button" class="filter-icon">☰</button>
        </div>
    </form>
</section>
<main><?= $main ?? null ?></main>
<footer>&copy;<?= date('Y') ?> Custom Framework</footer>
</body>
</html>
