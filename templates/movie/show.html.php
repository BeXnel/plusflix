<?php
/** @var \App\Model\Movie $movie */
/** @var \App\Service\Router $router */
$title = $movie->getTitle();
$bodyClass = 'show';
ob_start();
?>

<style>
.show {
    background: linear-gradient(180deg, #0f0f23 0%, #0a0a15 100%);
    min-height: 100vh;
}

.show .movie-detail-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem 1.5rem;
}

.show .movie-hero {
    display: grid;
    grid-template-columns: 320px 1fr;
    gap: 2.5rem;
    margin-bottom: 3rem;
}

.show .movie-banner {
    width: 100%;
    height: 450px;
    background: linear-gradient(135deg, #2a2a3e 0%, #1a1a2e 100%);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #4b5563;
    font-size: 3rem;
    font-weight: 200;
    letter-spacing: 0.1em;
    border: 2px dashed #3a3a4e;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    position: relative;
    overflow: hidden;
}

.show .movie-banner::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(99, 102, 241, 0.05) 0%, transparent 70%);
    pointer-events: none;
}

.show .movie-banner-text {
    position: relative;
    z-index: 1;
    text-align: center;
    line-height: 1.2;
}

.show .movie-info-main {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.show .movie-header-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1.5rem;
}

.show .movie-title-section {
    flex: 1;
}

.show .movie-title {
    font-size: 2.75rem;
    font-weight: 700;
    color: #ffffff;
    margin: 0 0 0.5rem 0;
    letter-spacing: -0.02em;
    line-height: 1.1;
}

.show .movie-rating-badge {
    background: #6366f1;
    color: #ffffff;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
    font-family: 'Poppins', sans-serif;
    font-size: 0.95rem;
    transition: background 0.3s ease;
    margin-top: 1rem;
    display: inline-block;
}

.show .add-review-btn {
    background: #6366f1;
    color: #ffffff;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 500;
    font-family: 'Poppins', sans-serif;
    font-size: 0.95rem;
    transition: background 0.3s ease;
    margin-top: 1rem;
    display: inline-block;
}

.show .add-review-btn:hover {
    background: #4f46e5;
}

.show .movie-meta-grid {
    display: grid;
    gap: 1rem;
    margin-bottom: 2rem;
}

.show .meta-item {
    display: flex;
    align-items: baseline;
    gap: 0.75rem;
}

.show .meta-label {
    font-size: 0.9rem;
    color: #6366f1;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    min-width: 100px;
}

.show .meta-value {
    font-size: 1.1rem;
    color: #ffffff;
    font-weight: 400;
}

/* Pozostałe sekcje */
.show .description-card {
    background: linear-gradient(135deg, rgba(22, 22, 42, 0.8) 0%, rgba(26, 26, 46, 0.6) 100%);
    border: 1px solid #2a2a3e;
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2.5rem;
    line-height: 1.8;
}

.show .section-label {
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: #6366f1;
    font-weight: 600;
    margin-bottom: 1rem;
    display: block;
}

.show .description-text {
    font-size: 1.05rem;
    color: #e0e0e0;
    line-height: 1.7;
}

.show .genres-section,
.show .platforms-section,
.show .reviews-section {
    margin-bottom: 2.5rem;
}

.show .section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.show .section-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #ffffff;
    margin: 0;
    position: relative;
}

.show .section-title::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 40px;
    height: 3px;
    background: linear-gradient(90deg, #6366f1, transparent);
    border-radius: 2px;
}

.show .platforms-grid {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
}

.show .platform-badge {
    position: relative;
    width: 70px;
    height: 70px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    font-weight: 700;
    color: white;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
}

.show .platform-badge::before {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 16px;
    padding: 2px;
    background: linear-gradient(135deg, rgba(255,255,255,0.2), rgba(255,255,255,0.05));
    mask-composite: exclude;
    opacity: 0;
    transition: opacity 0.3s;
}

.show .platform-badge:hover {
    transform: translateY(-4px) scale(1.05);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
}

