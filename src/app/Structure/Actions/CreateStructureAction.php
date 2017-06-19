<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */

namespace App\Structure\Actions;


use App\Core\Actions\CreateAction;
use App\Core\Model\Exception\EmptyDataSetException;
use App\Structure\Model\Structure;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Validator as v;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class CreateStructureAction
 * @author Javier Mellado <sol@javiermellado.com>
 */
class CreateStructureAction extends CreateAction
{
    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {

        //Check if structure with this name already exists
        try {
            $name = $request->getParam('name');
            /** @var Structure $structure */
            $this->repository->findByName($name);
            $found = true;
        } catch (\InvalidArgumentException $e) {
            $found = false;
        }

        if ($found) {

            $this->flash->addMessage('error', 'Structure with this name already exists.');

        } else {

            //validate rules for a new structure
            $validation = $this->validator->validate($request, [
                'name' => v::notEmpty()->alpha()->length(2, 20),
                'capacity' => v::noWhitespace()->notEmpty()->intVal(),
            ]);

            //check if validation passes
            if ($validation->failed()) {
                $this->flash->addMessage('error', 'Structure data is not correct');
                return $response->withRedirect($this->router->pathFor('enter-structure-data'));
            }

            //Try to insert data into structure collection and in case
            //There's an error, a flash message in the view will inform the user what went wrong.
            try {
                $this->repository->insert($request->getParams());
                $this->flash->addMessage('info', 'Structure created correctly');

            } catch (\InvalidArgumentException $e) {
                $this->flash->addMessage('error', 'Structure not found. Could not perform insertion.');
            } catch (EmptyDataSetException $e) {
                $this->flash->addMessage('error', $e->getMessage());
            }

        }

        return $response->withRedirect($this->router->pathFor('list-structure'));

    }
}