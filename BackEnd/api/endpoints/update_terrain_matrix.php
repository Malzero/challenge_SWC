<?php
    require_once('../src/Terrains.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'PUT' ){
            Terrains::update_terrain_matrix();
        }

?>