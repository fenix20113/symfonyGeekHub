<?php

namespace Geekhub\GeekBundle\Service;

use TwitterAPIExchange;

/**
 * Class Tweets
 * @package Geekhub\GeekBundle\Service
 */
class Tweets
{

    /**
     * @var array|mixed
     */
    protected $tweets = [];

    public function __construct($settings, $limit)
    {
        $this->tweets = $this->Tweets($settings, $limit);
    }

    /**
     * @param array $settings
     * @param $limit
     * @return mixed
     * @throws \Exception
     */
    public function Tweets($settings = [], $limit = 0)
    {

        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $getfield = '?screen_name=symfony&count=' . $limit;
        $requestMethod = 'GET';

        $twitter = new TwitterAPIExchange($settings);

        return json_decode(

            $twitter->setGetfield($getfield)
                ->buildOauth($url, $requestMethod)
                ->performRequest()
        );
    }

    public function getTweets()
    {
        return $this->tweets;
    }
}
