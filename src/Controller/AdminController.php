<?php
namespace App\Controller;

use App\Service\Router;
use App\Service\Templating;

class AdminController
{
    public function indexAction(Templating $templating, Router $router): ?string
    {
        $html = $templating->render('admin/index.html.php', [
            'router' => $router,
        ]);
        return $html;
    }
}
