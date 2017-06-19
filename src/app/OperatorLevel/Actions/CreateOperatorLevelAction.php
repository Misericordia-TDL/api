<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\OperatorLevel\Actions;

use App\Core\Actions\CreateAction;
use App\Core\Model\Exception\EmptyDataSetException;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Validator as v;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class CreateOperatorLevelAction
 * @package App\OperatorLevel
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class CreateOperatorLevelAction extends CreateAction
{
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

            $this->repository->insert($request->getParams());
            $this->flash->addMessage('info', 'Operator created correctly');

        } catch (\InvalidArgumentException $e) {
        } catch (EmptyDataSetException $e) {
            $this->flash->addMessage('error', $e->getMessage());
        }
        return $response->withRedirect($this->router->pathFor('list-operator-level'));
    }
}