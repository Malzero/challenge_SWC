<?php
    require_once('../src/Planets.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
            Planets::delete_planet();
        }

?>