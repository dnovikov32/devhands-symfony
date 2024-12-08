<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class WorkController
{
    #[Route('/work/{milliseconds}', name: 'work_ms')]
    public function work(int $milliseconds): Response
    {
        $start = microtime(true);
        $seconds = $milliseconds / 1000;

        while (microtime(true) - $start < $seconds) {
            md5(uniqid());
        }

        return new JsonResponse([
            'data' => microtime(true) - $start
        ]);
    }
}
