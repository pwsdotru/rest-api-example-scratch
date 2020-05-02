<?php
namespace Rest;

class Application
{
    private $router;
    public function __construct()
    {
        $this->router = new Router();
    }

    /**
     * Run application
     * @param string $uri
     */
    public function run(String $uri = "")
    {
        $params = $this->router->parse($uri);
        print_r($params);
    }
}
