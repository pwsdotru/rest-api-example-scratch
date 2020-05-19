<?php declare(strict_types=1);

namespace Rest;

use http\Header;

class Response
{
    private $request_info;
    private $result;
    private $data;
    private $error_code;

    public function __construct(String $contoller_name, String $action_name)
    {
        $this->request_info = [
            'controller' => $contoller_name,
            'action' => $action_name
        ];
        $this->result = true;
        $this->data = [];
        $this->error_code = null;
    }

    public function display(): void
    {
        if (false === $this->isSuccess() && $this->error_code !== null) {
            header("HTTP/1.0 " . $this->error_code, true, $this->error_code);
        }
        header("Content-Type: text/html;charset=UTF-8", true);
        print_r($this->buildOut());
    }
    /**
     * Set error for response for 404 (Not found)
     * @param String $message
     */
    public function error404(String $message): void
    {
        $this->result = false;
        $this->error_code = 404;
        $this->setVar('error', $message);
        $this->setVar('code', 404);
    }

    public function setSuccess(): void
    {
        $this->result = true;
    }

    public function setFailed(String $error = ""): void
    {
        $this->result = false;
        $this->setVar('error', $error);
    }

    public function setVar(String $key, $value = null): void
    {
        if (!is_array($this->data)) {
            $this->data = [];
        }
        $this->data[$key] = $value;
    }
    /**
     * Return status of request
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->result;
    }

    protected function buildOut(): array
    {
        $out = [];

        $out['result'] = $this->result;
        $out = array_merge($out, $this->request_info);
        $out['data'] = $this->data;

        return $out;
    }
}
