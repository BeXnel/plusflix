<?php
/** @var \App\Model\Movie $movie */
/** @var \App\Service\Router $router */
$title = $movie->getTitle();
$bodyClass = 'index';
ob_start();
?>
<div class="container">
    <h1 class="hero-title" style="text-align:left; margin-bottom:1.5rem; color:#ffffff;"><?= htmlspecialchars($movie->getTitle(), ENT_QUOTES, 'UTF-8') ?> (<?= $movie->getYear() ?>)</h1>

    <div style="margin-bottom:2rem; line-height:1.7; color:#f0f0f5;">
        <p><strong>Reżyser:</strong> <?= htmlspecialchars($movie->getDirector(), ENT_QUOTES, 'UTF-8') ?></p>
        <p><strong>Długość:</strong> <?= $movie->getDuration() ?> min</p>
        <p><strong>Opis:</strong> <?= htmlspecialchars($movie->getDescription(), ENT_QUOTES, 'UTF-8') ?></p>
        <p><strong>Gatunki:</strong> <?= implode(', ', array_map(fn($g) => htmlspecialchars($g->getName(), ENT_QUOTES, 'UTF-8'), $movie->getGenres())) ?></p>
    </div>

    <div class="platforms-section" style="margin-bottom:2.5rem;">
        <h3 class="section-title" style="text-align:left; color:#ffffff;">Dostępne na:</h3>
        <div class="movie-platform" style="display:flex; gap:14px; flex-wrap:wrap;">
            <?php foreach ($movie->getAvailability() as $platform):
                $clean_name = preg_replace('/[^a-z0-9]/', '', strtolower($platform->getName()));
                $display_text = ($clean_name === 'disney') ? 'D+' : strtoupper(substr($clean_name, 0, 1));
            ?>
                <div class="platform-badge <?= htmlspecialchars($clean_name, ENT_QUOTES, 'UTF-8') ?>" title="<?= htmlspecialchars($platform->getName(), ENT_QUOTES, 'UTF-8') ?>" style="width:62px; height:62px; font-size:1.9rem;">
                    <span class="platform-logo"><?= htmlspecialchars($display_text, ENT_QUOTES, 'UTF-8') ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div style="margin-bottom:2rem;">
        <h3 class="section-title" style="text-align:left; color:#ffffff;">Recenzje</h3>
        <?php if ($movie->getAverageRating()): ?>
            <p style="color:#ffffff; font-size:1.15rem; margin-bottom:1rem;">Średnia ocena: <?= number_format($movie->getAverageRating(), 1) ?> / 6</p>
        <?php else: ?>
            <p style="color:#a0a0b0;">Brak ocen.</p>
        <?php endif; ?>

        <?php foreach ($movie->getReviews() as $review): ?>
            <div style="margin-top:1rem; padding:1.25rem; background:#16162a; border:1px solid #2a2a3e; border-radius:12px; color:#ffffff;">
                <strong>Ocena: <?= $review->getRating() ?> / 6</strong>
                <?php if ($review->getComment()): ?>
                    <p style="margin-top:0.75rem; color:#e0e0e0;"><?= htmlspecialchars($review->getComment(), ENT_QUOTES, 'UTF-8') ?></p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <div style="margin-top:2rem;">
        <a href="<?= $router->generatePath('movie-index') ?>" 
           style="color:#a5b4fc; font-weight:500; text-decoration:none; margin-right:1.5rem; cursor:pointer;"
           onmouseover="this.style.color='#c4d0ff'; this.style.textDecoration='underline';"
           onmouseout="this.style.color='#a5b4fc'; this.style.textDecoration='none';">
            ← Powrót do listy filmów
        </a>
        <a href="<?= $router->generatePath('') ?>" 
           style="color:#a5b4fc; font-weight:500; text-decoration:none; cursor:pointer;"
           onmouseover="this.style.color='#c4d0ff'; this.style.textDecoration='underline';"
           onmouseout="this.style.color='#a5b4fc'; this.style.textDecoration='none';">
            ← Powrót do strony głównej
        </a>
    </div>
</div>
<?php $main = ob_get_clean();
include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
