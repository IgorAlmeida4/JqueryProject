<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require_once "../db/config.php"; // Make sure this sets up $pdo

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

if (!$user) {
  echo json_encode(["success" => false, "message" => "User not found"]);
  exit;
}

// Debug logs
file_put_contents("debug.txt", "Input password: $password\nHash: {$user['password_hash']}\n", FILE_APPEND);

// Compare password
if (!password_verify($password, $user['password_hash'])) {
  echo json_encode(["success" => false, "message" => "Password incorrect"]);
  exit;
}

// Success!
$_SESSION['user_id'] = $user['id'];
$_SESSION['username'] = $user['username'];
echo json_encode(["success" => true, "message" => "Login successful"]);
exit;
