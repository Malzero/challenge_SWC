<?php
    require_once('../src/TerrainDeposits.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'PUT' ){
            TerrainDeposits::update_terrain_deposit();
        }

?>