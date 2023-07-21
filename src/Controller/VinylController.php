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
        return new Response('Hello World!');
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
