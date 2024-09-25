<?php
    require_once('../src/Terrains.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
            Terrains::delete_terrain_matrix();
        }

?>