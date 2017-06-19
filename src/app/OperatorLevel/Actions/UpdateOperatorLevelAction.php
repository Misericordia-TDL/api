<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\OperatorLevel\Actions;

use App\Core\Actions\UpdateAction;
use App\OperatorLevel\Model\OperatorLevel;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Validator as v;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class UpdateOperatorLevelAction
 * @package App\Controllers\Operator
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class UpdateOperatorLevelAction extends UpdateAction
{
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
            $originalOperatorLevel = $this->repository->findById($id);

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