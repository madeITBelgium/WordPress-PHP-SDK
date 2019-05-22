<?php

use PHPUnit\Framework\TestCase;
use MadeITBelgium\WordPress\WordPress;
use GuzzleHttp\Client;

class WordPressTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testConstructor()
    {
        $client = new Client([
            'base_uri' => 'http://localhost',
            'timeout' => 5.0,
            'headers' => [
                'Accept' => 'application/json',
            ],
            'verify' => true,
        ]);
        $wordpress = new WordPress('http://localhost', $client);
        $this->assertEquals($client, $wordpress->getClient());

        $wordpress = new WordPress('http://localhost');
        $this->assertInstanceOf('\GuzzleHttp\Client', $wordpress->getClient());
    }

    public function testGettersAndSetters()
    {
        $wordpress = new WordPress('http://localhost');

        $wordpress->setAccessToken('AccessTokn');
        $this->assertEquals('AccessTokn', $wordpress->getAccessToken());

        $wordpress->outputAsObject(false);

        $this->assertInstanceOf(\MadeITBelgium\WordPress\Object\User::class, $wordpress->user());
    }

    public function testBuildHeader()
    {
        $wordpress = new WordPress('http://localhost', '', '');

        $this->assertEquals(['headers' => []], $wordpress->buildHeader('NOAUTH'));

        $wordpress->setAccessToken('TEST');
        $this->assertEquals(['headers' => ['Authorization' => 'Bearer TEST']], $wordpress->buildHeader('ABC'));
    }
}
