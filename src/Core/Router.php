<?php

namespace Bit\Core;

class Router
{

    protected $callaction;

    public $routes = [
      'GET' => [],
      'POST' => [],
      'DELETE' => [],
      'PATCH' => []
    ];

    public function __construct(CallAction $callaction)
    {
        $this->callaction = $callaction;
    }

    /**
     * Request Types
     * @param  string $uri              [request URL]
     * @param  string $controllerAction [action to be taken]
     * @return NULL
     */
    public function get($uri,$controllerAction)
    {
        $this->routes['GET'][$uri] = $controllerAction;
    }

    public function post($uri,$controllerAction)
    {
        $this->routes['POST'][$uri] = $controllerAction;
    }

    public function delete($uri,$controllerAction)
    {
        $this->routes['DELETE'][$uri] = $controllerAction;
    }

    public function patch($uri,$controllerAction)
    {
        $this->routes['PATCH'][$uri] = $controllerAction;
    }

    /**
     * creates static instance of Router class
     * @param  string $routesFile routes filepath
     * @return Core\Bit\Router::static
     */
    public static function loadRoutes($routesFile)
    {
        $router = new static(new CallAction);

        require $routesFile;

        return $router;
    }

    /**
     * Dispatch user request to controllerAction
     * @param  string $url [request URL]
     * @param  string $method [request Method]
     * @return NULL
     */
    public function dispatch($uri, $method)
    {

        if (! array_key_exists($uri,$this->routes[$method])) {

          throw new \Exception("URL is not defined in the routes");

        }

        $this->callaction->initiateAction($this->routes[$method][$uri]);
    }




}
