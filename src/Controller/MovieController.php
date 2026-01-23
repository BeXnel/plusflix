<?php
namespace App\Controller;
use App\Exception\NotFoundException;
use App\Model\Movie;
use App\Service\Router;
use App\Service\Templating;
class MovieController
{
    public function indexAction(Templating $templating, Router $router): ?string
    {
        $q = $_GET['q'] ?? '';
        $genreIds = array_map('intval', $_GET['genre'] ?? []);
        $platformIds = array_map('intval', $_GET['platform'] ?? []);
        $movies = Movie::findByCriteria($q, $genreIds, $platformIds);
        $html = $templating->render('movie/index.html.php', [
            'movies' => $movies,
            'router' => $router,
        ]);
        return $html;
    }
    public function adminAction(Templating $templating, Router $router): ?string
    {
        $movies = Movie::findAll();
        $html = $templating->render('movie/admin_index.html.php', [
            'movies' => $movies,
            'router' => $router,
        ]);
        return $html;
    }
    public function createAction(?array $requestPost, Templating $templating, Router $router): ?string
    {
        if ($requestPost) {
            $movie = Movie::fromArray($requestPost);
            $movie->save();
            $path = $router->generatePath('movie-admin');
            $router->redirect($path);
            return null;
        } else {
            $movie = new Movie();
        }
        $html = $templating->render('movie/create.html.php', [
            'movie' => $movie,
            'router' => $router,
            'genres' => \App\Model\Genre::findAll(),
            'platforms' => \App\Model\Platform::findAll(),
        ]);
        return $html;
    }
    public function editAction(int $movieId, ?array $requestPost, Templating $templating, Router $router): ?string
    {
        $movie = Movie::find($movieId);
        if (! $movie) {
            throw new NotFoundException("Missing movie with id $movieId");
        }
        if ($requestPost) {
            $movie->fill($requestPost);
            $movie->save();
            $path = $router->generatePath('movie-admin');
            $router->redirect($path);
            return null;
        }
        $html = $templating->render('movie/edit.html.php', [
            'movie' => $movie,
            'router' => $router,
            'genres' => \App\Model\Genre::findAll(),
            'platforms' => \App\Model\Platform::findAll(),
        ]);
        return $html;
    }
    public function showAction(int $movieId, Templating $templating, Router $router): ?string
    {
        $movie = Movie::find($movieId);
        if (! $movie) {
            throw new NotFoundException("Missing movie with id $movieId");
        }
        $html = $templating->render('movie/show.html.php', [
            'movie' => $movie,
            'router' => $router,
        ]);
        return $html;
    }
    public function deleteAction(int $movieId, Router $router): ?string
    {
        $movie = Movie::find($movieId);
        if (! $movie) {
            throw new NotFoundException("Missing movie with id $movieId");
        }
        $movie->delete();
        $path = $router->generatePath('movie-admin');
        $router->redirect($path);
        return null;
    }
}
