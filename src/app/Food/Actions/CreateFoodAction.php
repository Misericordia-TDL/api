<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This action class will receive a data to create a new food. If validation fails
 * Request will be redirected to EnterFoodDataAction with the validation error messages
 * in its views.
 */

namespace App\Food\Actions;

use App\Core\Actions\CreateAction;
use App\Core\Model\Exception\EmptyDataSetException;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Validator as v;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class createFood
 * @package App\Food\Actions
 * @author Cyprian Laskowski <cyplas@gmail.com>
 */
final class CreateFoodAction extends CreateAction
{


    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {

        //Check if food with this name already exists
        try {
            $name = $request->getParam('name');
            /** @var Food $food */
            $food = $this->repository->findByName($name);
            $found = true;
        } catch (\InvalidArgumentException $e) {
            $found = false;
        }

        if ($found) {

            $this->flash->addMessage('error', 'Food with this name already exists.');

        } else {

            //validate rules for a new food
            $validation = $this->validator->validate($request, [
                'name' => v::notEmpty()->alpha()->length(2, 20),
                'quantity' => v::noWhitespace()->notEmpty()->intVal(),
            ]);

            //check if validation passes
            if ($validation->failed()) {
                $this->flash->addMessage('error', 'Food data is not correct');
                return $response->withRedirect($this->router->pathFor('enter-food-data'));
            }

            //Try to insert data into food collection and in case
            //There's an error, a flash message in the view will inform the user what went wrong.
            try {
                $this->repository->insert($request->getParams());
                $this->flash->addMessage('info', 'Food created correctly');

            } catch (\InvalidArgumentException $e) {
                $this->flash->addMessage('error', 'Food not found. Could not perform deletion.');
            } catch (EmptyDataSetException $e) {
                $this->flash->addMessage('error', $e->getMessage());
            }

        }

        return $response->withRedirect($this->router->pathFor('list-food'));

    }
}