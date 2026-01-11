<?php
namespace App\Controller;

use App\Exception\NotFoundException;
use App\Model\admin;
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

    // public function createAction(?array $requestPost, Templating $templating, Router $router): ?string
    // {
    //     if ($requestPost) {
    //         $admin = admin::fromArray($requestPost);
    //         $admin->save();

    //         $path = $router->generatePath('admin-index');
    //         $router->redirect($path);
    //         return null;
    //     } else {
    //         $admin = new admin();
    //     }

    //     $html = $templating->render('admin/create.html.php', [
    //         'admin' => $admin,
    //         'router' => $router,
    //     ]);
    //     return $html;
    // }

    // public function editAction(int $adminId, ?array $requestPost, Templating $templating, Router $router): ?string
    // {
    //     $admin = admin::find($adminId);
    //     if (! $admin) {
    //         throw new NotFoundException("Missing admin with id $adminId");
    //     }

    //     if ($requestPost) {
    //         $admin->fill($requestPost);
    //         $admin->save();

    //         $path = $router->generatePath('admin-index');
    //         $router->redirect($path);
    //         return null;
    //     }

    //     $html = $templating->render('admin/edit.html.php', [
    //         'admin' => $admin,
    //         'router' => $router,
    //     ]);
    //     return $html;
    // }

    // public function showAction(int $adminId, Templating $templating, Router $router): ?string
    // {
    //     $admin = admin::find($adminId);
    //     if (! $admin) {
    //         throw new NotFoundException("Missing admin with id $adminId");
    //     }

    //     $html = $templating->render('admin/show.html.php', [
    //         'admin' => $admin,
    //         'router' => $router,
    //     ]);
    //     return $html;
    // }

    // public function deleteAction(int $adminId, Router $router): ?string
    // {
    //     $admin = admin::find($adminId);
    //     if (! $admin) {
    //         throw new NotFoundException("Missing admin with id $adminId");
    //     }

    //     $admin->delete();
    //     $path = $router->generatePath('admin-index');
    //     $router->redirect($path);
    //     return null;
    // }
}
