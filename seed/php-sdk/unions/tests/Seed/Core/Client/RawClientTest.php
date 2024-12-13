<?php

namespace Seed\Tests\Core\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Seed\Core\Client\BaseApiRequest;
use Seed\Core\Client\HttpMethod;
use Seed\Core\Client\RawClient;
use Seed\Core\Json\JsonApiRequest;
use Seed\Union\Types\Circle;
use Seed\Union\UnionClient;
use Shape;

class RawClientTest extends TestCase
{
    private string $baseUrl = 'https://api.example.com';
    private MockHandler $mockHandler;
    private RawClient $rawClient;
    private UnionClient $unionClient;

    protected function setUp(): void
    {
        $this->mockHandler = new MockHandler();
        $handlerStack = HandlerStack::create($this->mockHandler);
        $client = new Client(['handler' => $handlerStack]);
        $this->rawClient = new RawClient(['client' => $client]);
        $this->unionClient = new UnionClient($this->rawClient);
    }

    public function testHeaders(): void
    {
        $this->mockHandler->append(new Response(200));

        $request = new JsonApiRequest(
            $this->baseUrl,
            '/test',
            HttpMethod::GET,
            ['X-Custom-Header' => 'TestValue']
        );

        $this->sendRequest($request);

        $lastRequest = $this->mockHandler->getLastRequest();
        assert($lastRequest instanceof RequestInterface);
        $this->assertEquals('application/json', $lastRequest->getHeaderLine('Content-Type'));
        $this->assertEquals('TestValue', $lastRequest->getHeaderLine('X-Custom-Header'));
    }

    public function testQueryParameters(): void
    {
        $this->mockHandler->append(new Response(200));

        $request = new JsonApiRequest(
            $this->baseUrl,
            '/test',
            HttpMethod::GET,
            [],
            ['param1' => 'value1', 'param2' => ['a', 'b'], 'param3' => 'true']
        );

        $this->sendRequest($request);

        $lastRequest = $this->mockHandler->getLastRequest();
        assert($lastRequest instanceof RequestInterface);
        $this->assertEquals(
            'https://api.example.com/test?param1=value1&param2=a&param2=b&param3=true',
            (string)$lastRequest->getUri()
        );
    }

    public function testJsonBody(): void
    {
        $this->mockHandler->append(new Response(200));

        $body = ['key' => 'value'];
        $request = new JsonApiRequest(
            $this->baseUrl,
            '/test',
            HttpMethod::POST,
            [],
            [],
            $body
        );

        $this->sendRequest($request);

        $lastRequest = $this->mockHandler->getLastRequest();
        assert($lastRequest instanceof RequestInterface);
        $this->assertEquals('application/json', $lastRequest->getHeaderLine('Content-Type'));
        $this->assertEquals(json_encode($body), (string)$lastRequest->getBody());
    }

    private function sendRequest(BaseApiRequest $request): void
    {
        try {
            $this->rawClient->sendRequest($request);
        } catch (\Throwable $e) {
            $this->fail('An exception was thrown: ' . $e->getMessage());
        }
    }

    private function useShapeResponse(): void
    {
        try {
            $shape = $this->unionClient->get("circle");
            switch ($shape->type) {
                case "circle":
                    echo "Success!\n";
                    break;
                case "square":
                case "_unknown":
                default:
                    throw new \Exception("Expected to get circle");
                    break;
            }
        } catch (\Throwable $e) {
            $this->fail('An exception was thrown: ' . $e->getMessage());
        }
    }

    private function useShapeRequest(): void
    {
        try {
            $shape = Shape::circle(new Circle(['radius' => 1.0]));
            $success = $this->unionClient->update($shape);
            if ($success) {
                echo "Success!\n";
            } else {
                throw new \Exception("Expected to update shape!");
            }
        } catch (\Throwable $e) {
            $this->fail('An exception was thrown: ' . $e->getMessage());
        }
    }
}
