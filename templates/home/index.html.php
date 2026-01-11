<?php
/** @var array $topMovies */
/** @var \App\Service\Router $router */
$title = 'PLUSFLIX';
$bodyClass = 'index';
ob_start(); ?>
    <header class="app-header">
        <div class="header-container">
            <div class="logo">
                <span class="logo-plus">PLUS</span><span class="logo-flix">FLIX</span>
            </div>
            <button class="saved-btn" aria-label="Zapisane filmy">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                </svg>
            </button>
        </div>
    </header>

    <div class="container">
        <section class="hero-section">
            <h1 class="hero-title">Znajdź swój następny film</h1>
            <p class="hero-subtitle">Przeglądaj tysiące filmów i seriali z Netflix, Disney+, HBO i innych platform w jednym miejscu</p>
        </section>

        <section class="platforms-section">
            <h2 class="section-title">Dostępne platformy</h2>
            <div class="platforms-wrapper">
                <button class="nav-arrow left" aria-label="Poprzednie platformy">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </button>
                <div class="platforms-list">
                    <div class="platform-badge netflix" title="Netflix">
                        <span class="platform-logo">N</span>
                    </div>
                    <div class="platform-badge disney" title="Disney+">
                        <span class="platform-logo">D+</span>
                    </div>
                    <div class="platform-badge hbo" title="HBO Max">
                        <span class="platform-logo">H</span>
                    </div>
                    <div class="platform-badge skyshowtime" title="SkyShowtime">
                        <span class="platform-logo">S</span>
                    </div>
                    <div class="platform-badge prime" title="Prime Video">
                        <span class="platform-logo">P</span>
                    </div>
                </div>
                <button class="nav-arrow right" aria-label="Następne platformy">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </button>
            </div>
        </section>

        <section class="top-list-section">
            <h2 class="section-title">Najpopularniejsze filmy</h2>
            <div class="movies-list">
                <?php foreach ($topMovies as $movie): ?>
                    <div class="movie-card">
                        <div class="rank-badge">
                            <?php if($movie['rank'] == 1): ?>
                                <span class="crown-icon">👑</span>
                            <?php endif; ?>
                            <span class="rank-number"><?= $movie['rank'] ?></span>
                        </div>
                        <div class="movie-info">
                            <h3 class="movie-title"><?= $movie['title'] ?></h3>
                            <p class="movie-year"><?= $movie['year'] ?></p>
                        </div>
                        <div class="movie-platform">
                            <?php
                            $clean_name = preg_replace('/[^a-z0-9]/', '', strtolower($movie['platform']));
                            $display_text = ($clean_name === 'disney') ? 'D+' : strtoupper(substr($clean_name, 0, 1));
                            ?>
                            <div class="platform-badge <?= $clean_name ?>" title="<?= $movie['platform'] ?>">
                                <span class="platform-logo"><?= $display_text ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>

    <footer class="app-footer">
        <p>&copy; 2026 PLUSFLIX</p>
    </footer>
<?php $main = ob_get_clean();
include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';