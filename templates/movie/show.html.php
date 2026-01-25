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
                $url = match($clean_name) {
                    'hbo' => 'https://www.hbomax.com/pl/pl',
                    'skyshowtime' => 'https://www.skyshowtime.com/pl',
                    'prime' => 'https://www.primevideo.com/',
                    'netflix' => 'https://www.netflix.com/pl/',
                    'disney' => 'https://www.disneyplus.com/',
                    default => '#',
                };
            ?>
                <a href="<?= $url ?>" class="platform-badge <?= htmlspecialchars($clean_name, ENT_QUOTES, 'UTF-8') ?>" title="<?= htmlspecialchars($platform->getName(), ENT_QUOTES, 'UTF-8') ?>" style="width:62px; height:62px; font-size:1.9rem;">
                    <span class="platform-logo"><?= htmlspecialchars($display_text, ENT_QUOTES, 'UTF-8') ?></span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    <div style="margin-bottom:2rem;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
            <h3 class="section-title" style="text-align:left; color:#ffffff; margin:0;">Recenzje</h3>
            <button id="openReviewModal" style="background:#6366f1; color:#ffffff; border:none; padding:0.75rem 1.5rem; border-radius:8px; cursor:pointer; font-weight:500; font-family:'Poppins', sans-serif; font-size:0.95rem; transition:background 0.3s ease;" onmouseover="this.style.background='#4f46e5'" onmouseout="this.style.background='#6366f1';">
                Dodaj ocenę
            </button>
        </div>
        <?php if ($movie->getAverageRating()): ?>
            <p style="color:#ffffff; font-size:1.15rem; margin-bottom:1rem;">Średnia ocena: <?= number_format($movie->getAverageRating(), 1) ?> / 5</p>
        <?php else: ?>
            <p style="color:#a0a0b0;">Brak ocen.</p>
        <?php endif; ?>
        <?php foreach ($movie->getReviews() as $review): ?>
            <div style="margin-top:1rem; padding:1.25rem; background:#16162a; border:1px solid #2a2a3e; border-radius:12px; color:#ffffff;">
                <div style="display:flex; gap:0.5rem; margin-bottom:0.5rem;">
                    <?php for ($i = 0; $i < $review->getRating(); $i++): ?>
                        <span style="color:#fbbf24; font-size:1.1rem;">★</span>
                    <?php endfor; ?>
                    <?php for ($i = $review->getRating(); $i < 5; $i++): ?>
                        <span style="color:#4b5563; font-size:1.1rem;">★</span>
                    <?php endfor; ?>
                </div>
                <?php if ($review->getComment()): ?>
                    <p style="margin-top:0.75rem; color:#e0e0e0;"><?= htmlspecialchars($review->getComment(), ENT_QUOTES, 'UTF-8') ?></p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Review Modal -->
    <div id="reviewModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); z-index:1000; justify-content:center; align-items:center;">
        <div style="background:#1a1a2e; border:1px solid #2a2a3e; border-radius:16px; padding:2rem; max-width:500px; width:90%; box-shadow:0 10px 40px rgba(0,0,0,0.5);">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
                <h3 style="color:#ffffff; margin:0; font-size:1.5rem;">Wystawić recenzję</h3>
                <button id="closeReviewModal" type="button" style="background:none; border:none; color:#a0a0b0; font-size:1.5rem; cursor:pointer;" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#a0a0b0';">×</button>
            </div>

            <form id="reviewForm" method="POST" action="<?= $router->generatePath('movie-addReview', ['id' => $movie->getId()]) ?>" style="display:none;">
                <input type="hidden" name="action" value="movie-addReview">
                <input type="hidden" name="movie_id" value="<?= $movie->getId() ?>">
                <input type="hidden" name="rating" id="formRating" value="">
                <input type="hidden" name="comment" id="formComment" value="">
            </form>

            <div style="margin-bottom:1.5rem;">
                <label style="display:block; color:#ffffff; font-weight:500; margin-bottom:0.75rem;">Twoja ocena</label>
                <div id="starsContainer" style="display:flex; gap:0.75rem; font-size:2.5rem; cursor:pointer;">
                    <span class="star" data-rating="1" style="color:#4b5563; transition:color 0.2s ease; cursor:pointer;">★</span>
                    <span class="star" data-rating="2" style="color:#4b5563; transition:color 0.2s ease; cursor:pointer;">★</span>
                    <span class="star" data-rating="3" style="color:#4b5563; transition:color 0.2s ease; cursor:pointer;">★</span>
                    <span class="star" data-rating="4" style="color:#4b5563; transition:color 0.2s ease; cursor:pointer;">★</span>
                    <span class="star" data-rating="5" style="color:#4b5563; transition:color 0.2s ease; cursor:pointer;">★</span>
                </div>
                <input type="hidden" id="selectedRating" value="0">
            </div>

            <div style="margin-bottom:1.5rem;">
                <label style="display:block; color:#ffffff; font-weight:500; margin-bottom:0.75rem;">Komentarz (opcjonalnie)</label>
                <textarea id="reviewComment" style="width:100%; height:120px; padding:0.75rem; border:1px solid #2a2a3e; border-radius:8px; background:#16162a; color:#ffffff; font-family:'Poppins', sans-serif; font-size:0.95rem; resize:vertical; box-sizing:border-box;" placeholder="Podziel się swoją opinią..."></textarea>
            </div>

            <div style="display:flex; gap:1rem;">
                <button id="submitReview" type="button" style="flex:1; background:#6366f1; color:#ffffff; border:none; padding:0.75rem 1.5rem; border-radius:8px; cursor:pointer; font-weight:500; font-family:'Poppins', sans-serif; font-size:0.95rem; transition:background 0.3s ease;" onmouseover="this.style.background='#4f46e5'" onmouseout="this.style.background='#6366f1';">
                    Opublikuj
                </button>
                <button id="cancelReview" type="button" style="flex:1; background:#2a2a3e; color:#a0a0b0; border:none; padding:0.75rem 1.5rem; border-radius:8px; cursor:pointer; font-weight:500; font-family:'Poppins', sans-serif; font-size:0.95rem; transition:all 0.3s ease;" onmouseover="this.style.background='#3a3a4e'; this.style.color='#ffffff'" onmouseout="this.style.background='#2a2a3e'; this.style.color='#a0a0b0';">
                    Anuluj
                </button>
            </div>
        </div>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('reviewModal');
    const openBtn = document.getElementById('openReviewModal');
    const closeBtn = document.getElementById('closeReviewModal');
    const cancelBtn = document.getElementById('cancelReview');
    const submitBtn = document.getElementById('submitReview');
    const starsContainer = document.getElementById('starsContainer');
    const stars = document.querySelectorAll('.star');
    const selectedRatingInput = document.getElementById('selectedRating');
    const reviewForm = document.getElementById('reviewForm');
    const formRating = document.getElementById('formRating');
    const formComment = document.getElementById('formComment');
    const commentInput = document.getElementById('reviewComment');
    let selectedRating = 0;

    // Open modal
    openBtn.addEventListener('click', function() {
        modal.style.display = 'flex';
    });

    // Close modal
    closeBtn.addEventListener('click', function() {
        modal.style.display = 'none';
        resetForm();
    });

    cancelBtn.addEventListener('click', function() {
        modal.style.display = 'none';
        resetForm();
    });

    // Close modal when clicking outside
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.style.display = 'none';
            resetForm();
        }
    });

    // Star rating
    stars.forEach(star => {
        star.addEventListener('mouseover', function() {
            const rating = parseInt(this.dataset.rating);
            updateStars(rating);
        });

        star.addEventListener('click', function() {
            selectedRating = parseInt(this.dataset.rating);
            selectedRatingInput.value = selectedRating;
            updateStars(selectedRating);
        });
    });

    starsContainer.addEventListener('mouseleave', function() {
        updateStars(selectedRating);
    });

    function updateStars(rating) {
        stars.forEach(star => {
            const starRating = parseInt(star.dataset.rating);
            if (starRating <= rating) {
                star.style.color = '#fbbf24';
            } else {
                star.style.color = '#4b5563';
            }
        });
    }

    // Submit review
    submitBtn.addEventListener('click', function() {
        if (selectedRating === 0) {
            alert('Proszę wybrać ocenę');
            return;
        }

        formRating.value = selectedRating;
        formComment.value = commentInput.value.trim();
        reviewForm.submit();
    });

    function resetForm() {
        selectedRating = 0;
        selectedRatingInput.value = 0;
        commentInput.value = '';
        updateStars(0);
    }
});
</script>

<?php $main = ob_get_clean();
include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
