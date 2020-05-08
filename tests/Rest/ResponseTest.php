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
        $response = new Response('test', 'test');
        $this->assertTrue($response->isSuccess());
        $response->error404('Test');
        $this->assertFalse($response->isSuccess());
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
}
