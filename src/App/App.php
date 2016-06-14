<?php
namespace Alxsad\App;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Zend\Diactoros\Response\EmitterInterface as Emitter;
use League\Route\RouteCollection;
use DI\Annotation\Inject;

class App
{
    /**
     * @Inject
     * @var RouteCollection
     */
    protected $router;

    /**
     * @Inject
     * @var Request
     */
    protected $request;

    /**
     * @Inject
     * @var Response
     */
    protected $response;

    /**
     * @Inject
     * @var Emitter
     */
    protected $emitter;

    /**
     * @var bool
     */
    protected $initialized = false;

    public function init()
    {
        $this->initRoutes();
        $this->initialized = true;
    }

    protected function initRoutes()
    {
        $this->router->get('/posts', 'Alxsad\App\Controller\PostController::list');
    }

    public function dispatch()
    {
        if (!$this->initialized) {
            $this->init();
        }
        $response = $this->router->dispatch($this->request, $this->response);
        $this->emitter->emit($response);
    }
}
