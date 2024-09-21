<?php
class Database
{
    private $host = "mysql";
    private $user = "swc";
    private $password = "swc";
    private $database = "swc";

    public function getConnection()
    {
        //mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $connection = new mysqli($this->host, $this->user, $this->password, $this->database);

        if ($connection->connect_errno) {
            printf("Connect failed: %s\n", $connection->connect_error);
            return -1;
        }
        return $connection;
    }
}
