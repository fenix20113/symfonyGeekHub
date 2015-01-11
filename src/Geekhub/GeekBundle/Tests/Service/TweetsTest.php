<?php

namespace Geekhub\GeekBundle\Tests\Service;

use Geekhub\GeekBundle\Service\Tweets;
use PHPUnit_Framework_TestCase;

class TweetsTest extends PHPUnit_Framework_TestCase
{

    public function testShowTweets()
    {
        $oauth_access_token = '455610210-352FeTjlStWV7D3BvOMAHIInYGoTUeXFClLJ9AEE';
        $oauth_access_token_secret = 'k8FhUxGNmNu5z6AiVlXlgRdvMTIAJqSg4K8aCcmzoaTR4';
        $consumer_key = 'Ybni96J4sQuaFfs5KehqP1tZB';
        $consumer_secret = '7LqZ87WnpYELIUbPuNI6rJistDdZJn7tfp0pYiPdgKQJQ8twCD';

        $tweets = new Tweets($oauth_access_token, $oauth_access_token_secret, $consumer_key, $consumer_secret, 5);

        $this->assertLessThanOrEqual(5, count($tweets->getTweets()));
    }
}
