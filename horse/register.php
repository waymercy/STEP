<?php

// Max: The register page. Users are able to create their accounts here.

include "dbconnect.php";

$message = "";
$toastClass = "";

// Max: PHP tracks the values inserted in text box. Every html textbox has an id that PHP ...
// is able to read, grabbing the values directly.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $organization = $_POST['organization'];
    $country = $_POST['country'];
    $salt = base64_encode(random_bytes(8));
    $passwordhash = crypt($password, '$5$' . $salt . '$'); // Max: Encryption for passwords.
                                                           // The process of creating a hash protected password is simple:
                                                           // 1. User inserts their password as a plain text, it goes to the variable "$password"
                                                           // 2. Variable "$passwordhash" takes the variable "$password" and stores inside itself.
                                                           // 3. Variable "$passwordhash" transforms password into an enhanced hash via the "crypt" command.
                                                           // 4. Send $passwordhash as the user's password to the database instead of $password


    // Check if email is already being used

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
    <title>S.T.E.P.</title>
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

             <!-- Max: This is a bad implementation of a list, it could be easily bypassed by changing the webpage's html code in a browser.
             Any text/value could be inserted by the user so be aware of this, it should be changed. I did not have time to implement a better solution.
             You could create a mySQL table with the list of the same countries, the webpage will take them from there so user would not be able to parse something that is not on the list.
             -->

                <select class="row mb-2" name="country" id="country">
                     <option value="Estonia">Estonia</option>
                     <option value="Latvia">Latvia</option>
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
