<?php
    require_once('Database.class.php');

    class Client{
        private static function isValidJSON($str) {
            json_decode($str);
            return json_last_error() == JSON_ERROR_NONE;
        }
        public static function create_deposit(){

            $json_params = file_get_contents("php://input");

            if (strlen($json_params) > 0 && self::isValidJSON($json_params))
            {
                $database = new Database();
                $conn = $database->getConnection();
                
                $data = json_decode($json_params);
                $query = 'INSERT INTO swc.deposits
                        (name, depositType_id, img_url)
                        VALUES(?, ?, ?);';

                if ($stmt = $conn->prepare($query)) {
                    $stmt->bind_param("sis", $data->name, $data->depositType_id, $data->img_url);
                    try {
                        if($stmt->execute()){
                            if ($stmt->affected_rows && $stmt->affected_rows >= 1) {
                                $response = array((object)['message'=>"Data created","affected_rows"=>$stmt->affected_rows ,'code'=>201]);
                                header('Content-Type: application/json; charset=utf-8');
                                http_response_code(201);
                                echo json_encode($response);
                                mysqli_stmt_close($stmt);
                            }
                            else {
                                http_response_code(304);
                                mysqli_stmt_close($stmt);
                            }
                        } else {
                            http_response_code(409);
                            mysqli_stmt_close($stmt);
                        }
                        mysqli_close($conn);
                    } catch (\Throwable $th) {
                        $response = array((object)['message'=>"Error inserting data","error"=>$stmt->error ,'sql_code'=>1062]);
                        header('Content-Type: application/json; charset=utf-8');
                        http_response_code(409);
                        echo json_encode($response);
                        mysqli_stmt_close($stmt);
                    }

                }
            }
            else {
                http_response_code(400);
            }
        }
        public static function get_deposits(){
            $database = new Database();
            $conn = $database->getConnection();
            $query = 'SELECT
                        swc.deposits.id,
                        swc.deposits.name,
                        swc.deposits_types.name,
                        swc.deposits.img_url
                        FROM swc.deposits
                        INNER JOIN swc.deposits_types
                        ON swc.deposits_types.id=swc.deposits.depositType_id;';
            $response = array();
            if ($stmt = $conn->prepare($query)) {
                if($stmt->execute()){
                    $stmt->bind_result($id, $name, $type, $img_url);
                    while ($stmt->fetch()) {
                        array_push($response,
                        (object)[
                            'id'=> $id,
                            'name'=> $name,
                            'type'=> $type,
                            'img_url'=> $img_url,
                        ]);
                    }
                    header('Content-Type: application/json; charset=utf-8');
                    http_response_code(200);
                    echo json_encode($response);
                    mysqli_stmt_close($stmt);
                    
                } else {
                    http_response_code(404);
                    mysqli_stmt_close($stmt);
                }
                mysqli_close($conn);
            }
        }
        public static function update_deposit(){

            $json_params = file_get_contents("php://input");

            if (strlen($json_params) > 0 && self::isValidJSON($json_params))
            {
                $database = new Database();
                $conn = $database->getConnection();
                
                $data = json_decode($json_params);
                $query = 'UPDATE swc.deposits
                            SET name=?,
                            depositType_id=?,
                            img_url=?
                            WHERE id=?;';
                if ($stmt = $conn->prepare($query)) {
                    $stmt->bind_param("sisi", $data->name, $data->depositType_id, $data->img_url, $data->id);
                    if($stmt->execute()){
                        if ($stmt->affected_rows && $stmt->affected_rows >= 1) {
                            $response = array((object)['message'=>"Data updated","affected_rows"=>$stmt->affected_rows ,'code'=>200]);
                            header('Content-Type: application/json; charset=utf-8');
                            http_response_code(200);
                            echo json_encode($response);
                            mysqli_stmt_close($stmt);
                        }
                        else {
                            http_response_code(304);
                            mysqli_stmt_close($stmt);
                        }
                    } else {
                        http_response_code(404);
                        mysqli_stmt_close($stmt);
                    }
                    mysqli_close($conn);
                }
            }
            else {
                http_response_code(400);
            }
        }
        public static function delete_deposit(){

            $json_params = file_get_contents("php://input");

            if (strlen($json_params) > 0 && self::isValidJSON($json_params))
            {
                $database = new Database();
                $conn = $database->getConnection();
                
                $data = json_decode($json_params);
                $query = 'DELETE FROM swc.deposits WHERE id=?;';
                if ($stmt = $conn->prepare($query)) {
                    $stmt->bind_param("i", $data->id);
                    if($stmt->execute()){
                        if ($stmt->affected_rows && $stmt->affected_rows >= 1) {
                            $response = array((object)['message'=>"Data updated","affected_rows"=>$stmt->affected_rows ,'code'=>200]);
                            header('Content-Type: application/json; charset=utf-8');
                            http_response_code(200);
                            echo json_encode($response);
                            mysqli_stmt_close($stmt);
                        }
                        else {
                            http_response_code(304);
                            mysqli_stmt_close($stmt);
                        }
                    } else {
                        http_response_code(404);
                        mysqli_stmt_close($stmt);
                    }
                    mysqli_close($conn);
                }
            }
            else {
                http_response_code(400);
            }
        }
    }

?>