<?php

declare(strict_types=1);

namespace App\Controller;

use Psr\Cache\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;
use Psr\Cache\CacheItemInterface;

/**
 * Class VinylController
 *
 * @author tresor-ilunga <ilungat82@gmail.com>
 */
final class VinylController extends AbstractController
{
    /**
     * This is the controller that renders the "Home" page.
     *
     * @return Response
     */
    #[Route('/', name: 'vinyl_homepage', methods: ['GET'])]
    public function homepage(): Response
    {
        $tracks =
            [
                ['song' => 'Gangsta\'s Paradise', 'artist' => 'Coolio'],
                ['song' => 'Waterfalls', 'artist' => 'TLC'],
                ['song' => 'Creep', 'artist' => 'Radiohead'],
                ['song' => 'Kiss from a Rose', 'artist' => 'Seal'],
                ['song' => 'On Bended Knee', 'artist' => 'Boyz II Men'],
                ['song' => 'Fantasy', 'artist' => 'Mariah Carey'],
            ];

            return $this->render('pages/vinyl/home.html.twig', [
            'title' => 'PB & Jams',
            'tracks' => $tracks
        ]);
    }

    /**
     * This is the controller that renders the "Browse" page.
     *
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface|InvalidArgumentException
     */
    #[Route('/browse/{slug}', name: 'vinyl_browse', methods: ['GET'])]
    public function browse(HttpClientInterface $httpClient,  CacheInterface $cache,string $slug = null): Response
    {
        $genre = $slug ? u(str_replace('-', ' ', $slug))->title(true) : null;
        $mixes = $cache->get('mixes_data', function(CacheItemInterface $cacheItem) use ($httpClient) {
            $cacheItem->expiresAfter(5);
            $response = $httpClient->request('GET', 'https://raw.githubusercontent.com/SymfonyCasts/vinyl-mixes/main/mixes.json');
            return $response->toArray();
        });

        return $this->render('pages/vinyl/browse.html.twig', [
            'genre' => $genre,
            'mixes' => $mixes
        ]);
    }
}
