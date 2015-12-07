<?php namespace Tests;

use Laravelista\Syndra\Syndra;
use PHPUnit_Framework_TestCase;

class SyndraTest extends PHPUnit_Framework_TestCase
{

    protected $syndra;

    public function setUp()
    {
        $this->syndra = new Syndra();
    }

    /** @test */
    public function it_gets_headers()
    {
        $this->assertEquals([], $this->syndra->getHeaders());
    }

    /** @test */
    public function it_sets_headers()
    {
        $header = ['Access-Control-Allow-Origin' => '*'];

        $this->syndra->setHeaders($header);

        $this->assertEquals($header, $this->syndra->getHeaders());
    }

    /** @test */
    public function it_gets_status_code()
    {
        $this->assertEquals(200, $this->syndra->getStatusCode());
    }

    /** @test */
    public function it_sets_status_code()
    {
        $statusCode = 422;

        $this->syndra->setStatusCode($statusCode);

        $this->assertEquals($statusCode, $this->syndra->getStatusCode());
    }

    /** @test */
    public function it_responds_with_json()
    {
        $response = $this->syndra->respond(['test' => 'test']);

        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertEquals([], $this->syndra->getHeaders());

        $this->assertEquals('{"test":"test"}', json_encode($response->getData()));
    }

    /** @test */
    public function it_responds_with_json_message()
    {
        $response = $this->syndra->respondWithMessage('something');

        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertEquals([], $this->syndra->getHeaders());

        $this->assertEquals('{"message":"something","status_code":200}', json_encode($response->getData()));
    }

    /** @test */
    public function it_responds_with_json_error()
    {
        $response = $this->syndra->setStatusCode(404)->respondWithError('something');

        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);

        $this->assertEquals(404, $response->getStatusCode());

        $this->assertEquals([], $this->syndra->getHeaders());

        $this->assertEquals('{"error":{"message":"something","status_code":404}}', json_encode($response->getData()));
    }

    /** @test */
    public function it_responds_with_ok()
    {
        $response = $this->syndra->respondOk('something');

        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertEquals([], $this->syndra->getHeaders());

        $this->assertEquals('{"message":"something","status_code":200}', json_encode($response->getData()));
    }

    /** @test */
    public function it_responds_with_created()
    {
        $response = $this->syndra->respondCreated('something');

        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);

        $this->assertEquals(201, $response->getStatusCode());

        $this->assertEquals([], $this->syndra->getHeaders());

        $this->assertEquals('{"message":"something","status_code":201}', json_encode($response->getData()));
    }

    /** @test */
    public function it_responds_with_updated()
    {
        $response = $this->syndra->respondUpdated('something');

        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);

        $this->assertEquals(202, $response->getStatusCode());

        $this->assertEquals([], $this->syndra->getHeaders());

        $this->assertEquals('{"message":"something","status_code":202}', json_encode($response->getData()));
    }

    /** @test */
    public function it_responds_with_not_found()
    {
        $response = $this->syndra->respondNotFound('something');

        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);

        $this->assertEquals(404, $response->getStatusCode());

        $this->assertEquals([], $this->syndra->getHeaders());

        $this->assertEquals('{"error":{"message":"something","status_code":404}}', json_encode($response->getData()));
    }

    /** @test */
    public function it_responds_with_internal_error()
    {
        $response = $this->syndra->respondInternalError('something');

        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);

        $this->assertEquals(500, $response->getStatusCode());

        $this->assertEquals([], $this->syndra->getHeaders());

        $this->assertEquals('{"error":{"message":"something","status_code":500}}', json_encode($response->getData()));
    }

    /** @test */
    public function it_responds_with_not_implemented()
    {
        $response = $this->syndra->respondNotImplemented('something');

        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);

        $this->assertEquals(501, $response->getStatusCode());

        $this->assertEquals([], $this->syndra->getHeaders());

        $this->assertEquals('{"error":{"message":"something","status_code":501}}', json_encode($response->getData()));
    }

    /** @test */
    public function it_responds_with_validation_error()
    {
        $response = $this->syndra->respondValidationError('something');

        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);

        $this->assertEquals(422, $response->getStatusCode());

        $this->assertEquals([], $this->syndra->getHeaders());

        $this->assertEquals('{"error":{"message":"something","status_code":422}}', json_encode($response->getData()));
    }

    /** @test */
    public function it_responds_with_forbidden()
    {
        $response = $this->syndra->respondForbidden('something');

        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);

        $this->assertEquals(403, $response->getStatusCode());

        $this->assertEquals([], $this->syndra->getHeaders());

        $this->assertEquals('{"error":{"message":"something","status_code":403}}', json_encode($response->getData()));
    }

    /** @test */
    public function it_responds_with_unauthorized()
    {
        $response = $this->syndra->respondUnauthorized('something');

        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);

        $this->assertEquals(401, $response->getStatusCode());

        $this->assertEquals([], $this->syndra->getHeaders());

        //var_dump(json_encode($response->getData()));

        $this->assertEquals('{"error":{"message":"something","status_code":401}}', json_encode($response->getData()));
    }
}
