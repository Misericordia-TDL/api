<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This action class will receive a data to create a new clothe. If validation fails
 * Request will be redirected to EnterClotheDataAction with the validation error messages
 * in its views.
 */

namespace App\Clothe\Actions;

use App\Clothe\Repository\ClotheRepository;
use App\Core\Actions\CreateAction;
use App\Core\Model\Exception\EmptyDataSetException;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Validator as v;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class createClothe
 * @package App\Clothe\Actions
 * @author Cyprian Laskowski <cyplas@gmail.com>
 */
final class CreateClotheAction extends CreateAction
{
    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {

        //Check if clothe with this name already exists
        try {
            $name = $request->getParam('name');
            /** @var ClotheRepository $this->repository */
            $clothe = $this->repository->findByName($name);
	    $found = true;
        } catch (\InvalidArgumentException $e) {
	    $found = false;
        }

	if ($found) {

	   $this->flash->addMessage('error', 'Clothing with this name already exists.');

	} else {

            //validate rules for a new clothe
            $validation = $this->validator->validate($request, [
                'name' => v::notEmpty()->alpha()->length(2, 20),
                'size' => v::notEmpty()->alpha()->length(1, 4),
                'quantity' => v::noWhitespace()->notEmpty()->intVal(),
            ]);
    
            //check if validation passes
            if ($validation->failed()) {
                $this->flash->addMessage('error', 'Clothing data is not correct');
                return $response->withRedirect($this->router->pathFor('enter-clothe-data'));
            }
    
            //Try to insert data into clothe collection and in case
            //There's an error, a flash message in the view will inform the user what went wrong.
            try {
       	        $params = $request->getParams();
	        $params['arrival_date'] = date_create($params['arrival_date']);
                $this->repository->insert($params);
                $this->flash->addMessage('info', 'Clothing created correctly');

            } catch (\InvalidArgumentException $e) {
                $this->flash->addMessage('error', 'Clothing not found. Could not perform deletion.');
            } catch (EmptyDataSetException $e) {
                $this->flash->addMessage('error', $e->getMessage());
            }
		
        }

        return $response->withRedirect($this->router->pathFor('list-clothe'));
		
    }	
}