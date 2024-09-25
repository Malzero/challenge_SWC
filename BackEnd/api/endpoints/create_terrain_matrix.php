<?php
    require_once('../src/Terrains.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
            Terrains::create_terrain_matrix();
        }

?>