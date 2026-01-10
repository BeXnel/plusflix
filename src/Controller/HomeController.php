<?php

namespace App\Controller;

use App\Service\Router;
use App\Service\Templating;

class HomeController{
    public function indexAction(Templating $templating, Router $router): ?string{
        $topMovies=[
            ['rank' => 1, 'title' => 'Tytuł Filmu A', 'year' => '1999', 'platform' => 'netflix'],
            ['rank' => 2, 'title' => 'Tytuł Filmu B', 'year' => '2023', 'platform' => 'disney'],
            ['rank' => 3, 'title' => 'Tytuł Filmu C', 'year' => '2025', 'platform' => 'netflix'],
        ];

        return $templating->render('home/index.html.php', [
            'topMovies' => $topMovies,
            'router' => $router
        ]);
    }
}