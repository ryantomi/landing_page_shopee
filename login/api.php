<?php

   // Mengatur memory_limit
   ini_set('memory_limit', '900M'); // Ganti '256M' dengan nilai yang sesuai jika diperlukan
   
$servername = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "dasboard_db"; // Ganti dengan nama database Anda


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    error_log("Database connection successful");
}


$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        if (isset($_GET["id"])) {
            $id = intval($_GET["id"]);
            getMenu($id);
        } else {
            getMenus();
        }
        break;
    case 'POST':
        createMenu();
        break;
    case 'PUT':
        updateMenu();
        break;
    case 'DELETE':
        deleteMenu();
        break;
    default:
        http_response_code(405);
        echo json_encode(["message" => "Method Not Allowed"]);
        break;
}

function getMenus() {
    global $conn;
    $sql = "SELECT * FROM menus";
    $result = $conn->query($sql);
    $menus = [];
    while ($row = $result->fetch_assoc()) {
        $row['submenus'] = getSubMenus($row['id']);
        $menus[] = $row;
    }
    echo json_encode($menus);
}

function getSubMenus($menu_id) {
    global $conn;
    $sql = "SELECT * FROM submenus WHERE menu_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $menu_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $submenus = [];
    while ($row = $result->fetch_assoc()) {
        $submenus[] = $row;
    }
    $stmt->close();
    return $submenus;
}

function createMenu() {
    global $conn;
    $data = json_decode(file_get_contents("php://input"), true);
    

    error_log(print_r($data, true));


    if (empty($data['title'])) {
        http_response_code(400);
        echo json_encode(["message" => "Title is required."]);
        return;
    }

    $title = $conn->real_escape_string($data['title']);
    $link = $conn->real_escape_string($data['link']);
    
    $sql = "INSERT INTO menus (title, link) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        http_response_code(500);
        echo json_encode(["message" => "Database error: " . $conn->error]);
        return;
    }
    $stmt->bind_param("ss", $title, $link);
    
    if ($stmt->execute()) {
        $menu_id = $stmt->insert_id;
        foreach ($data['subItems'] as $subItem) {
            $subTitle = $conn->real_escape_string($subItem['title']);
            $subLink = $conn->real_escape_string($subItem['link']);
            $stmtSub = $conn->prepare("INSERT INTO submenus (menu_id, title, link) VALUES (?, ?, ?)");
            if ($stmtSub) {
                $stmtSub->bind_param("iss", $menu_id, $subTitle, $subLink);
                $stmtSub->execute();
                $stmtSub->close();
            }
        }
        echo json_encode(["message" => "Menu created successfully."]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Error: " . $conn->error]);
    }
    $stmt->close();
}

function updateMenu() {
    global $conn;
    $data = json_decode(file_get_contents("php://input"), true);
    
    // Validasi input
    if (empty($data['id']) || empty($data['title'])) {
        http_response_code(400);
        echo json_encode(["message" => "ID and Title are required."]);
        return;
    }

    $id = intval($data['id']);
    $title = $conn->real_escape_string($data['title']);
    $link = $conn->real_escape_string($data['link']);
    
    $sql = "UPDATE menus SET title=?, link=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        http_response_code(500);
        echo json_encode(["message" => "Database error: " . $conn->error]);
        return;
    }
    $stmt->bind_param("ssi", $title, $link, $id);
    
    if ($stmt->execute()) {
        $conn->query("DELETE FROM submenus WHERE menu_id = $id");
        foreach ($data['subItems'] as $subItem) {
            $subTitle = $conn->real_escape_string($subItem['title']);
            $subLink = $conn->real_escape_string($subItem['link']);
            $stmtSub = $conn->prepare("INSERT INTO submenus (menu_id, title, link) VALUES (?, ?, ?)");
            if ($stmtSub) {
                $stmtSub->bind_param("iss", $id, $subTitle, $subLink);
                $stmtSub->execute();
                $stmtSub->close();
            }
        }
        echo json_encode(["message" => "Menu updated successfully."]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Error: " . $conn->error]);
    }
    $stmt->close();
}

function deleteMenu() {
    global $conn;
    if (!isset($_GET["id"])) {
        http_response_code(400);
        echo json_encode(["message" => "ID is required."]);
        return;
    }
    
    $id = intval($_GET["id"]);
    $sql = "DELETE FROM menus WHERE id=?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        http_response_code(500);
        echo json_encode(["message" => "Database error: " . $conn->error]);
        return;
    }
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $conn->query("DELETE FROM submenus WHERE menu_id = $id");
        echo json_encode(["message" => "Menu deleted successfully."]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Error: " . $conn->error]);
    }
    $stmt->close();
}

$conn->close();
?>
