<?php
    require_once('../src/Client.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'PUT' ){
            Client::update_terrain_matrix();
        }

?>