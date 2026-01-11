<?php
/** @var array $topMovies */
/** @var \App\Service\Router $router */
$title = 'PLUSFLIX';
$bodyClass = 'index';
ob_start(); ?>
    <div class="container">
        <section class="platforms-section">
            <button class="nav-arrow left">←</button>
            <div class="platforms-list">
                <div class="platform-badge netflix">N</div>
                <div class="platform-badge disney">D+</div>
                <div class="platform-badge hbo">H</div>
                <div class="platform-badge skyshowtime">S</div>
                <div class="platform-badge prime">P</div>
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
                            <?php
                            $clean_name = preg_replace('/[^a-z0-9]/', '', strtolower($movie['platform']));
                            $display_text = ($clean_name === 'disney') ? 'D+' : strtoupper(substr($clean_name, 0, 1));
                            ?>
                            <div class="platform-badge <?= $clean_name ?>">
                                <?= $display_text ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
<?php $main = ob_get_clean();
include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
