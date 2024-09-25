<?php
    require_once('../src/Deposits.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
            Deposits::create_deposit();
        }

?>