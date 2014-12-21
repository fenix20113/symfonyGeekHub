<?php

namespace Geekhub\GeekBundle\Tests\Service;

use Geekhub\GeekBundle\Form\Type\ArticleType;
use PHPUnit_Framework_TestCase;

class ArticleTypeTest extends PHPUnit_Framework_TestCase
{

    public function testArticlesType()
    {
        $articleType = new ArticleType();
        $this->assertInstanceOf('Geekhub\GeekBundle\Form\Type\ArticleType', $articleType);
        $this->assertEquals('article', $articleType->getName());
    }
}
