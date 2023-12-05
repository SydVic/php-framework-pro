<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostMapper;
use App\Repository\PostRepository;
use SydVic\Framework\Controller\AbstractController;
use SydVic\Framework\Http\RedirectResponse;
use SydVic\Framework\Http\Response;

class PostsController extends AbstractController
{
    private string $createRoute = '/posts/create';

    public function __construct(
        private PostMapper $postMapper,
        private PostRepository $postRepository
    )
    {
    }

    public function show(int $id): Response
    {
        $post = $this->postRepository->findOrFail($id);

        return $this->render('/posts/show.html.twig', [
            'post' => $post
        ]);
    }

    public function create(): Response
    {
        return  $this->render("$this->createRoute.html.twig");
    }

    public function store(): Response
    {
        $title = $this->request->postParams['title'];
        $body = $this->request->postParams['body'];

        $post = Post::create($title, $body);


        $this->postMapper->save($post);

        return new RedirectResponse($this->createRoute);
    }
}