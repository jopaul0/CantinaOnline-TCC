<?php

namespace app\classes;

class Utility
{
    public function getUrl()
    {
        $url = $_SERVER['REQUEST_URI'];
        $nome = 'CantinaOnline+';
        $pos = strpos($url, $nome);
        if ($pos !== false) {
            $diretorio = substr($url, 0, $pos + strlen($nome));
        }
        else{
            $pos2 = strpos(strtolower($url), strtolower($nome));

            if($pos2 !== false){
                $diretorio = substr(strtolower($url), 0, $pos2 + strlen($nome));
            }
        }
        return $diretorio;
    }

}
