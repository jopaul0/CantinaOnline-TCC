<?php

namespace app\classes;

class Session
{
    public function startSession()
    {
        session_start();
    }

    public function destroySession()
    {
        session_unset(); // Limpa a sessão
        session_destroy(); // Destrói a sessão
    }


    public function isLogged()
    {
        if (isset($_SESSION['id']))
            return true;
        else
            return false;
    }

    public function isLoggedOfficial()
    {
        if (isset($_SESSION['id']) && ($_SESSION['status'] == 'Vendedor' || $_SESSION['status'] == 'Admin'))
            return true;
        else
            return false;
    }
    public function isLoggedAdm()
    {
        if (isset($_SESSION['id']) && $_SESSION['status'] == 'Admin')
            return true;
        else
            return false;
    }

}