<?php

namespace JBuilder\JBuilderBundle\Tests;

use JBuilder\JBuilderBundle\Service\JBuilderResponse;
use Mockery;


class JBuilderResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testRender()
    {
        $bundle = Mockery::mock('Symfony\Component\HttpKernel\Bundle\BundleInterface');
        $bundle->shouldReceive('getPath')->andReturn(dirname(__FILE__));
        $kernel = Mockery::mock('Symfony\Component\HttpKernel\Kernel');
        $kernel->shouldReceive('getBundle')->with('AcmeBlogBundle')->andReturn($bundle);

        $jbuilder = new JBuilderResponse();
        $jbuilder->setKernel($kernel);
        $response = $jbuilder->render('AcmeBlogBundle:Post:index.json.php', array('title' => 'title'));

        $this->assertEquals('{"title":"title","author":{"name":"Dai Akatsuka","email":"d.akatsuka@gmail.com"}}', $response->getContent());
    }
}
