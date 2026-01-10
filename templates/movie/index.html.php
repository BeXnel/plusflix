<?php
/** @var \App\Model\Movie[] $movies */
/** @var \App\Service\Router $router */

$title = 'Lista filmów';
$bodyClass = 'index';

ob_start(); ?>
    <h1>Lista filmów</h1>
    <a href="<?= $router->generatePath('') ?>">Powrót do strony głównej</a>
    <section class="top-list-section">
        <div class="movies-list">
            <?php if (empty($movies)): ?>
                <div>Brak wyników wyszukiwania.</div>
            <?php else: ?>
                <?php foreach ($movies as $movie): ?>
                    <div class="movie-row">
                        <div class="info-col">
                            <div class="movie-title"><a href="<?= $router->generatePath('movie-show', ['id' => $movie->getId()]) ?>"><?= $movie->getTitle() ?></a></div>
                            <div class="movie-year"><?= $movie->getYear() ?></div>
                        </div>
                        <div class="platform-col">
                            <?php foreach ($movie->getAvailability() as $platform): 
                                $clean_name = preg_replace('/[^a-z0-9]/', '', strtolower($platform->getName())); ?>
                                <div class="platform-icon <?= $clean_name ?>">
                                    <?= strtoupper(substr($clean_name, 0, 1)) ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
<?php $main = ob_get_clean();

include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
