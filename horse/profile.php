<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
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
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/Header---Apple.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer-.css">
    <link rel="stylesheet" href="assets/css/Pretty-Header-.css">
</head>


<body>
    <div></div>
    <nav class="navbar navbar-expand-md fixed-top bg-dark navbar-dark">
        <div class="container"><button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav flex-grow-1 justify-content-between">
                    <li class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-horse-head apple-logo"></i></a></li>
                    <li class="nav-item"><a class="nav-link" href="profile.php" style="color: var(--bs-primary);">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="competitions.php">Competitions</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Notifications</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Settings</a></li>
                    <li class="nav-item"><a class="nav-link" onclick="window.location.href='logout.php'" style="color: rgb(255,106,106);">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>


<body>
    <div class="mt-5">
            <div class="container text-center">
                <div class="row mb-3">
                    <div class="col offset-0 m-auto">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                            <button type="button" onclick="window.location.href='resetpassword.php'" >Reset Password</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>


</html>
