<?php
// Routes
/*
$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("aa'/' route");
    // Render index view
    return $this->view->render($response, 'index.twig', $args);
});*/
// Routes
$app->get('/', 'HomeController:index');