<?php declare(strict_types=1);

namespace Rest\Controller;

class Index extends \Rest\Controller
{
    public function indexAction(array $params): void
    {
        echo('Index:index');
    }
}