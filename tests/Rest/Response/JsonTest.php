<?php declare(strict_types=1);
namespace Rest\Response;

use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \\Rest\Response\\Rest\Response\Json
 */
class JsonTest extends TestCase
{
    /**
     * @covers ::display
     * @runInSeparateProcess
     */
    public function testDisplay(): void
    {
        $response = new \Rest\Response\Json('test', 'json');
        $response->display();
        $this->assertContains('Content-Type: application/json;charset=UTF-8', xdebug_get_headers());

        $output = $this->getActualOutput();

        $this->assertStringContainsString('"action":"json"', $output);
        $this->assertStringContainsString('"controller":"test"', $output);
    }

    /**
     * @covers: ::headers
     */
    public function testHeaders(): void
    {
        $response = new \Rest\Response\Json('test', 'json');
        $this->assertContains('Content-Type: application/json;charset=UTF-8', $response->headers());
    }

    /**
     * @covers ::out
     */
    public function testOut(): void
    {
        $response = new \Rest\Response\Json('test', 'json');
        $output = $response->out();

        $this->assertStringContainsString('"action":"json"', $output);
        $this->assertStringContainsString('"controller":"test"', $output);
    }
}
