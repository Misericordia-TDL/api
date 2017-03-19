<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This action will list all foods in the platform
 */

namespace App\Food\Actions;

use App\Food\Repository\FoodRepository;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as View;

/**
 * Class ListFoodAction
 * @package App\Food\Actions
 * @author Cyprian Laskowski <cyplas@gmail.com>
 */
final class ListFoodAction
{
    /**
     * @var View
     */
    protected $view;
    /**
     * @var FoodRepository
     */
    protected $foodRepository;

    /**
     * IndexAction constructor.
     * @param View $view
     * @param FoodRepository $foodRepository
     */
    function __construct(
        View $view,
	FoodRepository $foodRepository
    )
    {
        $this->view = $view;
	$this->foodRepository = $foodRepository;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {

        $data = [
            'foods' => $this->foodRepository->getAll()
        ];
        return $this->view->render($response, 'partials/food/list.twig', $data);
    }
}