<?php declare(strict_types=1);
namespace Rest;

class Controller
{
    protected $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }
}
