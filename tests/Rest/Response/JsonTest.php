<?php declare(strict_types=1);
namespace Rest\Response;

use PHPUnit\Framework\TestCase;

/**
 * @covers @coversDefaultClass \\Rest\Response\\Rest\Response\Json
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
        $this->assertContains('Content-Type: application/json', xdebug_get_headers());

        $output = $this->getActualOutput();
        $this->isJson($output);

        $this->assertStringContainsString('"action":"json"', $output);
        $this->assertStringContainsString('"controller":"test"', $output);
    }
}
