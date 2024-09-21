<?php
    require_once('../src/Client.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        Client::get_deposits();
        }

?>