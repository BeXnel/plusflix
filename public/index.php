<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'autoload.php';

$config = new \App\Service\Config();

$templating = new \App\Service\Templating();
$router = new \App\Service\Router();

$action = $_REQUEST['action'] ?? null;

$actionData = getActionData($action);
$actionModel = getActionModel($actionData);
$actionType = getActionType($actionData);

switch ($actionType) {
    case null:
        $view = 'PlusFlix Application';
        break;
    case 'index':
        $controller = getController($action);
        $view = $controller->indexAction($templating, $router);
        break;
    case 'create':
        $controller = getController($action);
        $view = $controller->createAction($_REQUEST['post'] ?? null, $templating, $router);
        break;
    case 'edit':
        if (! $_REQUEST['id']) {
            break;
        }
        $controller = getController($action);
        $view = $controller->editAction($_REQUEST['id'], $_REQUEST['post'] ?? null, $templating, $router);
        break;
    case 'show':
        if (! $_REQUEST['id']) {
            break;
        }
        $controller = getController($action);
        $view = $controller->showAction($_REQUEST['id'], $templating, $router);
        break;
    case 'delete':
        if (! $_REQUEST['id']) {
            break;
        }
        $controller = getController($action);
        $view = $controller->deleteAction($_REQUEST['id'], $router);
        break;
    default:
        $view = 'Not found';
        break;
}

function getActionData(?string $action): array {
    if (! $action) {
        return [];
    }

    return explode('-', $action);
}

function getActionModel(array $actionData): ?string {
    return $actionData[0] ?? null;
}

function getActionType(array $actionData): ?string {
    return $actionData[1] ?? null;
}

function getController(string $actionModel): ?object {
    return match ($actionModel) {
        'movie' => new \App\Controller\MovieController(),
        'genre' => new \App\Controller\GenreController(),
        'platform' => new \App\Controller\PlatformController(),
        default => null,
    };
}

if ($view) {
    echo $view;
}
