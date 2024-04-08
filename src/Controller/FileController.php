<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class FileController extends AbstractController
{

    #[Route('/file/small')]
    public function serveSmallAction()
    {
        return $this->json("heyyyya");
    }

}