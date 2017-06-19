<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This class will update the data from an medicine
 */

namespace App\Medicine\Actions;

use App\Core\Actions\UpdateAction;
use App\Medicine\Model\Medicine;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Validator as v;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class UpdateMedicineAction
 * @package App\Medicine\Actions
 * @author Cyprian Laskowski <cyplas@gmail.com>
 */
final class UpdateMedicineAction extends UpdateAction
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
            /** @var  Medicine $originalMedicine */
            $originalMedicine = $this->repository->findById($id);


            $validation = $this->validator->validate($request, [
                'name' => v::notEmpty()->alpha()->length(2, 20),
                'quantity' => v::noWhitespace()->notEmpty()->intVal(),
            ]);

            //If validation fails, return to edit form with error messages embeded in the view
            if ($validation->failed()) {
                $this->flash->addMessage('error', 'Medicine data is not correct');
                return $response->withRedirect($this->router->pathFor('edit-medicine', ['id' => $id]));
            }

            $params = $request->getParams();
            $params['arrival_date'] = date_create($params['arrival_date']);
            $params['expiry_date'] = date_create($params['expiry_date']);
            $originalMedicine->update($params);

            $this->flash->addMessage('info', 'Medicine updated correctly');

            return $response->withRedirect($this->router->pathFor('list-medicine'));
        } catch (\InvalidArgumentException $e) {
            return $response->withRedirect($this->router->pathFor('list-medicine'));
        }
    }
}