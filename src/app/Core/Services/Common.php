<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 *
 * This class contains all common services that more than one module will probably require
 */


namespace App\Core\Services;

use App\Auth\Auth;
use App\Email\EmailService;
use App\Validation\Validator;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Slim\Csrf\Guard;
use Slim\Flash\Messages;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

/**
 * Class Common
 * @package Core\Services
 */
class Common implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {

        // this service be used to protect the application agains cross side request forgery attacks
        $container['csrf'] = function (Container $container): Guard {
            return new Guard();
        };
        // this service will be used to validate data from a submitted form
        $container['validator'] = function (Container $container): Validator {
            return new Validator();
        };

        // this service will be used to print out messages after an action is submitted.
        $container['flash'] = function (Container $container): Messages {
            return new Messages;
        };

        // application logger
        $container['logger'] = function (Container $container): Logger {
            $settings = $container->get('settings')['logger'];
            $logger = new Logger($settings['name']);
            $logger->pushProcessor(new UidProcessor());
            $logger->pushHandler(new StreamHandler($settings['path'], $settings['level']));
            return $logger;
        };
        // application authenticator service
        $container['auth'] = function (Container $container): Auth {

            return new Auth($container['OperatorRepository']);
        };

        // twig template service for slimphp framework
        $container['view'] = function (Container $container): Twig {
            $settings = $container['settings']['renderer'];
            $view = new Twig($settings['template_path'], $settings['debugger']);

            $view->addExtension(new TwigExtension(
                $container->router,
                $container->request->getUri()
            ));

            $view->getEnvironment()->addGlobal('flash', $container->flash);
            $view->getEnvironment()->addGlobal('auth', [
                'check' => $container->auth->check(),
                'user' => $container->auth->user()
            ]);
            $view->addExtension(new \Twig_Extension_Debug());

            return $view;
        };
        // email service
        $container['email'] = function (Container $container): EmailService {
            return new EmailService($container['settings']['mail']);
        };
    }
}