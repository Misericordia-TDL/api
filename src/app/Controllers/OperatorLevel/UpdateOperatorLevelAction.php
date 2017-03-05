<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Controllers\OperatorLevel;

use App\Models\OperatorLevel;
use App\Repository\OperatorLevelRepository;
use App\Validation\Validator;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Validator as v;
use Slim\Flash\Messages;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Interfaces\RouterInterface;

/**
 * Class UpdateOperatorLevelAction
 * @package App\Controllers\Operator
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class UpdateOperatorLevelAction
{
    /**
     * @var OperatorLevelRepository
     */
    protected $operatorLevelRepository;
    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var Validator
     */
    private $validator;
    /**
     * @var Messages
     */
    private $flash;

    /**
     * OperatorController constructor.
     * @param RouterInterface $router
     * @param Validator $validator
     * @param OperatorLevelRepository $operatorLevelRepository
     * @param Messages $flash
     * @internal param View $view
     */
    function __construct(
        RouterInterface $router,
        Validator $validator,
        OperatorLevelRepository $operatorLevelRepository,
        Messages $flash
    )
    {
        $this->router = $router;
        $this->validator = $validator;
        $this->flash = $flash;
        $this->operatorLevelRepository = $operatorLevelRepository;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {

        try {
            $id = $request->getAttribute('id');
            /** @var  OperatorLevel $originalOperatorLevel */
            $originalOperatorLevel = $this->operatorLevelRepository->findById($id);

            $validation = $this->validator->validate($request, [
                'name' => v::notEmpty()->alpha()->length(2, 20),
                'description' => v::notEmpty()->alpha()->length(2, 200),
            ]);

            if ($validation->failed()) {
                $this->flash->addMessage('error', 'Operator level data is not correct');
                return $response->withRedirect($this->router->pathFor('edit-operator-level', ['id' => $id]));
            }

            $originalOperatorLevel->update($request->getParams());

            $this->flash->addMessage('info', 'Operator Level updated correctly');

            return $response->withRedirect($this->router->pathFor('list-operator-level'));
        } catch (\InvalidArgumentException $e) {
            return $response->withRedirect($this->router->pathFor('list-operator-level'));
        }


    }
}