<?php
    require_once('../src/Deposits.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
            Deposits::delete_deposit();
        }

?>