<?php
include_once __DIR__ . '/../config/database.php';


class User
{
    static function login($data = [])
    {
        global $conn;
    
        $username = $data['username'];
        $password = $data['password'];
    
        $result = $conn->query("SELECT * FROM user_data WHERE username = '$username'");
        if ($result = $result->fetch_assoc()) {
            $hashedPassword = $result['password'];
            $verify = password_verify($password, $hashedPassword);
            if ($verify) {
                return $result;
            } else {
                return false;
            }
        }
    }
    
    static function register($data = [])
    {
        global $conn;

        $username = $data['username'];
        $password = $data['password'];
        $full_name = $data['full_name'];
        $phone = $data['phone'];
        $email = $data['email'];

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO user_data SET full_name = ?, username = ?, password = ?, phone = ?, email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssss', $full_name, $username, $hashedPassword, $phone, $email);
        $stmt->execute();

        $result = $stmt->affected_rows > 0 ? true : false;
        return $result;
    }

    static function getPassword($username)
    {
        global $conn;
        $sql = "SELECT password FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();

        $result = $stmt->affected_rows > 0 ? true : false;
        return $result;
    }
}
