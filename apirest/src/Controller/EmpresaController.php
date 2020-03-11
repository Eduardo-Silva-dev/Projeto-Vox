<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
     * @Route("/empresa", name="empresa")
     */
class EmpresaController extends AbstractController
{
    /**
     * @Route("/", name="listarTodos", methods="GET")
     */
    public function listarTodos()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/EmpresaController.php',
        ]);
    }
}
