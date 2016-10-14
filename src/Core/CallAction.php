<?php

namespace Bit\Core;

class CallAction
{
    /**
     * initiates the steps of call action
     * @param  string $controllerAction [controllerAction]
     * @return NULL
     */
    public function initiateAction($controllerAction)
    {
        $newControllerAction  = explode('@', $controllerAction);

        if (sizeof($newControllerAction) !== 2) {

          throw new \Exception("Controller and its action is not correctly defined
          , please separate them with @, example:: Controller@action");

        }

        $this->checkControllerFile($newControllerAction);

    }

    /**
     * checks if the controller file exists
     * @param  array $newControllerAction [controller & action]
     * @return NULL
     */
    public function checkControllerFile($newControllerAction)
    {

      if (! file_exists(realpath(__DIR__."/../Controllers/{$newControllerAction[0]}.php"))) {

        throw new \Exception("Controller File does not exist");

      }

      $this->createControllerInstance($newControllerAction);

    }

    /**
     * creates ControllerInstance
     * @param  array $newControllerAction [controller & action]
     * @return NULL
     */
    public function createControllerInstance($newControllerAction)
    {
        if(! class_exists("Bit\\Controllers\\".$newControllerAction[0])) {

          throw new Exception("Controller class does not exist");

        }

        $newcontroller = "Bit\\Controllers\\{$newControllerAction[0]}";

        $controller = new $newcontroller;

        $this->callMethod($controller, $newControllerAction);
    }

    /**
     * calls method of the controller instance
     * @param  object $controller          Bit\Core\Controllers
     * @param  array $newControllerAction [controller & action]
     * @return NULL
     */
    public function callMethod($controller, $newControllerAction)
    {
        if (! method_exists($controller , $newControllerAction[1])) {

          throw new Exception("Method does not exist");

        }

        $method = $newControllerAction[1];

        $controller->$method();
    }

}
