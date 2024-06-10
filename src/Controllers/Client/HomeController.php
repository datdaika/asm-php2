<?php

namespace Admin\asm\Controllers\Client;

use Admin\asm\Commons\Controller;
class HomeController extends Controller
{
    public function index() {
        $name = 'Đạt Đại Ca';

        $this->renderViewClient('home', [
            'name' => $name
        ]);
    }
}