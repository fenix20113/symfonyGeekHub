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

    public function __construct($oauth_access_token, $oauth_access_token_secret, $consumer_key, $consumer_secret, $limit)
    {
        $this->tweets = $this->showTweets($oauth_access_token, $oauth_access_token_secret, $consumer_key, $consumer_secret, $limit);
    }

    /**
     * @param $oauth_access_token
     * @param $oauth_access_token_secret
     * @param $consumer_key
     * @param $consumer_secret
     * @param int $limit
     * @return mixed
     * @throws \Exception
     */
    private function showTweets($oauth_access_token, $oauth_access_token_secret, $consumer_key, $consumer_secret, $limit = 5)
    {

        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $getfield = '?screen_name=symfony&count=' . $limit;
        $requestMethod = 'GET';

        $twitter = new TwitterAPIExchange([
            'oauth_access_token' => $oauth_access_token,
            'oauth_access_token_secret' => $oauth_access_token_secret,
            'consumer_key' => $consumer_key,
            'consumer_secret' => $consumer_secret
        ]);

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
