<?php
namespace App\Controller;

use App\Exception\NotFoundException;
use App\Model\Movie;
use App\Service\MovieService;
use App\Service\Router;
use App\Service\Templating;

class MovieController
{
    public function indexAction(Templating $templating, Router $router): ?string
    {
        $movies = Movie::findAll();
        $html = $templating->render('movie/index.html.php', [
            'movies' => $movies,
            'router' => $router,
        ]);
        return $html;
    }

    public function searchAction(string $searchTerm, Templating $templating, Router $router): ?string
    {
        $movies = Movie::search($searchTerm);
        $html = $templating->render('movie/index.html.php', [
            'movies' => $movies,
            'router' => $router,
        ]);
        return $html;
    }

    public function createAction(?array $requestPost, Templating $templating, Router $router): ?string
    {
        if ($requestPost) {
            $movie = MovieService::save($requestPost);

            $path = $router->generatePath('movie-index');
            $router->redirect($path);
            return null;
        } else {
            $movie = new Movie();
        }

        $html = $templating->render('movie/create.html.php', [
            'movie' => $movie,
            'router' => $router,
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

            $path = $router->generatePath('movie-index');
            $router->redirect($path);
            return null;
        }

        $html = $templating->render('movie/edit.html.php', [
            'movie' => $movie,
            'router' => $router,
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
        $path = $router->generatePath('movie-index');
        $router->redirect($path);
        return null;
    }
}
