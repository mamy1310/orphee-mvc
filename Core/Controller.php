<?php  

namespace Core;

class Controller 
{
    protected $session;
    public $messages = []; // Pour des messages utilisateurs

    public function __construct()
    {
        $this->session = new Session;
    }

    public function render($layout, $template, $params = []) 
    {
        extract($params); 

        ob_start(); 

        require_once ROOT_PATH . '/App/View/' . $template;

        $content = ob_get_clean(); 

        ob_start();

        require_once ROOT_PATH . '/App/View/' . $layout;

        return ob_end_flush(); 
    }

    public function displayMessage()
    {
        $messages = [
            'success' => $this->session->get('success'),
            'errors' => $this->session->get('errors'),
        ];

        $this->session->remove('success');
        $this->session->remove('errors');

        return $messages;
    }

}