<?php
include "dbconnect.php";

$message = "";
$toastClass = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $organization = $_POST['organization'];
    $country = $_POST['country'];
    $salt = base64_encode(random_bytes(8));
    $passwordhash = crypt($password, '$5$' . $salt . '$'); // Encryption for passwords

    // Check if email is already used
    $checkEmailStmt = $conn->prepare("SELECT email FROM userdata WHERE email = ?");
    $checkEmailStmt->bind_param("s", $email);
    $checkEmailStmt->execute();
    $checkEmailStmt->store_result();

    if ($checkEmailStmt->num_rows > 0) {
        $message = "Email ID already exists";
        $toastClass = "alert-warning"; // Bootstrap class
    } else {
        $stmt = $conn->prepare("INSERT INTO userdata (name, surname, country, organization, email, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name, $surname, $country, $organization, $email, $passwordhash);

        if ($stmt->execute()) {
            $message = "Account created successfully";
            $toastClass = "alert-success"; // Bootstrap class
        } else {
            $message = "Error: " . $stmt->error;
            $toastClass = "alert-danger"; // Bootstrap class
        }
        $stmt->close();

    }


    $checkEmailStmt->close();
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
                        <h3>Register</h3>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col offset-0 m-auto"><input type="text" name="name" id="name" placeholder="Name" required></div>
                </div>
                <div class="row mb-2">
                    <div class="col offset-0 m-auto"><input type="text" name="surname" id="surname" placeholder="Surname" required></div>
                </div>
                <div class="row mb-2">
                    <div class="col offset-0 m-auto"><input type="text" name="organization" id="organization" placeholder="Organization" required></div>
                </div>
                <div class="row mb-2">
                <select class="row mb-2" name="country" id="country">
                     <option value="Estonia">Estonia</option>
                     <option value="Latvia" selected>Latvia</option>
                     <option value="Lithuania">Lithuania</option>
                     <option value="Finland">Finland</option>
                     <option value="Sweden">Sweden</option>
                     <option value="Norway">Norway</option>
                     <option value="Italy">Italy</option>
                     <option value="Poland">Poland</option>
                </select>
                </div>
                <div class="row mb-2">
                    <div class="col offset-0 m-auto"><input type="email" name="email" id="email" placeholder="Email" required></div>
                </div>
                <div class="row mb-2">
                    <div class="col offset-0 m-auto"><input type="password" name="password" id="password" placeholder="Password" required></div>
                </div>
                <div class="row mb-2">
                    <div class="col offset-0 m-auto"><input type="password" name="password2" id="password2" placeholder="Repeat Password" required></div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <div class="btn-group" role="group">
                            <button class="btn btn-secondary" name="login_instead" id="login_instead" type="button" onclick="window.location.href='login.php'" >Login Instead</button>
                            <button class="btn btn-primary" name="register_submit" id="register_submit" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
