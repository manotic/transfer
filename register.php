<?php
include ('includes/header.php');

if (isset($_POST['register'])) {
    $pass = $_POST['password'];
    $pass2 = $_POST['password2'];

    if ($pass == $pass2) {

        $msg = $user->saveUser();
        
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['role'] = 1;
       
        header("Location:index.php");
    } else {
        $msg = '<div class="alert alert-danger rounded-0 py-1">Password do not match! Please try again</div>';
    }
}
?>
<body>
    <main class="form-signin">
    <form method="POST" class=" row g-3 col-4">
            <h1 class="h3 mb-4 fw-normal"><?php echo $systemName ?></h1>

            <div class="form-group">
                <?php if (isset($msg)) { echo @$msg; } else {}?>
            </div>
            <div class="col-md-6">
                <label for="floatingInput">First name</label>
                <input type="firstname" name="firstname" class="form-control" id="floatingInput" value="<?php echo @$_POST['firstname'] ?>" placeholder="John " required>
            </div>
            
            <div class="col-md-6">
                <label for="floatingInput">Last name</label>
                <input type="lastname" name="lastname" class="form-control" id="floatingInput" value="<?php echo @$_POST['lastname'] ?>" placeholder="Doe" required>
            </div>
            <div class="mb-1">
                <label for="floatingInput">Email address</label>
                <input type="email" name="email" class="form-control" id="floatingInput" value="<?php echo @$_POST['email'] ?>" placeholder="name@example.com" required>
            </div>
            <div class="mb-1">
                <label for="Password">Password</label>
                <input type="password" name="password" class="form-control <?php if (isset($passwordError)) echo "is-invalid" ?>" id="Password" placeholder="Password" required>
            </div>
            <div class="mb-1">
                <label for="Password">Confirm password</label>
                <input type="password" name="password2" class="form-control <?php if (isset($passwordError)) echo "is-invalid" ?>" id="Password" placeholder="Password" required>
                <div class="invalid-feedback">
              <?php if (isset($passwordError)) echo $passwordError; ?>
            </div>
            </div>
            <button class="w-100 btn btn-lg btn-success" type="submit" name="register">Sign Up</button>
            <div class="mt-3">
                <p>Already have an Account? <a href="login.php">Sign In</a></p>
            </div>
            <p class="mt-5 mb-3 text-muted">&copy; <?php echo date('Y'); ?></p>
        </form>
    </main>
</body>
</html>