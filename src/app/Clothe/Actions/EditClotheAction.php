<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This action will represent clothe data into a form to be edited
 */

namespace App\Clothe\Actions;

use App\Clothe\Model\Clothe;
use App\Clothe\Repository\ClotheRepository;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Interfaces\RouterInterface;
use Slim\Views\Twig as View;

/**
 * Class EditClotheAction
 * @package App\Clothe\Actions
 * @author Cyprian Laskowski <cyplas@gmail.com>
 */
final class EditClotheAction
{
    /**
     * @var View
     */
    protected $view;
    /**
     * @var ClotheLevelRepository
     */
    protected $clotheLevelRepository;
    /**
     * @var ClotheRepository
     */
    private $clotheRepository;

    /**
     * IndexAction constructor.
     * @param View $view
     * @param ClotheRepository $clotheRepository
     * @param RouterInterface $router
     */
    function __construct(
        View $view,
        ClotheRepository $clotheRepository,
        RouterInterface $router
    )
    {
        $this->clotheRepository = $clotheRepository;
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
        //fetch data from clothe
        //In case of clothe not found, redirect to list clothe action
        try {
            $id = $request->getAttribute('id');
            /** @var Clothe $clothe */
            $clothe = $this->clotheRepository->findById($id);
            $data = [
                'clothe' => $clothe,
            ];
            return $this->view->render($response, 'partials/clothe/edit-clothe-data.twig', $data);
        } catch (\InvalidArgumentException $e) {
            return $response->withRedirect($this->router->pathFor('list-clothe'));
        }
    }
}