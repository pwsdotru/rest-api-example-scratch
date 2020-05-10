<?php declare(strict_types=1);
namespace Rest;

use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    /**
     * @covers \Rest\Response::isSuccess
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
     * @covers \Rest\Response::setSuccess
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
     * @covers \Rest\Response::setFailed
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
     * @covers \Rest\Response::__construct
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
