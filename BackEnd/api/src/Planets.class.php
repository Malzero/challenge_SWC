<?php
require_once('Database.class.php');
require_once('Helpers.class.php');

class Planets
{
    //Planets CRUD
    public static function create_planet()
    {
        $helpers = new Helpers();
        $json_params = file_get_contents("php://input");

        if (strlen($json_params) > 0 && $helpers->isValidJSON($json_params)) {
            $database = new Database();
            $conn = $database->getConnection();

            $data = json_decode($json_params);
            $query = 'INSERT INTO swc.planets
                            (name, sizeX, sizeY, sysX, sysY, galX, galY, img_url)
                            VALUES(?, ?, ?, ?, ?, ?, ?, ?);';

            if ($stmt = $conn->prepare($query)) {
                $stmt->bind_param("siiiiiis", $data->name, $data->sizeX, $data->sizeY, $data->sysX, $data->sysY, $data->galX, $data->galY, $data->img_url);
                try {
                    if ($stmt->execute()) {
                        if ($stmt->affected_rows && $stmt->affected_rows >= 1) {
                            $response = array((object)['message' => "Data created", "affected_rows" => $stmt->affected_rows, 'code' => 201]);
                            header('Content-Type: application/json; charset=utf-8');
                            http_response_code(201);
                            echo json_encode($response);
                            mysqli_stmt_close($stmt);
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
                    $response = array((object)['message' => "Error inserting data", "error" => $stmt->error, 'sql_code' => 1062]);
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
    public static function get_planets()
    {
        $helpers = new Helpers();
        $json_params = file_get_contents("php://input");


        if (strlen($json_params) > 0 && $helpers->isValidJSON($json_params)) {
            $database = new Database();
            $conn = $database->getConnection();
            $data = json_decode($json_params);
            $query = 'SELECT
                        swc.planets.id,
                        swc.planets.name,
                        swc.planets.sizeX,
                        swc.planets.sizeY,
                        swc.planets.sysX,
                        swc.planets.sysY,
                        swc.planets.galX,
                        swc.planets.galY,
                        swc.planets.img_url
                        FROM swc.planets
                        WHERE swc.planets.galX = ? AND swc.planets.galY = ?;';
            $response = array();
            if ($stmt = $conn->prepare($query)) {
                $stmt->bind_param("ii", $data->galX, $data->galY);
                if ($stmt->execute()) {
                    $stmt->bind_result($id, $name, $sizeX, $sizeY, $sysX, $sysY, $galX, $galY, $img_url);
                    while ($stmt->fetch()) {
                        array_push(
                            $response,
                            (object)[
                                'id' => $id,
                                'name' => $name,
                                'sizeX' => $sizeX,
                                'sizeY' => $sizeY,
                                'sysX' => $sysX,
                                'sysY' => $sysY,
                                'galX' => $galX,
                                'galY' => $galY,
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
    public static function update_planet()
    {
        $helpers = new Helpers();
        $json_params = file_get_contents("php://input");

        if (strlen($json_params) > 0 && $helpers->isValidJSON($json_params)) {
            $database = new Database();
            $conn = $database->getConnection();

            $data = json_decode($json_params);
            $query = 'UPDATE swc.planets
                            SET name=?,
                            sizeX=?,
                            sizeY=?,
                            sysX=?,
                            sysY=?,
                            galX=?,
                            galY=?,
                            img_url=?
                            WHERE id=?;';

            if ($stmt = $conn->prepare($query)) {
                $stmt->bind_param("siiiiiisi", $data->name, $data->sizeX, $data->sizeY, $data->sysX, $data->sysY, $data->galX, $data->galY, $data->img_url, $data->id);
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
    public static function delete_planet()
    {
        $helpers = new Helpers();
        $json_params = file_get_contents("php://input");

        if (strlen($json_params) > 0 && $helpers->isValidJSON($json_params)) {
            $database = new Database();
            $conn = $database->getConnection();

            $data = json_decode($json_params);
            $query = 'DELETE FROM swc.planets WHERE id=?;';
            if ($stmt = $conn->prepare($query)) {
                $stmt->bind_param("i", $data->id);
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
