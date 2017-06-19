<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Core\Actions;

use App\Core\Repository\RepositoryInterface;
use App\Validation\Validator;
use Slim\Flash\Messages;
use Slim\Interfaces\RouterInterface;

/**
 * Class UpdateFoodAction
 * @package App\Food\Actions
 * @author Cyprian Laskowski <cyplas@gmail.com>
 * @author Javier Mellado <sol@javiermellado.com>
 */
abstract class UpdateAction implements InvokableActionInterface
{
    /**
     * @var RepositoryInterface
     */
    protected $repository;
    /**
     * @var RouterInterface
     */
    protected $router;
    /**
     * @var Validator
     */
    protected $validator;
    /**
     * @var Messages
     */
    protected $flash;

    /**
     * FoodController constructor.
     * @param RouterInterface $router
     * @param Validator $validator
     * @param RepositoryInterface $repository
     * @param Messages $flash
     */
    function __construct(
        RouterInterface $router,
        Validator $validator,
        RepositoryInterface $repository,
        Messages $flash
    )
    {
        $this->router = $router;
        $this->validator = $validator;
        $this->flash = $flash;
        $this->repository = $repository;
    }
}