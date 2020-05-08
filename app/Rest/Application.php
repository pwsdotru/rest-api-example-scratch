<?php declare(strict_types=1);
namespace Rest;

class Application
{
    private $router;
    private $controller;
    private $response;

    public function __construct()
    {
        $this->router = new Router();
    }

    /**
     * Run application
     * @param string $uri
     */
    public function run(String $uri = ""): Response
    {
        $params = $this->router->parse($uri);

        $this->response = new Response\Json($params['controller'], $params['action']);

        $controller_class = '\\Rest\\Controller\\' . ucfirst($params['controller']);
        $action_name = $params['action'] . 'Action';

        if (class_exists($controller_class)) {
            $this->controller = new $controller_class($this->response);
            if (method_exists($this->controller, $action_name)) {
                $this->controller->$action_name($params);
            } else {
                $this->response->error404('Action not found');
            }
        } else {
            $this->response->error404('Controller not found');
        }
        return $this->response;
    }
}
