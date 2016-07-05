<?php
namespace Alxsad\App\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Interop\Container\ContainerInterface;
use FastRoute\Dispatcher;

class FastRouteMiddleware implements MiddlewareInterface
{
    private $container;
    private $router;

    public function __construct(ContainerInterface $container, Dispatcher $router)
    {
        $this->container = $container;
        $this->router    = $router;
    }

    public function __invoke(Request $request, Response $response, callable $next = null): Response
    {
        $route = $this->router->dispatch(
            $request->getMethod(),
            $request->getUri()->getPath()
        );
        switch ($route[0]) {
            case Dispatcher::NOT_FOUND:
                return $response->withStatus(404);
            case Dispatcher::METHOD_NOT_ALLOWED:
                return $response->withStatus(405);
            case Dispatcher::FOUND:
                $controller = $route[1];
                foreach ($route[2] as $name => $value) {
                    $request = $request->withAttribute($name, $value);
                }
                $response = $this->container->call($controller, [$request, $response]);
                return $next($request, $response);
        }
    }
}
