<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Home\Actions;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as View;

/**
 * Class EnterNewPasswordAction
 * @package App\Home\Actions
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class EnterNewPasswordAction
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

        $data = [
            'token' => $request->getAttribute('token')
        ];
        return $this->view->render($response, 'partials/home/enter-new-password.twig', $data);
    }
}