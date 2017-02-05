<?php
// DIC configuration
$container = $app->getContainer();

// view renderer
$container['view'] = function ($container) {
    $settings = $container->get('settings')['renderer'];
    $view = new Slim\Views\Twig($settings['template_path']);

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));

    return $view;
};

// monolog
$container['logger'] = function ($container) {
    $settings = $container->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};
// monolog
$container['HomeController'] = function ($container) {

    $view = $container->view;
    return new \App\Controllers\HomeController($view);
};