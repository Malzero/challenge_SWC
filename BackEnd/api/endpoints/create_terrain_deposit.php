<?php
    require_once('../src/TerrainDeposits.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
            TerrainDeposits::create_terrain_deposit();
        }

?>