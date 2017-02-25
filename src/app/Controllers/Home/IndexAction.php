<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Controllers\Home;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as View;

/**
 * Class IndexAction
 * @package App\Controllers\Home
 * @author Javier Mellado <sol@javiermellado.com>
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

        return $this->view->render($response, 'home/index.twig', $data);
    }
}