<?php

declare(strict_types=1);

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SongApiController
 *
 * @author tresor-ilunga <ilungat82@gmail.com>
 */
final class SongApiController extends AbstractController
{
    #[Route('/api/songs/{id<\d+>}', name: 'api_song_get', methods: ['GET'])]
    public function getSong(int $id, LoggerInterface $logger): Response
    {
        // TODO query the database
        $song = [
            'id' => $id,
            'name' => 'Waterfalls',
            'url' => 'https://symfonycasts.s3.amazonaws.com/sample.mp3',
        ];
        $logger->info('Returning API response for song {song}', [
            'song' => $id,
        ]);

        return new JsonResponse($song);

    }
}