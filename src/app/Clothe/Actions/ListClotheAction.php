<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This action will list all clothes in the platform
 */

namespace App\Clothe\Actions;

use App\Clothe\Repository\ClotheRepository;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as View;

/**
 * Class ListClotheAction
 * @package App\Clothe\Actions
 * @author Cyprian Laskowski <cyplas@gmail.com>
 */
final class ListClotheAction
{
    /**
     * @var View
     */
    protected $view;
    /**
     * @var ClotheRepository
     */
    protected $clotheRepository;

    /**
     * IndexAction constructor.
     * @param View $view
     * @param ClotheRepository $clotheRepository
     */
    function __construct(
        View $view,
	ClotheRepository $clotheRepository
    )
    {
        $this->view = $view;
	$this->clotheRepository = $clotheRepository;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {

        $data = [
            'clothes' => $this->clotheRepository->getAll()
        ];
        return $this->view->render($response, 'partials/clothe/list.twig', $data);
    }
}