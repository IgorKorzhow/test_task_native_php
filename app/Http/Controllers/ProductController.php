<?php

namespace App\Http\Controllers;

use Kernel\Components\Controller\AbstractController;

class ProductController extends AbstractController
{
    public function index(): void
    {
        $this->render('/products/showProductView.php', []);
    }
}