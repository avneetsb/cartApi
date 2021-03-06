<?php

/**
 * Class to handle all Route Management functionality
 */
namespace App\Library;

use App\Controller;
use App\Library\Request;

/**
 * Class to handle all Route Management functionality
 *
 * @package cartApi
 * @author Avneet Singh Bindra <avneetbindra180691@gmail.com>
 */
class RouteManager
{
    /**
     * Private variable, used to store Singleton Object of class
     * @var Object
     */
    private static $class;
    /**
     * Private variable, used to store incoming Request
     * @var Object
     */
    private $request;
    /**
     * Private variable to store routes from Configuration Manager
     * @param Array
     */
    private $routes;
    /**
     * Private variable to store controller name to forward request to
     * @param String
     */
    private $controller;
    /**
     * Private variable to store contoller function to forward request to
     * @param Sting
     */
    private $function;
    /**
     * Private variable to store if route requires user to be authenticated
     * @param Boolean
     */
    private $needsAuth;

    /**
     * Contructor to load Request, Route
     * @param Object $configurationManager ConfigurationManagement
     */
    private function __construct($configurationManager)
    {
        $this->routes  = $configurationManager->get('routes');
        $this->request = new Request();
        $this->loadRoute($this->request->getRoute());
    }

    /**
     * Function to get Route mapping from Object params
     * @param Srting $route Route Name
     */
    private function loadRoute($route)
    {
        list(
            $this->controller,
            $this->function,
            $this->needsAuth
        ) = $this->routes[array_key_exists($route, $this->routes) ? $route : 'ERROR'];
    }

    /**
     * Function to get instance of RouteManager
     * @param Object $configurationManager ConfigurationManagement
     */
    public static function getInstance($configurationManager)
    {

        if (self::$class == null) {
            self::$class = new RouteManager($configurationManager);
        }
        return self::$class;
    }

    /**
     * Function to actually forward request depending upon parsed route
     */
    public function route()
    {
        $route = $this->request->getRoute();
        $this->loadRoute($route);
        $this->forwardTo($route);
    }

    /**
     * Function to handle error i.e route mis-match
     * @param String $statusCode Error Code like 404/500
     */
    public function routeToError($statusCode)
    {
        $this->request->setStatusCode($statusCode);
        $this->forwardTo('ERROR');
    }

    /**
     * Function which checks if Route required authentication based on configuration params
     */
    public function needsAuth()
    {
        return $this->needsAuth;
    }

    /**
     * Function which maps route to controller
     * @param String $controller Controller Name
     * @param String $action Controller Action
     */
    private function routeToController($controller, $action)
    {
        try {
            $controller = "App\\Controller\\$controller";
            $callable   = new $controller();

            #setting up current request
            $callable->setRequest($this->request);
            $callable->$action($this->request->getParams());

        } catch (Exception $e) {
            $this->request->setStatusCode(500);
            $this->forwardTo('ERROR');
        }

        $this->windUp();
    }

    /**
     * Function which could be used to handle intermediate things
     * which can be done before response is sent
     */
    private function windUp()
    {
        # more stuff can be done like response listeners etc.
        exit();
    }

    /**
     * Function used to forward to appropriate function for router
     * @param String $route Controller Name
     */
    private function forwardTo($route)
    {
        $this->loadRoute($route);
        $this->routeToController($this->controller, $this->function);
    }
}
