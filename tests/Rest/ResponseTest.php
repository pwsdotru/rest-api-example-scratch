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
}
