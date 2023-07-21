<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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

        return $this->render('pages/vinyl/index.html.twig', [
            'title' => 'PB & Jams',
            'tracks' => $tracks
        ]);
    }

    #[Route('/browse/{slug}', name: 'vinyl_browse', methods: ['GET'])]
    public function browse(string $slug = null): Response
    {
        if ($slug)
        {
            $title = 'Genre: '.u(str_replace('-', ' ', $slug))->title(true);
        }else
        {
            $title = 'All Genres';
        }

        return new Response($title);
        //return new Response('Breakup vinyl? Angsty 90s rock? Browse the collection!');
    }
}
