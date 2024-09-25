<?php
    require_once('../src/TerrainDeposits.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
            TerrainDeposits::delete_terrain_deposit();
        }

?>