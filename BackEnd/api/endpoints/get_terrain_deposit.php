<?php
    require_once('../src/TerrainDeposits.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
            TerrainDeposits::get_terrain_deposit();
        }

?>