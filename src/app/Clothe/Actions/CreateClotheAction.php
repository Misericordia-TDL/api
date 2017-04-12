<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This action class will receive a data to create a new clothe. If validation fails
 * Request will be redirected to EnterClotheDataAction with the validation error messages
 * in its views.
 */

namespace App\Clothe\Actions;

use App\Core\Model\Exception\EmptyDataSetException;
use App\Clothe\Repository\ClotheRepository;
use App\Validation\Validator;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Validator as v;
use Slim\Flash\Messages;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Interfaces\RouterInterface;

/**
 * Class createClothe
 * @package App\Clothe\Actions
 * @author Cyprian Laskowski <cyplas@gmail.com>
 */
final class CreateClotheAction
{
    /**
     * @var ClotheRepository
     */
    protected $clotheRepository;
    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var Validator
     */
    private $validator;
    /**
     * @var Messages
     */
    private $flash;

    /**
     * ClotheController constructor.
     * @param RouterInterface $router
     * @param Validator $validator
     * @param ClotheRepository $clotheRepository
     * @param Messages $flash
     * @internal param View $view
     */
    function __construct(
        RouterInterface $router,
        Validator $validator,
        ClotheRepository $clotheRepository,
        Messages $flash
    )
    {
        $this->clotheRepository = $clotheRepository;
        $this->router = $router;
        $this->validator = $validator;
        $this->flash = $flash;
    }

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
            $clothe = $this->clotheRepository->findByName($name);
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
                $this->clotheRepository->insert($params);
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