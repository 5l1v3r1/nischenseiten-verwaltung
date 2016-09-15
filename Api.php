<?php

namespace App\Metricstools\Api;

use GuzzleHttp\Client;

class Api
{

    private $key         = '';
    private $guzzle      = null;
    public $input        = '';
    public $status;
    public $data         = [];
    public $credits_left = null;
    public $error        = '';

    public function __construct($key, $input = '')
    {

        $this->guzzle = new Client();
        $this->key    = $key;
        $this->input  = $input;
    }

    public function get_keyword_data()
    {


        try
        {
            $this->checkInput();

            $res          = $this->guzzle->request('GET', 'https://metrics.tools/metricstools/api/keyword', [
                'query' => [
                    'apikey'  => trim($this->key),
                    'keyword' => trim($this->input),
                    'query'   => 'details',
                ]
            ]);
            $this->status = $res->getStatusCode();
            $this->data   = json_decode($res->getBody(), true);
            $this->error  = $this->data['error_msg'];

            if (isset($this->data['credits_remain']))
            {
                $this->credits_left = $this->data['credits_remain'];
            }
        }
        catch (\Exception $ex)
        {
            $this->status       = $ex->getCode();
            $this->error        = $ex->getMessage();
            $this->credits_left = 0;
        }
    }

    public function get_credit_count()
    {
        try
        {

            $res          = $this->guzzle->request('GET', 'https://metrics.tools/metricstools/api/domain', [
                'query' => [
                    'apikey'  => trim($this->key),
                    'domain'  => 'google.de',
                    'query'   => 'position',
                    'keyword' => 'google',
                ]
            ]);
            $this->status = $res->getStatusCode();
            $this->data   = json_decode($res->getBody(), true);
            $this->error  = $this->data['error_msg'];

            if (isset($this->data['credits_remain']))
            {
                $this->credits_left = $this->data['credits_remain'];
            }
        }
        catch (\Exception $ex)
        {
            $this->status       = $ex->getCode();
            $this->error        = $ex->getMessage();
            $this->credits_left = 0;
        }
    }

    public function get_rankings()
    {
        try
        {
            $this->checkInput();

            $res          = $this->guzzle->request('GET', 'https://metrics.tools/metricstools/api/domain', [
                'query' => [
                    'apikey'          => trim($this->key),
                    'domain'          => trim($this->input),
                    'query'           => 'rankings',
                    'order_column'    => 'traffic',
                    'order_direction' => 'desc',
                    'limit'           => 500,
                ]
            ]);
            $this->status = $res->getStatusCode();
            $this->data   = json_decode($res->getBody(), true);
            $this->error  = $this->data['error_msg'];

            if (isset($this->data['credits_remain']))
            {
                $this->credits_left = $this->data['credits_remain'];
            }
        }
        catch (\Exception $ex)
        {
            $this->status       = $ex->getCode();
            $this->error        = $ex->getMessage();
            $this->credits_left = 0;
        }
    }

    public function get_searchindex_data()
    {
        try
        {
            $this->checkInput();
            $this->stripWWW();
            $res          = $this->guzzle->request('GET', 'https://metrics.tools/metricstools/api/domain', [
                'query' => [
                    'apikey' => trim($this->key),
                    'domain' => trim($this->input),
                    'query'  => 'sk',
                    'type'   => 'all'
                ]
            ]);
            $this->status = $res->getStatusCode();
            $this->data   = json_decode($res->getBody(), true);
            $this->error  = $this->data['error_msg'];

            if (isset($this->data['credits_remain']))
            {
                $this->credits_left = $this->data['credits_remain'];
            }
        }
        catch (\Exception $ex)
        {
            $this->status       = $ex->getCode();
            $this->error        = $ex->getMessage();
            $this->credits_left = 0;
        }
    }

    private function checkInput()
    {
        if ($this->input == '')
        {
            throw new \Exception('No input (keyword, domain, ...) found');
        }
    }
    
    private function stripWWW() {
        $this->input = str_ireplace(['www.'], '', $this->input);
    }

}
