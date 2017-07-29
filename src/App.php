<?php

namespace CodingCulture\Proxy;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use Namshi\Cuzzle\Formatter\CurlFormatter;
use Symfony\Component\HttpFoundation\Request;

class App
{
    private $request;

    private $client;

    public function __construct()
    {
        $this->request = Request::createFromGlobals();
        $this->client = new Client();
    }

    public function run()
    {
        $body = json_encode($this->request->request->all());

        $request = new GuzzleRequest(
            $this->request->getMethod(),
            $this->request->query->get('route'),
            $this->request->headers->all(),
            $body
        );

        if ($this->request->query->has('curl')) {
            echo (new CurlFormatter())->format($request, []);die;
            return;
        }

        $result = null;

        try {
            $result = $this->client->send($request)->getBody();
        } catch (ClientException $ce) {
            $result = json_encode([
                'error' => $ce->getMessage(),
                'stack' => $ce->getTraceAsString(),
            ]);
        }

        return $result;
    }
}