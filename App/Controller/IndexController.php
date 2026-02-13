<?php 

namespace App\Controller;

use \Core\Controller;

class IndexController extends Controller
{
    public function index()
    {
        header('Location: ' . ROOT_URL . '/post');
        exit;
    }
}