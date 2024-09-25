<?php
require_once('Database.class.php');
require_once('Helpers.class.php');

class TerrainDeposits
{
    //Terrain-Deposits CRUD
    public static function create_terrain_deposit()
    {
        $helpers = new Helpers();
        $json_params = file_get_contents("php://input");

        if (strlen($json_params) > 0 && $helpers->isValidJSON($json_params)) {
            $database = new Database();
            $conn = $database->getConnection();

            $data = json_decode($json_params);
            $query = 'INSERT INTO swc.planetTerrain_deposits
                            (terrain_id, deposit_id, quantity)
                            VALUES(?, ?, ?);';

            if ($stmt = $conn->prepare($query)) {
                $stmt->bind_param("iii", $data->terrain_id, $data->deposit_id, $data->quantity);
                try {
                    if ($stmt->execute()) {
                        if ($stmt->affected_rows && $stmt->affected_rows >= 1) {
                            $response = array((object)['message' => "Data created", "affected_rows" => $stmt->affected_rows, 'code' => 201]);
                           
                            $query_update = 'UPDATE swc.planet_terrain
                                                SET terrain_have_deposit=1
                                                WHERE id = ?';
                            if ($stmt = $conn->prepare($query_update)) {
                                $stmt->bind_param("i", $data->terrain_id);
                                try {
                                    if ($stmt->execute()) {
                                        if ($stmt->affected_rows && $stmt->affected_rows >= 1) {
                                            header('Content-Type: application/json; charset=utf-8');
                                            http_response_code(201);
                                            echo json_encode($response);
                                            mysqli_stmt_close($stmt);
                                        }

                                    }
                                } catch(\Throwable $th) {
                                    $response = array((object)['message' => "Error updating terrain data", "error" => $stmt->error, 'sql_code' => $stmt->errno]);
                                    header('Content-Type: application/json; charset=utf-8');
                                    http_response_code(409);
                                    echo json_encode($response);
                                    mysqli_stmt_close($stmt);
                                    
                                }
                            }
                            
                        } else {
                            http_response_code(304);
                            mysqli_stmt_close($stmt);
                        }
                    } else {
                        http_response_code(409);
                        mysqli_stmt_close($stmt);
                    }
                    mysqli_close($conn);
                } catch (\Throwable $th) {
                    //print_r($th);
                    $response = array((object)['message' => "Error inserting data", "error" => $stmt->error, 'sql_code' => $stmt->errno]);
                    header('Content-Type: application/json; charset=utf-8');
                    http_response_code(409);
                    echo json_encode($response);
                    mysqli_stmt_close($stmt);
                }
            }
        } else {
            http_response_code(400);
        }
    }
    public static function get_terrain_deposit()
    {
        $helpers = new Helpers();
        $json_params = file_get_contents("php://input");

        if (strlen($json_params) > 0 && $helpers->isValidJSON($json_params)) {
            $database = new Database();
            $conn = $database->getConnection();
            $data = json_decode($json_params);
            $query = 'SELECT planetTerrain_deposits.id,
                        swc.planetTerrain_deposits.deposit_id,
                        swc.deposits.name,
                        swc.deposits.img_url,
                        swc.planetTerrain_deposits.quantity 
                        FROM swc.planetTerrain_deposits
                        INNER JOIN swc.deposits
                        ON swc.planetTerrain_deposits.deposit_id=swc.deposits.id
                        WHERE swc.planetTerrain_deposits.terrain_id = ?;';
            $response = array();
            if ($stmt = $conn->prepare($query)) {
                $stmt->bind_param("i", $data->terrain_id);
                if ($stmt->execute()) {
                    $stmt->bind_result($id, $deposit_id, $name, $img_url, $quantity);
                    while ($stmt->fetch()) {
                        array_push(
                            $response,
                            (object)[
                                'id' => $id,
                                'deposit_id' => $deposit_id,
                                'name' => $name,
                                'img_url' => $img_url,
                                'quantity' => $quantity,
                            ]
                        );
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
    }
    public static function update_terrain_deposit()
    {
        $helpers = new Helpers();
        $json_params = file_get_contents("php://input");

        if (strlen($json_params) > 0 && $helpers->isValidJSON($json_params)) {
            $database = new Database();
            $conn = $database->getConnection();

            $data = json_decode($json_params);
            $query = 'UPDATE swc.planetTerrain_deposits
                        SET deposit_id=?, quantity=?
                        WHERE terrain_id=?;';

            if ($stmt = $conn->prepare($query)) {
                $stmt->bind_param("iii", $data->deposit_id, $data->quantity, $data->terrain_id);
                try {
                    if ($stmt->execute()) {
                        if ($stmt->affected_rows && $stmt->affected_rows >= 1) {
                            $response = array((object)['message' => "Data updated", "affected_rows" => $stmt->affected_rows, 'code' => 200]);
                            header('Content-Type: application/json; charset=utf-8');
                            http_response_code(200);
                            echo json_encode($response);
                            mysqli_stmt_close($stmt);
                        } else {
                            http_response_code(304);
                            mysqli_stmt_close($stmt);
                        }
                    } else {
                        http_response_code(404);
                        mysqli_stmt_close($stmt);
                    }
                    mysqli_close($conn);
                } catch (\Throwable $th) {
                    $response = array((object)['message' => "Error updating data", "error" => $stmt->error, 'sql_code' => $stmt->errno]);
                    header('Content-Type: application/json; charset=utf-8');
                    http_response_code(409);
                    echo json_encode($response);
                    mysqli_stmt_close($stmt);
                }
            }
        } else {
            http_response_code(400);
        }
    }
    public static function delete_terrain_deposit()
    {
        $helpers = new Helpers();
        $json_params = file_get_contents("php://input");

        if (strlen($json_params) > 0 && $helpers->isValidJSON($json_params)) {
            $database = new Database();
            $conn = $database->getConnection();

            $data = json_decode($json_params);
            $query = 'DELETE FROM swc.planetTerrain_deposits
                        WHERE terrain_id=?;';

            if ($stmt = $conn->prepare($query)) {
                $stmt->bind_param("i", $data->terrain_id);
                try {
                    if ($stmt->execute()) {
                        if ($stmt->affected_rows && $stmt->affected_rows >= 1) {
                            $response = array((object)['message' => "Data eliminated", "affected_rows" => $stmt->affected_rows, 'code' => 201]);
                           
                            $query_update = 'UPDATE swc.planet_terrain
                                                SET terrain_have_deposit=0
                                                WHERE id = ?';
                            if ($stmt = $conn->prepare($query_update)) {
                                $stmt->bind_param("i", $data->terrain_id);
                                try {
                                    if ($stmt->execute()) {
                                        if ($stmt->affected_rows && $stmt->affected_rows >= 1) {
                                            header('Content-Type: application/json; charset=utf-8');
                                            http_response_code(201);
                                            echo json_encode($response);
                                            mysqli_stmt_close($stmt);
                                        }

                                    }
                                } catch(\Throwable $th) {
                                    $response = array((object)['message' => "Error updating terrain data", "error" => $stmt->error, 'sql_code' => $stmt->errno]);
                                    header('Content-Type: application/json; charset=utf-8');
                                    http_response_code(409);
                                    echo json_encode($response);
                                    mysqli_stmt_close($stmt);
                                    
                                }
                            }
                            
                        } else {
                            http_response_code(304);
                            mysqli_stmt_close($stmt);
                        }
                    } else {
                        http_response_code(409);
                        mysqli_stmt_close($stmt);
                    }
                    mysqli_close($conn);
                } catch (\Throwable $th) {
                    //print_r($th);
                    $response = array((object)['message' => "Error inserting data", "error" => $stmt->error, 'sql_code' => $stmt->errno]);
                    header('Content-Type: application/json; charset=utf-8');
                    http_response_code(409);
                    echo json_encode($response);
                    mysqli_stmt_close($stmt);
                }
            }
        } else {
            http_response_code(400);
        }
    }
}
