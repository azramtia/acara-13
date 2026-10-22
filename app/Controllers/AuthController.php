<?php

class AuthController
{
    public function loginForm()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if ($username === 'admin' && $password === '12345') {

                $_SESSION['user'] = $username;

                header('Location: ' . BASE_URL . '/dashboard');
                exit;

            } else {

                echo "<p style='color:red;'>Username atau password salah.</p>";
            }
        }

        echo "
        <h1>Login Admin</h1>

        <form method='POST'>
            <label>Username</label><br>
            <input type='text' name='username' required><br><br>

            <label>Password</label><br>
            <input type='password' name='password' required><br><br>

            <button type='submit'>Login</button>
        </form>
        ";
    }

    public function logout()
    {
        session_destroy();

        header('Location: ' . BASE_URL . '/login');
        exit;
    }
}