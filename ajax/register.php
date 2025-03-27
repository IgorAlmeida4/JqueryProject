<?php
session_start();
require_once "../db/config.php";

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (!$username || !$password) {
  echo json_encode(['success' => false, 'message' => 'Fill in all fields']);
  exit;
}

$stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
$stmt->execute([$username]);

if ($stmt->fetch()) {
  echo json_encode(['success' => false, 'message' => 'Username already taken']);
  exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $pdo->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");
$stmt->execute([$username, $hash]);

$_SESSION['user_id'] = $pdo->lastInsertId();
$_SESSION['username'] = $username;

echo json_encode(['success' => true, 'message' => 'Registered successfully']);
