<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This action will list all medicines in the platform
 */

namespace App\Medicine\Actions;

use App\Medicine\Repository\MedicineRepository;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as View;

/**
 * Class ListMedicineAction
 * @package App\Medicine\Actions
 * @author Cyprian Laskowski <cyplas@gmail.com>
 */
final class ListMedicineAction
{
    /**
     * @var View
     */
    protected $view;
    /**
     * @var MedicineRepository
     */
    protected $medicineRepository;

    /**
     * IndexAction constructor.
     * @param View $view
     * @param MedicineRepository $medicineRepository
     */
    function __construct(
        View $view,
	MedicineRepository $medicineRepository
    )
    {
        $this->view = $view;
	$this->medicineRepository = $medicineRepository;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {

        $data = [
            'medicines' => $this->medicineRepository->getAll()
        ];
        return $this->view->render($response, 'partials/medicine/list.twig', $data);
    }
}