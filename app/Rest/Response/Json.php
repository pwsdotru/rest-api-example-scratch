<?php declare(strict_types=1);
namespace Rest\Response;

class Json extends \Rest\Response
{
    /**
     * @return string
     */
    public function out(): string
    {
        return json_encode($this->buildOut());
    }

    /**
     * Prepare HTTP headers for output
     *
     * @return array
     */
    public function headers(): array
    {
        $headers = parent::headers();
        $headers['Content'] = 'Content-Type: application/json;charset=UTF-8';

        return $headers;
    }
}
