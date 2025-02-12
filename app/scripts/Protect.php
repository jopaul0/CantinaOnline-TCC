<?php

require './app/scripts/isSession.php';
require './app/scripts/DirUrl.php';
if ($session == false)
    header("Location: $diretorio/Login");