.show .platform-badge:hover::before {
    opacity: 1;
}

.show .platform-badge.netflix {
    background: #000000;
}

.show .platform-badge.netflix .platform-logo {
    color: #E50914;
}

.show .platform-badge.hbo {
    background: linear-gradient(135deg, #8440bf, #5d2e89);
}

.show .platform-badge.disney {
    background: linear-gradient(135deg, #0063e5, #004ba8);
}

.show .platform-badge.prime {
    background: linear-gradient(135deg, #00a8e1, #0073a8);
}

.show .platform-badge.skyshowtime {
    background: linear-gradient(135deg, #0056d6, #003d99);
}

.show .reviews-container {
    display: grid;
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.show .review-card {
    background: rgba(22, 22, 42, 0.6);
    border: 1px solid #2a2a3e;
    border-radius: 16px;
    padding: 1.75rem;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.show .review-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: linear-gradient(180deg, #6366f1, #818cf8);
    opacity: 0;
    transition: opacity 0.3s;
}

.show .review-card:hover {
    border-color: #6366f1;
    transform: translateX(4px);
}

.show .review-card:hover::before {
    opacity: 1;
}

.show .review-stars {
    display: flex;
    gap: 0.25rem;
    font-size: 1.1rem;
    margin-bottom: 1rem;
}

.show .review-stars .star-filled {
    color: #fbbf24;
}

.show .review-stars .star-empty {
    color: #4b5563;
}

.show .review-comment {
    color: #e0e0e0;
    line-height: 1.7;
    margin: 0;
}

.show .genre-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.show .genre-tag {
    background: rgba(99, 102, 241, 0.15);
    color: #6366f1;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-size: 0.9rem;
    font-weight: 500;
    border: 1px solid rgba(99, 102, 241, 0.2);
}

.show .navigation-buttons {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
    padding-top: 2rem;
    border-top: 1px solid #2a2a3e;
}

.show .nav-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: #6366f1;
    font-weight: 500;
    text-decoration: none;
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    border: 1px solid rgba(99, 102, 241, 0.2);
    transition: all 0.3s ease;
    background: rgba(99, 102, 241, 0.05);
}

.show .nav-link:hover {
    color: #ffffff;
    background: rgba(99, 102, 241, 0.15);
    border-color: #6366f1;
    transform: translateX(-4px);
}

.show .no-reviews {
    text-align: center;
    padding: 3rem;
    color: #a0a0b0;
    font-style: italic;
}

@media (max-width: 968px) {
    .show .movie-hero {
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    .show .movie-banner {
        height: 400px;
    }

    .show .movie-header-top {
        flex-direction: column;
        gap: 1rem;
    }

    .show .movie-title {
        font-size: 2rem;
    }
}

@media (max-width: 768px) {
    .show .movie-detail-container {
        padding: 1.5rem 1rem;
    }

    .show .movie-banner {
        height: 350px;
    }

    .show .movie-title {
        font-size: 1.75rem;
    }

    .show .meta-label {
        min-width: 80px;
        font-size: 0.85rem;
    }

    .show .meta-value {
        font-size: 1rem;
    }

    .show .section-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .show .navigation-buttons {
        flex-direction: column;
    }

    .show .nav-link:hover {
        transform: translateY(-2px);
    }
}
</style>

<div class="movie-detail-container">
    <div class="movie-hero">
        <!-- banner placeholder -->
        <div class="movie-banner">
            <div class="movie-banner-text">BANNER<br>FILMU</div>
        </div>

        <div class="movie-info-main">
            <div>
                <div class="movie-header-top">
                    <div class="movie-title-section">
                        <h1 class="movie-title"><?= htmlspecialchars($movie->getTitle(), ENT_QUOTES, 'UTF-8') ?></h1>
                    </div>
                </div>

                <div class="movie-meta-grid">
                    <div class="meta-item">
                        <span class="meta-label">Rok</span>
                        <span class="meta-value"><?= $movie->getYear() ?></span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Reżyser</span>
                        <span class="meta-value"><?= htmlspecialchars($movie->getDirector(), ENT_QUOTES, 'UTF-8') ?></span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Czas trwania</span>
                        <span class="meta-value"><?= $movie->getDuration() ?> min</span>
                    </div>
                </div>
            </div>

            <div>
                 <?php if ($movie->getAverageRating()): ?>
                        <div class="movie-rating-badge">
                            ⭐ <?= number_format($movie->getAverageRating(), 1) ?>
                        </div>
                    <?php endif; ?>
                <button id="openReviewModal" class="add-review-btn">
                    Dodaj recenzję
                </button>
            </div>
        </div>
    </div>

    <div class="description-card">
        <span class="section-label">Opis</span>
        <p class="description-text"><?= htmlspecialchars($movie->getDescription(), ENT_QUOTES, 'UTF-8') ?></p>
    </div>

    <div class="genres-section">
        <span class="section-label">Gatunki</span>
        <div class="genre-tags">
            <?php foreach ($movie->getGenres() as $genre): ?>
                <span class="genre-tag"><?= htmlspecialchars($genre->getName(), ENT_QUOTES, 'UTF-8') ?></span>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="platforms-section">
        <div class="section-header">
            <h3 class="section-title">Dostępne na platformach</h3>
        </div>
        <div class="platforms-grid">
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
                <a href="<?= $url ?>"
                   class="platform-badge <?= htmlspecialchars($clean_name, ENT_QUOTES, 'UTF-8') ?>"
                   title="<?= htmlspecialchars($platform->getName(), ENT_QUOTES, 'UTF-8') ?>"
                   target="_blank">
                    <span class="platform-logo"><?= htmlspecialchars($display_text, ENT_QUOTES, 'UTF-8') ?></span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Reviews -->
    <div class="reviews-section">
        <div class="section-header">
            <h3 class="section-title">Recenzje użytkowników</h3>
        </div>

        <?php if (count($movie->getReviews()) > 0): ?>
            <div class="reviews-container">
                <?php foreach ($movie->getReviews() as $review): ?>
                    <div class="review-card">
                        <div class="review-stars">
                            <?php for ($i = 0; $i < $review->getRating(); $i++): ?>
                                <span class="star-filled">★</span>
                            <?php endfor; ?>
                            <?php for ($i = $review->getRating(); $i < 5; $i++): ?>
                                <span class="star-empty">★</span>
                            <?php endfor; ?>
                        </div>
                        <?php if ($review->getComment()): ?>
                            <p class="review-comment"><?= htmlspecialchars($review->getComment(), ENT_QUOTES, 'UTF-8') ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-reviews">
                Brak recenzji. Bądź pierwszy, który oceni ten film!
            </div>
        <?php endif; ?>
    </div>

    <!-- Review Modal -->
    <div id="reviewModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); z-index:1000; justify-content:center; align-items:center;">
        <div style="background:#1a1a2e; border:1px solid #2a2a3e; border-radius:16px; padding:2rem; max-width:500px; width:90%; box-shadow:0 10px 40px rgba(0,0,0,0.5);">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
                <h3 style="color:#ffffff; margin:0; font-size:1.5rem;">Dodaj recenzję</h3>
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
                <label style="display:block; color:#ffffff; font-weight:500; margin-bottom:0.75rem;">Komentarz (opcjonalne)</label>
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

    <div class="navigation-buttons">
        <a href="<?= $router->generatePath('movie-index') ?>" class="nav-link">
            <span>←</span>
            <span>Powrót do listy filmów</span>
        </a>
        <a href="<?= $router->generatePath('') ?>" class="nav-link">
            <span>←</span>
            <span>Strona główna</span>
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

    openBtn.addEventListener('click', function() {
        modal.style.display = 'flex';
    });

    closeBtn.addEventListener('click', function() {
        modal.style.display = 'none';
        resetForm();
    });

    cancelBtn.addEventListener('click', function() {
        modal.style.display = 'none';
        resetForm();
    });

    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.style.display = 'none';
            resetForm();
        }
    });

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
