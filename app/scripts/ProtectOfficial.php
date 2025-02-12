<?php

require './app/scripts/isSessionOfficial.php';
require './app/scripts/DirUrl.php';
if ($sessionofficial == false)
    header("Location: $diretorio");
