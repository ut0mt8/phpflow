<?php

include("./inc/main.php");
include("./inc/header.php");

if(file_exists('./inc/'.$page.'.php'))
    include('./inc/'.$page.'.php');
else
    include('./inc/error.php');

include("./inc/footer.php");

