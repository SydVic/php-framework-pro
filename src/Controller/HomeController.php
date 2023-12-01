<?php

namespace App\Controller;

use App\Widget;
use SydVic\Framework\Controller\AbstractController;
use SydVic\Framework\Http\Response;

class HomeController extends abstractController
{
    public function __construct(
        private Widget $widget
    )
    {
    }
    public function index(): Response
    {
        return $this->render('home.html.twig');
    }
}