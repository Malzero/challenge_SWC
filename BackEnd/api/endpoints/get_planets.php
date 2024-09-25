<?php
    require_once('../src/Planets.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
            Planets::get_planets();
        }

?>