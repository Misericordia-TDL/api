<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Controllers;

use App\Models\User;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as View;

/**
 * Class UserController
 * @package App\Controllers
 * @author Javier Mellado <sol@javiermellado.com>
 */
class UserController
{
    /**
     * @var View
     */
    protected $view;
    /**
     * @var User
     */
    protected $userModel;

    /**
     * UserController constructor.
     * @param View $view
     * @param User $userModel
     */
    function __construct(
        View $view,
        User $userModel
    )
    {
        $this->view = $view;
        $this->userModel = $userModel;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function index(Request $request, Response $response): ResponseInterface
    {

        $data = ['data' => $this->userModel->findAll()];
        return $this->view->render($response, 'home/index.twig', $data);
    }
}