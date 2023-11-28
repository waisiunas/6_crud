<?php require_once './database/connection.php'; ?>

<?php
$name = $email = "";
if (isset($_POST['submit'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);

    if (empty($name)) {
        $error = "Provide your name!";
    } elseif (empty($email)) {
        $error = "Provide your email!";
    } else {
        $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows === 0) {
            $sql = "INSERT INTO `users`(`name`, `email`) VALUES ('$name', '$email')";
            if ($conn->query($sql)) {
                $success = "Magic has been spelled!";
                $name = $email = "";
            } else {
                $error = "Magic has failed to spell!";
            }
        } else {
            $error = "Email already exist!";
        }
    }

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h3>Add User</h3>
                            </div>
                            <div class="col-6 text-end">
                                <a href="./" class="btn btn-outline-primary">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($error)) { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $error ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        }

                        if (isset($success)) { ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo $success ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        }
                        ?>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name ?>" placeholder="Enter your name!">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="<?php echo $email ?>" placeholder="Enter your email!">
                            </div>

                            <div>
                                <input type="submit" class="btn btn-primary" name="submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>