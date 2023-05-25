<?php
include 'connection.php';
if (isset($_POST['update'])) {
    $user_id = $_POST['user_id'];
    $user_name = $_POST['name'];
    $user_number = $_POST['number'];
    $user_email = $_POST['email'];

    $check_user = $conn->prepare("SELECT * FROM `users` WHERE id = :user_id Limit 1");
    $check_user->bindParam(':user_id', $user_id);
    $check_user->execute();

    if ($check_user->rowCount() > 0) {
        $update_user = $conn->prepare("UPDATE `users` SET user_email = :email , user_name = :names , user_number = :user_number WHERE id = :user_id");
        $update_user->bindParam(':email', $user_email);
        $update_user->bindParam(':names', $user_name);
        $update_user->bindParam(':user_number', $user_number);
        $update_user->bindParam(':user_id', $user_id);
        $update_user->execute();
        echo '<div class="alert alert-success" role="alert">
                تم تعديل البيانات بنجاح
                </div>';
        header("refresh: 1");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</head>

<body style="background: #eeeeee70;">
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">

                <img src="bootstrap.svg" alt="Logo" width="30" height="24" style="margin-right: 20px;"
                    class="d-inline-block align-text-top">
                Eng-Osama Exercise
            </a>
        </div>
    </nav>

    <?php if (isset($_GET['get_id'])) {
        $get_id = $_GET['get_id'];
        $user_data = $conn->prepare("SELECT * FROM `users` WHERE id = :user_id LIMIT 1");
        $user_data->bindParam(':user_id', $get_id);
        $user_data->execute();
        if ($user_data->rowCount() > 0) {
            $fetch_user = $user_data->fetch(PDO::FETCH_ASSOC);

    ?>
    <div class="container card" style="margin-top: 50px;width: 30rem;">
        <form class="column g-3 needs-validation" method="POST" style="padding:20px" novalidate>
            <input type="hidden" name="user_id" value="<?= $fetch_user['id'] ?>">
            <div class=" mb-3">
                <label for="validationCustom01" class="form-label">User Name</label>
                <input type="text" class="form-control" id="validationCustom01" name="name"
                    value="<?= $fetch_user['user_name'] ?>" required>
                <div class="invalid-feedback">
                    Please Enter User Name
                </div>
            </div>
            <div class="mb-3">
                <label for="validationCustom02" class="form-label">User Number</label>
                <input type="text" class="form-control" id="validationCustom02" name="number"
                    value="<?= $fetch_user['user_number'] ?>" required>
                <div class="invalid-feedback">
                    Please Enter User Number
                </div>
            </div>
            <div class="mb-3">
                <label for="validationCustom03" class="form-label">User Email</label>
                <input type="text" class="form-control" id="validationCustom03" name="email"
                    value="<?= $fetch_user['user_email'] ?>" required>
                <div class="invalid-feedback">
                    Please Enter User Email
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit" name="update">Update User</button>
                <a href="test.php" class="btn btn-primary">Back</a>
            </div>
        </form>
    </div>
    <?php }
    } else {
        $get_id = "";
        header("location: test.php");
    }  ?>
    <script>
    (() => {


        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
    </script>
    <script src=" https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
        integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous">
    </script>
</body>

</html>