<?php 

namespace Core;

class Session 
{
    public function __construct()
    {
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // affectation
    public function set($index, $value)
    {
        $_SESSION[$index] = $value;
    }

    // récupération
    public function get($index)
    {
        return isset($_SESSION[$index]) ? $_SESSION[$index] : null;
    }

    // vérification
    public function has($index)
    {
        return isset($_SESSION[$index]);
    }

    // Suppression
    public function remove($index)
    {
        unset($_SESSION[$index]);
    }

    // vider la session
    public function clear()
    {
        session_unset();
    }
}