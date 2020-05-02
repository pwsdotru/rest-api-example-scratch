<?php declare(strict_types=1);
namespace Rest;

class Router
{
    private $urls;
    public function __construct()
    {
        $this->urls = [
            'controller' => 'index',
            'action' => 'index',
            'params' => [],
        ];
    }

    /**
     * Parse URI string and return data for urls
     * @param String $uri
     */
    public function parse(String $uri)
    {
        //Trim whitespaces and leadings slashes
        $uri = trim(trim($uri), '/');
        if ($uri === '') {
            return $this->urls;
        }
        $parts = explode('/', $uri, 3);
        if (!empty($parts[0])) {
            $this->urls['controller'] = strtolower($parts[0]);
            if (!empty($parts[1])) {
                $this->urls['action'] = strtolower($parts[1]);
                if (!empty($parts[2])) {
                    $this->urls['params'] = $this->parseParams(trim($parts[2]));
                }
            }
        }
        return $this->urls;
    }

    public function parseParams(String $str)
    {
        $params = [];
        $str = trim(trim($str), '/');
        if ($str === '') {
            return $params;
        }
        $parts = explode('/', $str);
        $len = count($parts);
        for ($i = 0; $i < $len; $i += 2) {
            $key = $parts[$i];
            if (isset($parts[$i + 1])) {
                $value = $parts[$i + 1];
            } else {
                $value = null;
            }
            $params[$key] = $value;
        }
        return $params;
    }
}
