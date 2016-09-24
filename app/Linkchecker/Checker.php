<?php

namespace App\Linkchecker\Checker;

use GuzzleHttp\Client;

/**
 * Simple backlinks checker
 */
class Checker
{

    /**
     * @var GuzzleHttp\Client $guzzle
     */
    private $guzzle = null;

    /**
     * @var string $source
     */
    public $source = null;

    /**
     * @var string $target
     */
    public $target = null;

    /**
     * @var int $guzzle
     */
    public $found = 0;

    /**
     * @var int $guzzle
     */
    public $status = 0;

    /**
     * Construct important data for object
     *
     * @param string $source the actual backlink
     * @param string $target the target which the backlink points at
     */
    public function __construct($source = '', $target = '')
    {
        $this->guzzle = new Client();
        $this->source = $source;
        $this->target = $target;
    }

    /**
     * Check backlink status
     *
     * @return void Saves status in publicly accessible variables
     *
     * @throws \Exception when timedout or blocked by server
     */
    public function check()
    {
        try {
            $res = $this->guzzle->request('GET', trim($this->source), [
                'headers' => [
                    'User-Agent' => 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
                ],
                'timeout' => 3.0,
            ]);
            $this->status = $res->getStatusCode();
            $body = $res->getBody();

            if (strpos($body, trim($this->target)) !== false) {
                $this->found = 1;
            }
        } catch (\Exception $ex) {
            $this->status = $ex->getCode();
        }
    }
}
