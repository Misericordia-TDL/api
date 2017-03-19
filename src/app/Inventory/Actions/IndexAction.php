<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This class will list the number of actions can be taken for inventory
 */

namespace App\Inventory\Actions;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as View;

/**
 * Class IndexAction
 * @package App\Inventory\Actions
 * @author Cyprian Laskowski <cyplas@gmail.com>
 */
final class IndexAction
{
    /**
     * @var View
     */
    protected $view;

    /**
     * IndexAction constructor.
     * @param View $view
     */
    function __construct(
        View $view
    )
    {
        $this->view = $view;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {

        $data = [];
        return $this->view->render($response, 'partials/inventory/index.twig', $data);
    }
}