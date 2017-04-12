<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This action will create a valid new clothe form to be added to the clothe collection
 */

namespace App\Clothe\Actions;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as View;

/**
 * Class EnterClotheDataAction
 * @package App\Clothe\Actions
 * @author Cyprian Laskowski <cyplas@gmail.com>
 */
final class EnterClotheDataAction
{
    /**
     * @var View
     */
    protected $view;
   
    /**
     * ClotheController constructor.
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
        return $this->view->render($response, 'partials/clothe/enter-clothe-data.twig', []);
    }
}
