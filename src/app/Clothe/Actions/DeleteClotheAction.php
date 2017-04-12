<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This action will mark as delete an operator
 */

namespace App\Clothe\Actions;

use App\Clothe\Repository\ClotheRepository;
use Psr\Http\Message\ResponseInterface;
use Slim\Flash\Messages;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Interfaces\RouterInterface;

/**
 * Class DeleteClotheAction
 * @package App\Clothe\Actions
 * @author Cyprian Laskowski <cyplas@gmail.com>
 */
final class DeleteClotheAction
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
     * @var Messages
     */
    private $flash;

    /**
     * ClotheController constructor.
     * @param RouterInterface $router
     * @param ClotheRepository $clotheRepository
     * @param Messages $flash
     * @internal param Validator $validator
     * @internal param View $view
     */
    function __construct(
        RouterInterface $router,
        ClotheRepository $clotheRepository,
        Messages $flash
    )
    {
        $this->router = $router;
        $this->flash = $flash;
        $this->clotheRepository = $clotheRepository;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {

        $id = $request->getParam('id');

        //delete a clothe and in case of an error, flash message with error message
        //will be sent to the view.
        try {

            if ($this->clotheRepository->delete($id)) {
                $this->flash->addMessage('info', 'Clothe disabled correctly');
            } else {
                $this->flash->addMessage('error', 'Clothe not disabled correctly');
            }
        } catch (\InvalidArgumentException $e) {
            $this->flash->addMessage('error', 'Clothe not found. Could not perform deletion.');
        }

        return $response->withRedirect($this->router->pathFor('list-clothe'));
    }
}