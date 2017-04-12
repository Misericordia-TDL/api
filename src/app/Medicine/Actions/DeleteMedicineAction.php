<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This action will mark as delete an operator
 */

namespace App\Medicine\Actions;

use App\Medicine\Repository\MedicineRepository;
use Psr\Http\Message\ResponseInterface;
use Slim\Flash\Messages;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Interfaces\RouterInterface;

/**
 * Class DeleteMedicineAction
 * @package App\Medicine\Actions
 * @author Cyprian Laskowski <cyplas@gmail.com>
 */
final class DeleteMedicineAction
{
    /**
     * @var MedicineRepository
     */
    protected $medicineRepository;
    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var Messages
     */
    private $flash;

    /**
     * MedicineController constructor.
     * @param RouterInterface $router
     * @param MedicineRepository $medicineRepository
     * @param Messages $flash
     * @internal param Validator $validator
     * @internal param View $view
     */
    function __construct(
        RouterInterface $router,
        MedicineRepository $medicineRepository,
        Messages $flash
    )
    {
        $this->router = $router;
        $this->flash = $flash;
        $this->medicineRepository = $medicineRepository;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {

        $id = $request->getParam('id');

        //delete a medicine and in case of an error, flash message with error message
        //will be sent to the view.
        try {

            if ($this->medicineRepository->delete($id)) {
                $this->flash->addMessage('info', 'Medicine disabled correctly');
            } else {
                $this->flash->addMessage('error', 'Medicine not disabled correctly');
            }
        } catch (\InvalidArgumentException $e) {
            $this->flash->addMessage('error', 'Medicine not found. Could not perform deletion.');
        }

        return $response->withRedirect($this->router->pathFor('list-medicine'));
    }
}