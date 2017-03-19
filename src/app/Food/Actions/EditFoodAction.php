<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This action will represent food data into a form to be edited
 */

namespace App\Food\Actions;

use App\Food\Model\Food;
use App\Food\Repository\FoodRepository;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Interfaces\RouterInterface;
use Slim\Views\Twig as View;

/**
 * Class EditFoodAction
 * @package App\Food\Actions
 * @author Javier Mellado <sol@javiermellado.com>
 */
final class EditFoodAction
{
    /**
     * @var View
     */
    protected $view;
    /**
     * @var FoodLevelRepository
     */
    protected $foodLevelRepository;
    /**
     * @var FoodRepository
     */
    private $foodRepository;

    /**
     * IndexAction constructor.
     * @param View $view
     * @param FoodRepository $foodRepository
     * @param RouterInterface $router
     */
    function __construct(
        View $view,
        FoodRepository $foodRepository,
        RouterInterface $router
    )
    {
        $this->foodRepository = $foodRepository;
        $this->view = $view;
        $this->router = $router;

    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {
        //fetch data from food
        //In case of food not found, redirect to list food action
        try {
            $id = $request->getAttribute('id');
            /** @var Food $food */
            $food = $this->foodRepository->findById($id);
            $data = [
                'food' => $food,
            ];
            return $this->view->render($response, 'partials/food/edit-food-data.twig', $data);
        } catch (\InvalidArgumentException $e) {
            return $response->withRedirect($this->router->pathFor('list-food'));
        }
    }
}