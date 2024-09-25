<?php
    require_once('../src/Deposits.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
            Deposits::get_deposits();
        }

?>