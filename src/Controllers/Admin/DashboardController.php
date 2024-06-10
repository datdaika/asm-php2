<?php

namespace Admin\asm\Controllers\Admin;

use Admin\asm\Commons\Controller;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $this->renderViewAdmin(__FUNCTION__);
    }
}
