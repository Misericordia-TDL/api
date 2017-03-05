<?php
/**
 * Copyright (c) 2017. This file belongs to Misericordia di "Torre del lago Puccini"
 */


namespace Core\Services;

use App\Auth\Auth;
use App\Validation\Validator;
use MongoDB\Client;
use Monolog\Logger;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Slim\Csrf\Guard;
use Slim\Flash\Messages;
use \Slim\Views\Twig;
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

        $container['csrf'] = function (Container $container): Guard {
            return new Guard();
        };
        $container['validator'] = function (Container $container): Validator {
            return new Validator();
        };
        $container['flash'] = function (Container $container): Messages {
            return new Messages;
        };

        /**
         * @param Container $container
         * @return \MongoDB\Client
         */
        $container['db'] = function (Container $container): Client {

            $host = $container['settings']['db']['host'];
            $port = $container['settings']['db']['port'];
            $connectionUri = 'mongodb://' . $host . ':' . $port;
            $dbConnection = new Client($connectionUri);

            return $dbConnection;
        };

        /**
         * @param Container $container
         * @return Logger
         */
        $container['logger'] = function (Container $container): Logger {
            $settings = $container->get('settings')['logger'];
            $logger = new Logger($settings['name']);
            $logger->pushProcessor(new UidProcessor());
            $logger->pushHandler(new StreamHandler($settings['path'], $settings['level']));
            return $logger;
        };

        $container['auth'] = function (Container $container): Auth {

            return new Auth($container['OperatorRepository']);
        };

        /**
         * @param Container $container
         * @return \Slim\Views\Twig
         */
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
                'user'  => $container->auth->user()
            ]);
            $view->addExtension(new \Twig_Extension_Debug());

            return $view;
        };
    }
}