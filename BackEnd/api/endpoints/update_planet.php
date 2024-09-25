<?php
    require_once('../src/Planets.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'PUT' ){
            Planets::update_planet();
        }

?>