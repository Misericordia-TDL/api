<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This action will mark as delete an operator
 */

namespace App\Food\Actions;

use App\Food\Repository\FoodRepository;
use Psr\Http\Message\ResponseInterface;
use Slim\Flash\Messages;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Interfaces\RouterInterface;

/**
 * Class DeleteFoodAction
 * @package App\Food\Actions
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class DeleteFoodAction
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
     * @var Messages
     */
    private $flash;

    /**
     * FoodController constructor.
     * @param RouterInterface $router
     * @param FoodRepository $foodRepository
     * @param Messages $flash
     * @internal param Validator $validator
     * @internal param View $view
     */
    function __construct(
        RouterInterface $router,
        FoodRepository $foodRepository,
        Messages $flash
    )
    {
        $this->router = $router;
        $this->flash = $flash;
        $this->foodRepository = $foodRepository;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {

        $id = $request->getParam('id');

        //delete a food and in case of an error, flash message with error message
        //will be sent to the view.
        try {

            if ($this->foodRepository->delete($id)) {
                $this->flash->addMessage('info', 'Food disabled correctly');
            } else {
                $this->flash->addMessage('error', 'Food not disabled correctly');
            }
        } catch (\InvalidArgumentException $e) {
            $this->flash->addMessage('error', 'Food not found. Could not perform deletion.');
        }

        return $response->withRedirect($this->router->pathFor('list-food'));
    }
}