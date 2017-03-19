<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This action class will receive a data to create a new food. If validation fails
 * Request will be redirected to EnterFoodDataAction with the validation error messages
 * in its views.
 */

namespace App\Food\Actions;

use App\Core\Model\Exception\EmptyDataSetException;
use App\Food\Repository\FoodRepository;
use App\Validation\Validator;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Validator as v;
use Slim\Flash\Messages;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Interfaces\RouterInterface;

/**
 * Class createFood
 * @package App\Food\Actions
 * @author Cyprian Laskowski <cyplas@gmail.com>
 */
final class CreateFoodAction
{
    /**
     * @var FoodRepository
     */
    protected $foodRepository;
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
     * FoodController constructor.
     * @param RouterInterface $router
     * @param Validator $validator
     * @param FoodRepository $foodRepository
     * @param Messages $flash
     * @internal param View $view
     */
    function __construct(
        RouterInterface $router,
        Validator $validator,
        FoodRepository $foodRepository,
        Messages $flash
    )
    {
        $this->foodRepository = $foodRepository;
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
            $this->foodRepository->insert($request->getParams());
            $this->flash->addMessage('info', 'Food created correctly');

        } catch (\InvalidArgumentException $e) {
            $this->flash->addMessage('error', 'Food not found. Could not perform deletion.');
        } catch (EmptyDataSetException $e) {
            $this->flash->addMessage('error', $e->getMessage());
        }


        return $response->withRedirect($this->router->pathFor('list-food'));
    }
}