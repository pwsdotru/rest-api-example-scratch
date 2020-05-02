<?php declare(strict_types=1);
namespace Rest;

use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    /**
     * @dataProvider dataParseParams
     * @covers \Rest\Router::parseParams
     * @param $str - string for parse
     * @param $params - results
     */
    public function testParseParams(String $str, array $params)
    {
        $router = new Router();
        $this->assertEquals($params, $router->parseParams($str));
    }

    /**
     *  Data Provider Function for check parseParams function
     * @return array[]
     */
    public function dataParseParams()
    {
        return [
            ['', []],
            ['p/1', ['p' => 1]],
            ['p1/1/p2/2/p3', ['p1' => 1, 'p2' => 2, 'p3' => null]]
        ];
    }

    /**
     * @dataProvider  dataParse
     * @covers \Rest\Router::parse
     * @param $str - string for parse
     * @param $controler - controller name
     * @param $action - action name
     * @param $params - array with params
     */
    public function testParse(String $str, String $controler, String $action, array $params)
    {
        $router = new Router();
        $data = $router->parse($str);

        $this->assertArrayHasKey('controller', $data);
        $this->assertArrayHasKey('action', $data);
        $this->assertArrayHasKey('params', $data);

        $this->assertEquals($controler, $data['controller']);
        $this->assertEquals($action, $data['action']);
        $this->assertEquals($params, $data['params']);
    }

    /**
     * Data Provider Function for test parse function
     * @return array
     */
    public function dataParse()
    {
        return [
            [
                '',
                'index', 'index', []
            ],
            [
                '/run',
                'run', 'index', []
            ],
            [
                '/product/load/',
                'product', 'load', []
            ],
            [
                'run/it/id/2',
                'run', 'it', ['id' => 2]
            ]
        ];
    }
}
