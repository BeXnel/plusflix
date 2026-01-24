<?php
/** @var \App\Model\Movie[] $movies */
/** @var \App\Service\Router $router */
$title = 'Lista filmów';
$bodyClass = 'index';
ob_start(); ?>
<div class="container">
    <h1 class="section-title">Lista filmów</h1>
    <div class="actions">
        <a href="<?= $router->generatePath('') ?>">Powrót do strony głównej</a>
    </div>
    <section class="top-list-section">
        <div class="movies-list">
            <?php if (empty($movies)): ?>
                <div class="empty">Brak wyników wyszukiwania.</div>
            <?php else: ?>
                <?php foreach ($movies as $movie): ?>
                    <a href="<?= $router->generatePath('movie-show', ['id' => $movie->getId()]) ?>" class="movie-card">
                        <div class="movie-info">
                            <h3 class="movie-title">
                                    <?= $movie->getTitle() ?>
                            </h3>
                            <p class="movie-year"><?= $movie->getYear() ?></p>
                        </div>
                        <div class="movie-platform">
                            <?php foreach ($movie->getAvailability() as $platform):
                                $clean_name = preg_replace('/[^a-z0-9]/', '', strtolower($platform->getName()));
                                $display_text = ($clean_name === 'disney') ? 'D+' : strtoupper(substr($clean_name, 0, 1)); ?>
                                <div class="platform-badge <?= $clean_name ?>">
                                    <span class="platform-logo"><?= $display_text ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
</div>
<?php $main = ob_get_clean();
include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
