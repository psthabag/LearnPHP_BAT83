<?php 
ob_start();
session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/style.css">
    <link rel="icon" href="images/icon.png" type="image/icon type">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* Reset basic styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .login-container {
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 400px;
        }

        .login-form h2 {
            color: #333333;
            margin-bottom: 8px;
            font-size: 28px;
        }

        .login-form p {
            color: #666666;
            font-size: 14px;
            margin-bottom: 24px;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .input-group label {
            display: block;
            color: #444444;
            font-size: 14px;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .input-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #cccccc;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .input-group input:focus {
            border-color: #764ba2;
            outline: none;
            box-shadow: 0 0 0 3px rgba(118, 75, 162, 0.2);
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            margin-bottom: 24px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #555555;
            cursor: pointer;
        }

        .forgot-password {
            color: #764ba2;
            text-decoration: none;
            font-weight: 500;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            background-color: #764ba2;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .login-btn:hover {
            background-color: #5a377d;
        }

        .signup-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .signup-link a {
            color: #764ba2;
            text-decoration: none;
            font-weight: 600;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container p-4">
        <form class="login-form" method="POST" action="#">
            <h2>Welcome</h2>
            <p>Please enter your details to sign in.</p>

            <div class="input-group">
                <label for="username">Username or Email</label>
                <input type="text" id="username" name="username" placeholder="Enter your email" required>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <div class="form-actions">
                <label class="remember-me">
                    <input type="checkbox"> Remember me
                </label>
                <a href="#" class="forgot-password">Forgot password?</a>
            </div>
            <input type="submit" name="submit" class="login-btn">
        </form>
        <?php
        include_once('data/connect.php');
            if(isset($_POST['submit']))
            {
                $username=$_POST['username'];
                $passwords=$_POST['password'];
                
                //From database
                $sql="SELECT passwords FROM users WHERE usermail='$username'";
                //echo $sql;
                $res=mysqli_query($conn, $sql);
                $row=mysqli_fetch_array($res);

                $db_passwords=$row[0];

                if(password_verify($passwords,$db_passwords))
                {
                    $_SESSION['user']=$username;
                    header('Location:index.php');
        ?>
                <div class="alert alert-success mt-2 mb-0 p-2">
                    Login Successful.
                </div>
        <?php
                }
                else
                {
        ?>
                <div class="alert alert-danger mt-2 mb-0 p-2">
                    Credintial mismatched.
                </div>
        <?php
                }
            }
        ?>
        <p class="signup-link">Don't have an account? <a href="signup.php">Sign up</a></p>
    </div>
</body>
</html>