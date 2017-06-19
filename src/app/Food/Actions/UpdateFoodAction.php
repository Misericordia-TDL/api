<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This class will update the data from an food
 */

namespace App\Food\Actions;

use App\Core\Actions\UpdateAction;
use App\Food\Model\Food;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Validator as v;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class UpdateFoodAction
 * @package App\Food\Actions
 * @author Cyprian Laskowski <cyplas@gmail.com>
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class UpdateFoodAction extends UpdateAction
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
            /** @var  Food $originalFood */
            $originalFood = $this->repository->findById($id);


            $validation = $this->validator->validate($request, [
                'name' => v::notEmpty()->alpha()->length(2, 20),
		'quantity' => v::noWhitespace()->notEmpty()->intVal(),
            ]);

            //If validation fails, return to edit form with error messages embeded in the view
            if ($validation->failed()) {
                $this->flash->addMessage('error', 'Food data is not correct');
                return $response->withRedirect($this->router->pathFor('edit-food', ['id' => $id]));
            }

            $originalFood->update($request->getParams());

            $this->flash->addMessage('info', 'Food updated correctly');

            return $response->withRedirect($this->router->pathFor('list-food'));
        } catch (\InvalidArgumentException $e) {
            return $response->withRedirect($this->router->pathFor('list-food'));
        }
    }
}