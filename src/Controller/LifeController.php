<?php

namespace App\Controller;

class LifeController extends AbstractController
{
    public function simulation()
    {
        return $this->twig->render('Life/index.html.twig');
    }
}
