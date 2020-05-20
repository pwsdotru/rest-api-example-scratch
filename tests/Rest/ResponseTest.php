<?php declare(strict_types=1);
namespace Rest;

use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \\Rest\Response\\Rest\Response
 */
class ResponseTest extends TestCase
{
    /**
     * @covers ::isSuccess
     */
    public function testError404(): void
    {
        $errorText = 'Test';
        $response = new Response('test', 'test');
        $this->assertTrue($response->isSuccess());
        $response->error404($errorText);
        $this->assertFalse($response->isSuccess());

        $data = $this->getOut($response);

        $this->assertIsArray($data);
        $this->assertFalse($data['result']);

        $this->assertArrayHasKey('data', $data);

        $this->assertArrayHasKey('code', $data['data']);
        $this->assertEquals(404, $data['data']['code']);

        $this->assertArrayHasKey('error', $data['data']);
        $this->assertEquals($errorText, $data['data']['error']);
    }

    /**
     * @covers ::setSuccess
     */
    public function testSetSuccess(): void
    {
        $response = new Response('test', 'test');
        $this->assertTrue($response->isSuccess());
        $response->error404('Error');
        $this->assertFalse($response->isSuccess());
        $response->setSuccess();
        $this->assertTrue($response->isSuccess());
    }

    /**
     * @covers ::setFailed
     */
    public function testSetFailed(): void
    {
        $failText = 'Fail message';
        $response = new Response('test', 'test');
        $this->assertTrue($response->isSuccess());
        $response->setFailed($failText);
        $this->assertFalse($response->isSuccess());

        $data = $this->getOut($response);

        $this->assertIsArray($data);
        $this->assertFalse($data['result']);

        $this->assertArrayHasKey('data', $data);

        $this->assertArrayHasKey('error', $data['data']);
        $this->assertEquals($failText, $data['data']['error']);
    }

    /**
     * @covers ::__construct
     */
    public function testConstruct(): void
    {
        $response = new Response('test', 'index');

        $data = $this->getOut($response);

        $this->assertIsArray($data);
        $this->assertEquals('test', $data['controller']);
        $this->assertEquals('index', $data['action']);
    }

    /**
     * @covers ::display
     * @runInSeparateProcess
     */
    public function testDisplay200(): void
    {
        $response = new Response('error', 'test');

        $response->display();
        $this->assertContains('Content-Type: text/html;charset=UTF-8', xdebug_get_headers());
        $output = $this->getActualOutput();
        $this->assertStringContainsString('error', $output);
    }

    /**
     * @covers ::display
     * @runInSeparateProcess
     */
    public function testDisplay404(): void
    {
        $response = new Response('error', 'test');
        $response->error404('Not found page');

        $response->display();
        $this->assertContains('HTTP/1.0 404 Not Found', xdebug_get_headers());
        $output = $this->getActualOutput();
        $this->assertStringContainsString('Not found page', $output);
    }

    /**
     * Service function for call protected method
     * @param Response $response
     * @return array
     * @throws \ReflectionException
     */
    private function getOut(Response $response): array
    {
        $reflection = new \ReflectionClass($response);
        $method = $reflection->getMethod('buildOut');
        $method->setAccessible(true);
        $data = $method->invoke($response);
        return $data;
    }
}
