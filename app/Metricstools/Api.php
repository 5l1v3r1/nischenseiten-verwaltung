<?php

namespace App\Metricstools\Api;

use GuzzleHttp\Client;

/**
 * Simple metrics.tools api implementation
 */
class Api
{

    /**
     * @var string $key
     */
    private $key = '';

    /**
     * @var \GuzzleHttp\Client $guzzle
     */
    private $guzzle = null;

    /**
     * @var string $input
     */
    public $input = '';

    /**
     * @var int $status
     */
    public $status;

    /**
     * @var array $data
     */
    public $data = [];

    /**
     * @var int $credits_left
     */
    public $credits_left = null;

    /**
     * @var string $error
     */
    public $error = '';

    /**
     * Load important data for this object
     *
     * @param string $key metrics.tools API Key
     * @param string $input keyword or domainhost
     */
    public function __construct($key, $input = '')
    {
        $this->guzzle = new Client();
        $this->key = $key;
        $this->input = $input;
    }

    /**
     * Get searchvolume, cpc, competition for a keyword
     *
     * @return void Data is within publicly accessible variables ($data)
     * @throws Exception when server blocks request
     */
    public function getKeywordData()
    {
        try {
            $this->checkInput();

            $res = $this->guzzle->request('GET', 'https://metrics.tools/metricstools/api/keyword', [
                'query' => [
                    'apikey' => trim($this->key),
                    'keyword' => trim($this->input),
                    'query' => 'details',
                ],
            ]);
            $this->status = $res->getStatusCode();
            $this->data = json_decode($res->getBody(), true);
            $this->error = $this->data['error_msg'];

            if (isset($this->data['credits_remain'])) {
                $this->credits_left = $this->data['credits_remain'];
            }
        } catch (\Exception $ex) {
            $this->status = $ex->getCode();
            $this->error = $ex->getMessage();
            $this->credits_left = 0;
        }
    }

    /**
     * Get amount of credits left for this key
     *
     * @return void Data is within publicly accessible variables ($data)
     * @throws Exception when server blocks request
     */
    public function getCreditCount()
    {
        try {
            $res = $this->guzzle->request('GET', 'https://metrics.tools/metricstools/api/domain', [
                'query' => [
                    'apikey' => trim($this->key),
                    'domain' => 'google.de',
                    'query' => 'position',
                    'keyword' => 'google',
                ],
            ]);
            $this->status = $res->getStatusCode();
            $this->data = json_decode($res->getBody(), true);
            $this->error = $this->data['error_msg'];

            if (isset($this->data['credits_remain'])) {
                $this->credits_left = $this->data['credits_remain'];
            }
        } catch (\Exception $ex) {
            $this->status = $ex->getCode();
            $this->error = $ex->getMessage();
            $this->credits_left = 0;
        }
    }

    /**
     * Get Top 500 Rankings for a given domainhost
     *
     * @return void Data is within publicly accessible variables ($data)
     * @throws Exception when server blocks request
     */
    public function getRankings()
    {
        try {
            $this->checkInput();

            $res = $this->guzzle->request('GET', 'https://metrics.tools/metricstools/api/domain', [
                'query' => [
                    'apikey' => trim($this->key),
                    'domain' => trim($this->input),
                    'query' => 'rankings',
                    'order_column' => 'traffic',
                    'order_direction' => 'desc',
                    'limit' => 500,
                ],
            ]);
            $this->status = $res->getStatusCode();
            $this->data = json_decode($res->getBody(), true);
            $this->error = $this->data['error_msg'];

            if (isset($this->data['credits_remain'])) {
                $this->credits_left = $this->data['credits_remain'];
            }
        } catch (\Exception $ex) {
            $this->status = $ex->getCode();
            $this->error = $ex->getMessage();
            $this->credits_left = 0;
        }
    }

    /**
     * Get the searchindex (index per day) for a given domain
     *
     * @return void Data is within publicly accessible variables ($data)
     * @throws Exception when server blocks request
     */
    public function getSearchindexData()
    {
        try {
            $this->checkInput();
            $this->stripWWW();
            $res = $this->guzzle->request('GET', 'https://metrics.tools/metricstools/api/domain', [
                'query' => [
                    'apikey' => trim($this->key),
                    'domain' => trim($this->input),
                    'query' => 'sk',
                    'type' => 'all',
                ],
            ]);
            $this->status = $res->getStatusCode();
            $this->data = json_decode($res->getBody(), true);
            $this->error = $this->data['error_msg'];

            if (isset($this->data['credits_remain'])) {
                $this->credits_left = $this->data['credits_remain'];
            }
        } catch (\Exception $ex) {
            $this->status = $ex->getCode();
            $this->error = $ex->getMessage();
            $this->credits_left = 0;
        }
    }

    /**
     * We need an input, therefor check if it exsists
     *
     * @return void
     * @throws Exception when input is empty
     */
    private function checkInput()
    {
        if ($this->input == '') {
            throw new \Exception('No input (keyword, domain, ...) found');
        }
    }

    /**
     * metrics.tools works only with the domain name without subdomain
     *
     * IMPORTANT: if a project looks like this: www.projekt.de AND blog.projekt.de
     * than theres no problem fetching data for blog.projekt.de
     *
     * @return void
     */
    private function stripWWW()
    {
        $this->input = str_ireplace(['www.'], '', $this->input);
    }
}
