<?php 

namespace Core;

class Request
{
    public function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public function isGet()
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    public function getPostData()
    {
        return !empty($_POST) ? $_POST : null;
    }

    public function getGetData()
    {
        return !empty($_GET) ? $_GET : null;
    }

    public function getPost($key)
    {
        return isset($_POST[$key]) ? $_POST[$key] : null;
    }

    public function getGet($key)
    {
        return isset($_GET[$key]) ? $_GET[$key] : null;
    }

    public function getFile($key)
    {
        return isset($_FILES[$key]['name']) ? $_FILES[$key] : null;
    }

    public function validateFileExtension($file, $allowedExtensions = ['png', 'jpg', 'jpeg', 'gif', 'webp'])
    {
        if (!$file || !isset($file['name'])) {
            return false;
        }

        $fileName = $file['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        return in_array($fileExtension, $allowedExtensions);
    }
}