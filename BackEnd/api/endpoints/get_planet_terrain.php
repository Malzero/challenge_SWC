<?php
    require_once('../src/Client.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
            Client::get_terrain();
        }

?>