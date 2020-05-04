<?php declare(strict_types=1);

namespace Rest;

class Response
{
    private $request_info;
    private $result;
    private $data;

    public function __construct(String $contoller_name, String $action_name)
    {
        $this->request_info = [
            'controller' => $contoller_name,
            'action' => $action_name
        ];
        $this->result = true;
        $this->data = [];
    }

    /**
     * Set error for response for 404 (Not found)
     * @param String $message
     */
    public function error404(String $message): void
    {
        $this->result = false;
        $this->data['error'] = $message;
        $this->data['code'] = 404;
    }

    /**
     * Return status of request
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->result;
    }
}