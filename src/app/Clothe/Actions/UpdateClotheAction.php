<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This class will update the data from an clothe
 */

namespace App\Clothe\Actions;

use App\Clothe\Model\Clothe;
use App\Core\Actions\UpdateAction;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Validator as v;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class UpdateClotheAction
 * @package App\Clothe\Actions
 * @author Cyprian Laskowski <cyplas@gmail.com>
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class UpdateClotheAction extends UpdateAction
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
            /** @var  Clothe $originalClothe */
            $originalClothe = $this->repository->findById($id);


            $validation = $this->validator->validate($request, [
                'name' => v::notEmpty()->alpha()->length(2, 20),
                'size' => v::notEmpty()->alpha()->length(1, 4),
		'quantity' => v::noWhitespace()->notEmpty()->intVal(),
            ]);

            //If validation fails, return to edit form with error messages embeded in the view
            if ($validation->failed()) {
                $this->flash->addMessage('error', 'Clothing data is not correct');
                return $response->withRedirect($this->router->pathFor('edit-clothe', ['id' => $id]));
            }

	    $params = $request->getParams();
	    $params['arrival_date'] = date_create($params['arrival_date']);
            $originalClothe->update($params);

            $this->flash->addMessage('info', 'Clothing updated correctly');

            return $response->withRedirect($this->router->pathFor('list-clothe'));
        } catch (\InvalidArgumentException $e) {
            return $response->withRedirect($this->router->pathFor('list-clothe'));
        }
    }
}