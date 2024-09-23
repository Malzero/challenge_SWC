<?php
    require_once('../src/Client.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
            Client::delete_terrain_matrix();
        }

?>