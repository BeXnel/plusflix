<?php
/** @var \App\Model\Movie $movie */
/** @var \App\Service\Router $router */

$title = $movie->getTitle();
$bodyClass = 'show';

ob_start(); ?>
    <h1><?= $movie->getTitle() ?> (<?= $movie->getYear() ?>)</h1>
    <p>Reżyser: <?= $movie->getDirector() ?></p>
    <p>Długość: <?= $movie->getDuration() ?> min</p>
    <p>Opis: <?= $movie->getDescription() ?></p>
    <p>Gatunki: <?= implode(', ', array_map(fn($g) => $g->getName(), $movie->getGenres())) ?></p>
    <div class="platforms-section">
        <h3>Dostępne na:</h3>
        <div class="platforms-list">
            <?php foreach ($movie->getAvailability() as $platform): 
                $clean_name = preg_replace('/[^a-z0-9]/', '', strtolower($platform->getName())); ?>
                <div class="platform-badge <?= $clean_name ?>">
                    <?= strtoupper(substr($clean_name, 0, 1)) ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="reviews-section">
        <h3>Recenzje</h3>
        <?php if ($movie->getAverageRating()): ?>
            <p>Średnia ocena: <?= number_format($movie->getAverageRating(), 1) ?> / 6</p>
        <?php else: ?>
            <p>Brak ocen.</p>
        <?php endif; ?>
        <ul>
            <?php foreach ($movie->getReviews() as $review): ?>
                <li>
                    Ocena: <?= $review->getRating() ?> / 6
                    <?php if ($review->getComment()): ?>
                        <p><?= $review->getComment() ?></p>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <ul class="action-list">
        <li><a href="<?= $router->generatePath('movie-index') ?>">Powrót do listy</a></li>
    </ul>
<?php $main = ob_get_clean();

include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
