<?php session_start();
if (isset($_SESSION['user_id']))
    header("Location: board.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>WebChess - Login</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-3.7.1.min.js"></script>
</head>

<body>
    <div id="auth-container">
        <h1>WebChess</h1>

        <div id="message"></div>

        <form id="login-form">
            <h2>Login</h2>
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
            <p>No account? <a href="#" id="show-register">Register here</a></p>
        </form>

        <form id="register-form" style="display:none;">
            <h2>Register</h2>
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Register</button>
            <p>Already have an account? <a href="#" id="show-login">Login here</a></p>
        </form>
    </div>

    <script>
        $("#login-form").submit(function (e) {
            e.preventDefault();
            console.log("Submitting login form...");

            const username = $("#login-username").val().trim();
            const password = $("#login-password").val().trim();

            $.ajax({
                url: "ajax/login.php",
                type: "POST",
                dataType: "json",
                data: {
                    username: username,
                    password: password
                },
                success: function (response) {
                    console.log("Response:", response);
                    if (response.success) {
                        alert("Login successful!");
                        location.reload(); 
                    } else {
                        alert("Login failed: " + response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.log("AJAX error:", error);
                    console.log("Response Text:", xhr.responseText);
                }
            });
        });
    </script>
</body>

</html>
