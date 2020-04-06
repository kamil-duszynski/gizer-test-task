<?php

namespace App\Client;

use App\Factory\ScoreFactory;
use App\Model\Score;
use Exception;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

class ScoreClient
{
    private const ENDPOINT = 'https://private-b5236a-jacek10.apiary-mock.com/results/games/1';

    private ClientInterface $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @return Score[]
     */
    public function getScores(): array
    {
        try {
            return $this->load();
        } catch (GuzzleException $e) {
            return [];
        } catch (Exception $exception) {
            return [];
        }
    }

    /**
     * @return Score[]
     *
     * @throws GuzzleException
     */
    private function load(): array
    {
        $response = $this->client->request('GET', self::ENDPOINT);
        $body     = $response->getBody()->getContents();
        $data     = json_decode($body, true);

        if (true === empty($data)) {
            return [];
        }

        $scores = [];

        foreach ($data as $scoreData) {
            $score = ScoreFactory::createFromArray($scoreData);

            $scores[(string) $score->getId()] = $score;
        }

        return $scores;
    }
}
