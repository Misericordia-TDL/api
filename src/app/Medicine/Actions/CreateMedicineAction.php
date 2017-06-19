<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This action class will receive a data to create a new medicine. If validation fails
 * Request will be redirected to EnterMedicineDataAction with the validation error messages
 * in its views.
 */

namespace App\Medicine\Actions;

use App\Core\Actions\CreateAction;
use App\Core\Model\Exception\EmptyDataSetException;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Validator as v;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class createMedicine
 * @package App\Medicine\Actions
 * @author Cyprian Laskowski <cyplas@gmail.com>
 */
final class CreateMedicineAction extends CreateAction
{
    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {

        //Check if medicine with this name already exists
        try {
            $name = $request->getParam('name');
            $medicine = $this->repository->findByName($name);
            $found = true;
        } catch (\InvalidArgumentException $e) {
            $found = false;
        }

        if ($found) {

            $this->flash->addMessage('error', 'Medicine with this name already exists.');

        } else {

            //validate rules for a new medicine
            $validation = $this->validator->validate($request, [
                'name' => v::notEmpty()->alpha()->length(2, 20),
                'quantity' => v::noWhitespace()->notEmpty()->intVal(),
            ]);

            //check if validation passes
            if ($validation->failed()) {
                $this->flash->addMessage('error', 'Medicine data is not correct');
                return $response->withRedirect($this->router->pathFor('enter-medicine-data'));
            }

            //Try to insert data into medicine collection and in case
            //There's an error, a flash message in the view will inform the user what went wrong.
            try {
                $params = $request->getParams();
                $params['arrival_date'] = date_create($params['arrival_date']);
                $params['expiry_date'] = date_create($params['expiry_date']);
                $this->repository->insert($params);
                $this->flash->addMessage('info', 'Medicine created correctly');

            } catch (\InvalidArgumentException $e) {
                $this->flash->addMessage('error', 'Medicine not found. Could not perform deletion.');
            } catch (EmptyDataSetException $e) {
                $this->flash->addMessage('error', $e->getMessage());
            }

        }

        return $response->withRedirect($this->router->pathFor('list-medicine'));

    }
}