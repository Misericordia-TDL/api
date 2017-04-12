<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This action will represent medicine data into a form to be edited
 */

namespace App\Medicine\Actions;

use App\Medicine\Model\Medicine;
use App\Medicine\Repository\MedicineRepository;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Interfaces\RouterInterface;
use Slim\Views\Twig as View;

/**
 * Class EditMedicineAction
 * @package App\Medicine\Actions
 * @author Cyprian Laskowski <cyplas@gmail.com>
 */
final class EditMedicineAction
{
    /**
     * @var View
     */
    protected $view;
    /**
     * @var MedicineLevelRepository
     */
    protected $medicineLevelRepository;
    /**
     * @var MedicineRepository
     */
    private $medicineRepository;

    /**
     * IndexAction constructor.
     * @param View $view
     * @param MedicineRepository $medicineRepository
     * @param RouterInterface $router
     */
    function __construct(
        View $view,
        MedicineRepository $medicineRepository,
        RouterInterface $router
    )
    {
        $this->medicineRepository = $medicineRepository;
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
        //fetch data from medicine
        //In case of medicine not found, redirect to list medicine action
        try {
            $id = $request->getAttribute('id');
            /** @var Medicine $medicine */
            $medicine = $this->medicineRepository->findById($id);
            $data = [
                'medicine' => $medicine,
            ];
            return $this->view->render($response, 'partials/medicine/edit-medicine-data.twig', $data);
        } catch (\InvalidArgumentException $e) {
            return $response->withRedirect($this->router->pathFor('list-medicine'));
        }
    }
}