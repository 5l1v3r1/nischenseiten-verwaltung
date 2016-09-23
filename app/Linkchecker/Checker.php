<?php

namespace App\Linkchecker\Checker;

use GuzzleHttp\Client;

class Checker
{
    private $guzzle = null;
    public $source = null;
    public $target = null;
    public $found = 0;
    public $status = 0;

    public function __construct($source = '', $target = '')
    {
        $this->guzzle = new Client();
        $this->source = $source;
        $this->target = $target;
    }

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
