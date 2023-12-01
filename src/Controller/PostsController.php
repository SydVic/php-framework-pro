<?php

namespace App\Controller;

use SydVic\Framework\Controller\AbstractController;
use SydVic\Framework\Http\Response;

class PostsController extends AbstractController
{
    public function show(int $id): Response
    {
        return $this->render('/posts/show.html.twig', [
            'postId' => $id
        ]);
    }

    public function create(): Response
    {
        return  $this->render('/posts/create.html.twig');
    }
}