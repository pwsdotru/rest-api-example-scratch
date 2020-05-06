<?php declare(strict_types=1);
namespace Rest\Response;

class Json extends \Rest\Response
{
    public function display(): void
    {
        header("Content-Type: application/json");
        echo(json_encode($this->buildOut()));
    }
}
