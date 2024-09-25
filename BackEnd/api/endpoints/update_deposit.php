<?php
    require_once('../src/Deposits.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'PUT' ){
            Deposits::update_deposit();
        }

?>