<?php
    require_once('../src/Planets.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
            Planets::get_planets();
        }

?>