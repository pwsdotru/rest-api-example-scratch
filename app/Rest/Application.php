<?php
namespace Rest;

class Application
{
    public function __construct()
    {
    }

    /**
     * Run application
     * @param string $uri
     */
    public function run(String $uri = "")
    {
        echo("Start " . $uri);
    }
}
