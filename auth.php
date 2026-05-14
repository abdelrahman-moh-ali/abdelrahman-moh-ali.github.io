<?php
$pageTitle = "Logging - Radiohead Archive";
include 'includes/db.php';
include 'includes/header.php';

if(isset($_SESSION['role']))
{
    header("Location: index.php");
    exit();
}


$registerError = "";
$loginError = "";
if(isset($_POST['register']))
{
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);

    // sanitize input here
    
    if(empty($username) || empty($email) || empty($password))
    {
        $registerError = "Please fill all fields";
    }
    else
    {
        $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $checkEmailQuery);

        if(mysqli_num_rows($result) > 0)
        {
            $registerError = "Email already exists";
        }
        else
        {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (username,email,password)
            VALUES ('$username', '$email', '$hashedPassword')";

            mysqli_query($conn, $query);

            header("Location: auth.php");
            exit();
        }
    }
}

if(isset($_POST['login']))
{
    $email = filter_input(INPUT_POST, 'login_email', FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['login_password']);

    //samtizie input here

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1)
    {
        $user = mysqli_fetch_assoc($result);
        if(password_verify($password, $user['password']))
        {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            if($user['role'] == 'admin')
            {
                header("Location: dashboard.php");
            }
            else
            {
                header("Location: index.php");
            }
            exit();
        }
        else
        {
            $loginError = "Incorrect password";
        }
    }
    else
    {
        $loginError = "User not found";
    }
}

?>

<main id="auth-page">
    <div id="auth-container">

        <div>
            <div id="auth-buttons">
                <button id="show-login">Login</button>
                <button id="show-register">Register</button>
            </div>
        </div>
        <div>
            <div id="login-form">
                <h2>Login</h2>
                <form id="login-form-element" method="POST">
                    <input type="email" name="login_email" placeholder="Email" required maxlength="100">
                    <input type="password" name="login_password" placeholder="Password" required>
                    <button type="submit" name="login">Login</button>
                </form>
                <p><?php echo $loginError; ?></p>
            </div>

            <div id="register-form" style="display:none;">
                <h2>Register</h2>
                <form id="register-form-element" method="POST">
                    <input type="text" name="username" placeholder="Username" required maxlength="50">
                    <input type="email" name="email" placeholder="Email" required maxlength="100">
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit" name="register">Register</button>
                </form>
                <p><?php echo $registerError; ?></p>
            </div>
        </div>
    </div>
</main>

<?php
include 'includes/footer.php';
?>