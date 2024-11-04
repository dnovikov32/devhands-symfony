<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HelloWordController
{
    #[Route('/hello/word', name: 'hello_word')]
    public function number(): Response
    {
        return new JsonResponse([
            'data' => 'Hello word'
        ]);
    }
}
