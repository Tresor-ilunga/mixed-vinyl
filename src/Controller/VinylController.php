<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use function Symfony\Component\String\u;

/**
 * Class VinylController
 *
 * @author tresor-ilunga <ilungat82@gmail.com>
 */
final class VinylController extends AbstractController
{
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

    #[Route('/browse/{slug}', name: 'vinyl_browse', methods: ['GET'])]
    public function browse(string $slug = null): Response
    {
        $mixes = $this->getMixes();
        $genre = $slug ? u(str_replace('-', ' ', $slug))->title(true) : null;


        return $this->render('pages/vinyl/browse.html.twig', [
            'genre' => $genre,
            'mixes' => $mixes
        ]);
    }

    private function getMixes(): array
    {
        // temporary fake "mixes" data

        return [
            [
                'title' => 'PB & Jams',
                'trackCount' => 14,
                'genre' => 'Rock',
                'createdAt' => new \DateTime('2023-07-22'),
            ],
            [
                'title' => 'Put a Hex on your Ex',
                'trackCount' => 8,
                'genre' => 'Heavy Metal',
                'createdAt' => new \DateTime('2023-07-22'),
            ],
            [
                'title' => 'Spice Grills - Summer Tunes',
                'trackCount' => 10,
                'genre' => 'Pop',
                'createdAt' => new \DateTime('2023-07-22'),
            ],

        ];
    }
}
