<?php
require_once('Database.class.php');
require_once('Helpers.class.php');

class Terrains
{
    //Terrains tiles CRUD
    private static function create_terrain($planet_id, $terrain_coordX, $terrain_coordY, $terrain_have_deposit, $terrain_type_id)
    {

        $database = new Database();
        $conn = $database->getConnection();

        $query = 'INSERT INTO swc.planet_terrain
                            (planet_id, terrain_coordX, terrain_coordY, terrain_have_deposit, terrain_type_id)
                            VALUES(?, ?, ?, ?, ?)';

        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("iiiii", $planet_id, $terrain_coordX, $terrain_coordY, $terrain_have_deposit, $terrain_type_id);
            try {
                if ($stmt->execute()) {
                    if ($stmt->affected_rows && $stmt->affected_rows >= 1) {
                        $response = array((object)['message' => "Data created", "affected_rows" => $stmt->affected_rows, 'code' => 201]);
                        mysqli_stmt_close($stmt);
                        return ($response);
                    } else {
                        $response = array((object)['message' => "Error inserting data", "error" => $stmt->error, 'sql_code' => $stmt->errno, 'code' => 304]);
                        mysqli_stmt_close($stmt);
                        return ($response);
                    }
                } else {
                    $response = array((object)['message' => "Error inserting data", "error" => $stmt->error, 'sql_code' => $stmt->errno, 'code' => 409]);
                    mysqli_stmt_close($stmt);
                    return ($response);
                }
                mysqli_close($conn);
            } catch (\Throwable $th) {
                $response = array((object)['message' => "Error inserting data", "error" => $stmt->error, 'sql_code' => $stmt->errno, 'code' => 409]);
                mysqli_stmt_close($stmt);
                return ($response);
            }
        }
    }
    private static function update_terrain($id, $planet_id, $terrain_coordX, $terrain_coordY, $terrain_have_deposit, $terrain_type_id)
    {
        $database = new Database();
        $conn = $database->getConnection();

        $query = 'UPDATE swc.planet_terrain
                    SET planet_id=?, terrain_have_deposit=?, terrain_type_id=?, terrain_coordX=?, terrain_coordY=?
                    WHERE id=? ;';

        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("iiiiii", $planet_id, $terrain_have_deposit, $terrain_type_id, $terrain_coordX, $terrain_coordY, $id);
            //printf("%d %d %d %d %d %d\n",$id, $planet_id, $terrain_coordX, $terrain_coordY, $terrain_have_deposit, $terrain_type_id);
            try {
                if ($stmt->execute()) {
                    if ($stmt->affected_rows && $stmt->affected_rows >= 1) {
                        $response = array((object)['message' => "Data updated", "affected_rows" => $stmt->affected_rows, 'code' => 201]);
                        mysqli_stmt_close($stmt);
                        return ($response);
                    } else {
                        $response = array((object)['message' => "Error updating data", "error" => $stmt->error, 'sql_code' => $stmt->errno, 'code' => 304]);
                        mysqli_stmt_close($stmt);
                        return ($response);
                    }
                } else {
                    $response = array((object)['message' => "Error updating data", "error" => $stmt->error, 'sql_code' => $stmt->errno, 'code' => 409]);
                    mysqli_stmt_close($stmt);
                    return ($response);
                }
                mysqli_close($conn);
            } catch (\Throwable $th) {
                $response = array((object)['message' => "Error updating data", "error" => $stmt->error, 'sql_code' => $stmt->errno, 'code' => 409]);
                mysqli_stmt_close($stmt);
                return ($response);
            }
        }
    }
    public static function create_terrain_matrix()
    {
        $helpers = new Helpers();
        $json_params = file_get_contents("php://input");

        if (strlen($json_params) > 0 && $helpers->isValidJSON($json_params)) {
            $database = new Database();
            $conn = $database->getConnection();

            $data = json_decode($json_params);


            try {
                foreach ($data->matrix as $i => $object) {
                    $query = 'SELECT sizeX, sizeY
                                FROM swc.planets
                                WHERE id = ?;';
                    if ($stmt = $conn->prepare($query)) {

                        $stmt->bind_param("i", $object->planet_id);

                        if ($stmt->execute()) {

                            $stmt->bind_result($sizeX, $sizeY);
                            $stmt->store_result();
                            if ($stmt->num_rows > 0) {
                                while ($stmt->fetch()) {
                                    if ($sizeX * $sizeY == count($data->matrix)) {
                                        $message = "same size";
                                        $code = 201;
                                        $response = self::create_terrain(
                                                $object->planet_id,
                                                $object->terrain_coordX,
                                                $object->terrain_coordY,
                                                $object->terrain_have_deposit,
                                                $object->terrain_type_id
                                            );
                                    } else {
                                        $message = "Bad size";
                                        $code = 304;
                                        $response = array((object)['message' => $message, 'num_rows' => $stmt->num_rows, 'code' => $code]);
                                    }
                                }
                            } else {
                                $message = "Planet not found";
                                $code = 404;
                                $response = array((object)['message' => $message, 'num_rows' => $stmt->num_rows, 'code' => $code]);
                            }
                        } else {
                            $response = array((object)['message' => "MySQL error.", "error" => $stmt->error, 'sql_code' => $stmt->errno]);
                            header('Content-Type: application/json; charset=utf-8');
                            http_response_code(409);
                            echo json_encode($response);
                            mysqli_stmt_close($stmt);
                        }
                    }
                }

                http_response_code($code);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
            } catch (\Throwable $th) {
                print_r($th);
                $response = array((object)['message' => "MySQL error.", "error" => $stmt->error, 'sql_code' => $stmt->errno]);
                header('Content-Type: application/json; charset=utf-8');
                http_response_code(409);
                echo json_encode($response);
                mysqli_stmt_close($stmt);
            }
        } else {
            http_response_code(400);
        }
    }
    public static function get_terrain()
    {
        $helpers = new Helpers();
        $json_params = file_get_contents("php://input");

        if (strlen($json_params) > 0 && $helpers->isValidJSON($json_params)) {
            $database = new Database();
            $conn = $database->getConnection();
            $data = json_decode($json_params);
            $query = 'SELECT 
                        swc.planet_terrain.id,
                        swc.planet_terrain.terrain_coordX,
                        swc.planet_terrain.terrain_coordY,
                        swc.planet_terrain.terrain_have_deposit,
                        swc.planet_terrain.terrain_type_id,
                        swc.terrain_types.img_url
                        FROM swc.planet_terrain
                        INNER JOIN swc.terrain_types
                        ON swc.planet_terrain.terrain_type_id=swc.terrain_types.id
                        WHERE swc.planet_terrain.planet_id = ?';
            $response = array();
            if ($stmt = $conn->prepare($query)) {
                $stmt->bind_param("i", $data->planet_id);
                if ($stmt->execute()) {
                    $stmt->bind_result($id, $terrain_coordX, $terrain_coordY, $terrain_have_deposit, $terrain_type_id, $img_url);
                    while ($stmt->fetch()) {
                        array_push(
                            $response,
                            (object)[
                                'id' => $id,
                                'terrain_coordX' => $terrain_coordX,
                                'terrain_coordY' => $terrain_coordY,
                                'terrain_have_deposit' => $terrain_have_deposit,
                                'terrain_type_id' => $terrain_type_id,
                                'img_url' => $img_url,
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
    public static function update_terrain_matrix()
    {
        $helpers = new Helpers();
        $json_params = file_get_contents("php://input");

        if (strlen($json_params) > 0 && $helpers->isValidJSON($json_params)) {
            $database = new Database();
            $conn = $database->getConnection();

            $data = json_decode($json_params);


            try {
                foreach ($data->matrix as $i => $object) {
                    $query = 'SELECT planet_id
                                FROM swc.planet_terrain
                                WHERE id = ?;';
                    if ($stmt = $conn->prepare($query)) {

                        $stmt->bind_param("i", $object->id);

                        if ($stmt->execute()) {
                            $stmt->store_result();
                            if ($stmt->num_rows > 0) {
                                while ($stmt->fetch()) {
                                    $message = "same size";
                                    $code = 201;
                                    $response = self::update_terrain(
                                            $object->id,
                                            $object->planet_id,
                                            $object->terrain_coordX,
                                            $object->terrain_coordY,
                                            $object->terrain_have_deposit,
                                            $object->terrain_type_id
                                        );
                                }
                            } else {
                                $message = "Terrain not found";
                                $code = 404;
                                $response = array((object)['message' => $message, 'num_rows' => $stmt->num_rows, 'code' => $code]);
                            }
                        } else {
                            $response = array((object)['message' => "MySQL error.", "error" => $stmt->error, 'sql_code' => $stmt->errno]);
                            header('Content-Type: application/json; charset=utf-8');
                            http_response_code(409);
                            echo json_encode($response);
                            mysqli_stmt_close($stmt);
                        }
                    }
                }

                http_response_code($code);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
            } catch (\Throwable $th) {
                print_r($th);
                $response = array((object)['message' => "MySQL error.", "error" => $stmt->error, 'sql_code' => $stmt->errno]);
                header('Content-Type: application/json; charset=utf-8');
                http_response_code(409);
                echo json_encode($response);
                mysqli_stmt_close($stmt);
            }
        } else {
            http_response_code(400);
        }
    }
    public static function delete_terrain_matrix()
    {
        $helpers = new Helpers();
        $json_params = file_get_contents("php://input");

        if (strlen($json_params) > 0 && $helpers->isValidJSON($json_params)) {
            $database = new Database();
            $conn = $database->getConnection();

            $data = json_decode($json_params);
            $query = 'DELETE FROM swc.planet_terrain WHERE planet_id=?;';
            if ($stmt = $conn->prepare($query)) {
                $stmt->bind_param("i", $data->planet_id);
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
            }
        } else {
            http_response_code(400);
        }
    }
}
