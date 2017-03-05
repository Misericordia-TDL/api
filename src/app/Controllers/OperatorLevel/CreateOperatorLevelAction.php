<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Controllers\OperatorLevel;

use App\Repository\OperatorLevelRepository;
use App\Models\Exception\EmptyDataSetException;
use App\Validation\Validator;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Validator as v;
use Slim\Flash\Messages;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Interfaces\RouterInterface;

/**
 * Class CreateOperatorLevelAction
 * @package App\Controllers\OperatorLevel
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class CreateOperatorLevelAction
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
        $this->operatorLevelRepository = $operatorLevelRepository;
        $this->router = $router;
        $this->validator = $validator;
        $this->flash = $flash;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {

        try {
            $validation = $this->validator->validate($request, [
                'name' => v::notEmpty()->alpha()->length(2, 20),
                'description' => v::notEmpty()->alpha()->length(2, 200),
            ]);

            if ($validation->failed()) {
                $this->flash->addMessage('error', 'Operator level data is not correct');
                return $response->withRedirect($this->router->pathFor('enter-operator-level-data'));
            }

            $this->operatorLevelRepository->insert($request->getParams());
            $this->flash->addMessage('info', 'Operator created correctly');

        } catch (\InvalidArgumentException $e) {
        } catch (EmptyDataSetException $e) {
            $this->flash->addMessage('error', $e->getMessage());
        }
        return $response->withRedirect($this->router->pathFor('list-operator-level'));
    }
}