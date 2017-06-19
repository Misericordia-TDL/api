<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Core\Actions;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as View;

/**
 * Class EnterFoodDataAction
 * @package App\Core\Actions
 * @author Cyprian Laskowski <cyplas@gmail.com>
 * @author Javier Mellado <sol@javiermellado.com>
 */
abstract class EnterDataAction implements InvokableActionInterface
{
    /**
     * @var string
     */
    protected $template;
    /**
     * @var View
     */
    protected $view;
    /**
     * @var string
     */
    protected $element;
    /**
     * FoodController constructor.
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
        return $this->view->render($response, $this->template, []);
    }
}
