<?php

namespace JBuilder\JBuilderBundle\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Kernel;
use JBuilder\Common\Encoder;

/**
 * JBuilder for Symfony2
 *
 * @author  Dai Akatsuka <d.akatsuka@gmail.com>
 * @package JBuilder\JBuilderBundle\Service
 * @license The MIT License
 */
class JBuilderResponse
{
    /**
     * @var Kernel
     */
    private $kernel;

    /**
     * Dependency Injection
     *
     * @param Kernel $kernel
     */
    public function setKernel(Kernel $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * Render JSON
     *
     * inline example:
     *
     *     return $this->get('jbuilder')->render('AcmeBlogBundle:Post:index.json.php', array('posts' => $posts));
     *
     * @param $view
     * @param array $parameters
     * @param Response $response
     * @return Response
     */
    public function render($view, array $parameters = array(), Response $response = null)
    {
        if ($response === null) {
            $response = new Response();
        }

        $json = Encoder::encodeFromFile($this->getPath($view), $parameters);
        $response->setContent($json);

        return $response;
    }

    /**
     * Get full path
     *
     * @param $view
     * @return string
     */
    private function getPath($view)
    {
        $tmp = explode(':', $view);
        $bundlePath = $this->kernel->getBundle($tmp[0])->getPath();

        return $bundlePath . '/Resources/views/' . $tmp[1] . '/' . $tmp[2];
    }
}
