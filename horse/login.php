<?php
include 'dbconnect.php';

$message = "";
$toastClass = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM userdata WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($db_password);
        $stmt->fetch();

        if (password_verify($password, $db_password)) {
            $message = "Login successful";
            $toastClass = "bg-success";

            session_start();
            $_SESSION['email'] = $email;
            header("Location: main.php");
            exit();
        } else {
            $message = "Incorrect password";
            $toastClass = "bg-danger";
        }
    } else {
        $message = "No users was found with the provided e-mail";
        $toastClass = "bg-warning";
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>HorseScratch</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="assets/css/Header---Apple.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer-.css">
    <link rel="stylesheet" href="assets/css/Pretty-Header-.css">
</head>

<body>
    <div class="mt-5">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="container text-center">

                <?php if($message): ?>
                    <div class="alert <?php echo $toastClass; ?>"><?php echo $message; ?></div>
                <?php endif; ?>

                <div class="row mb-3">
                    <div class="col offset-0 m-auto">
                        <h3>Login</h3>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col offset-0 m-auto"><input type="email" name="email" id="email" placeholder="Email" required></div>
                </div>
                <div class="row mb-2">
                    <div class="col offset-0 m-auto"><input type="password" name="password" id="password" placeholder="Password" required></div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <div class="btn-group" role="group">
                            <button class="btn btn-secondary" type="button" onclick="window.location.href='register.php'" >Register Instead</button>
                            <button class="btn btn-primary" name="login_submit" id="login_submit" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
