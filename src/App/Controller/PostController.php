<?php
namespace Alxsad\App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Alxsad\Domain\Repository\PostRepository;
use DI\Annotation\Inject;

class PostController
{
    /**
    * @Inject
    * @var PostRepository
    */
    private $repository;

    public function list(Request $request, Response $response)
    {
        $response->getBody()->write('Hello, World!');
        return $response;
    }
}
