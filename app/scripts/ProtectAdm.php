<?php

require './app/scripts/isSessionAdm.php';
require './app/scripts/DirUrl.php';
if ($sessionadm == false)
    header("Location: $diretorio");
