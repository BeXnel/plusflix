<?php
/** @var \App\Service\Router $router */
$title = 'Panel administracyjny';
$bodyClass = 'index';
ob_start(); ?>
    <h1>Panel administracyjny</h1>
    <a href="<?= $router->generatePath('') ?>">Powrót do strony głównej</a>
    <section class="top-list-section">
        <div class="movies-list">
            <div class="movie-row">
                <div class="info-col">
                    <div class="movie-title">
                        <a href="<?= $router->generatePath('admin-manage-movies') ?>">
                            Zarządzaj filmami
                        </a>
                    </div>
                </div>
            </div>
            <div class="movie-row">
                <div class="info-col">
                    <div class="movie-title">
                        <a href="<?= $router->generatePath('genre-index') ?>">
                            Zarządzaj gatunkami
                        </a>
                    </div>
                </div>
            </div>
            <div class="movie-row">
                <div class="info-col">
                    <div class="movie-title">
                        <a href="<?= $router->generatePath('admin-manage-platforms') ?>">
                            Zarządzaj platformami
                        </a>
                    </div>
                </div>
        </div>
    </section>
<?php $main = ob_get_clean();
include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
