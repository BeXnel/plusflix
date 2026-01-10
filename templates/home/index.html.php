<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PLUSFLIX</title>
    
    <link rel="stylesheet" href="/assets/src/less/style.css">
    
</head>
<body>

    <div class="container">
        <section class="search-section">
            <form action="/index.php" method="GET" class="search-form">
                <input type="hidden" name="action" value="movie-index">
                
                <div class="search-wrapper">
                    <input type="text" name="q" placeholder="Szukaj..." class="search-input">
                    <button type="button" class="filter-icon">☰</button>
                </div>
            </form>
        </section>

        <section class="platforms-section">
            <button class="nav-arrow left">←</button>
            <div class="platforms-list">
                <div class="platform-badge netflix">N</div>
                <div class="platform-badge disney">D+</div>
                <div class="platform-badge netflix">N</div>
                <div class="platform-badge imdb">B</div>
            </div>
            <button class="nav-arrow right">→</button>
        </section>

        <section class="top-list-section">
            <h2>Top filmy:</h2>
            
            <div class="movies-list">
                <?php foreach ($topMovies as $movie): ?>
                    <div class="movie-row">
                        <div class="rank-col">
                            <?php if($movie['rank'] == 1): ?>
                                <span class="crown">👑</span>
                            <?php endif; ?>
                            <span class="rank-num rank-<?= $movie['rank'] ?>"><?= $movie['rank'] ?>.</span>
                        </div>

                        <div class="info-col">
                            <div class="movie-title"><?= $movie['title'] ?></div>
                            <div class="movie-year"><?= $movie['year'] ?></div>
                        </div>

                        <div class="platform-col">
                            <div class="platform-icon <?= $movie['platform'] ?>">
                                <?= strtoupper(substr($movie['platform'], 0, 1)) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>

</body>
</html>