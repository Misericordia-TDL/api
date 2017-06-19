<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Structure\Actions;

use App\Core\Actions\UpdateAction;
use App\Structure\Model\Structure;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Validator as v;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class UpdateStructureAction
 * @package App\Structure\Actions
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class UpdateStructureAction extends UpdateAction
{
    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {

        try {
            //get id from url
            $id = $request->getAttribute('id');
            /** @var  Structure $originalStructure */
            $originalStructure = $this->repository->findById($id);


            $validation = $this->validator->validate($request, [
                'name' => v::notEmpty()->alpha()->length(2, 200),
                'capacity' => v::noWhitespace()->notEmpty()->intVal(),
            ]);

            //If validation fails, return to edit form with error messages embeded in the view
            if ($validation->failed()) {
                $this->flash->addMessage('error', 'Structure data is not correct');
                return $response->withRedirect($this->router->pathFor('edit-structure', ['id' => $id]));
            }

            $originalStructure->update($request->getParams());

            $this->flash->addMessage('info', 'Structure updated correctly');

        } catch (\InvalidArgumentException $e) {
        }
            return $response->withRedirect($this->router->pathFor('list-structure'));
    }
}