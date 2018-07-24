<?php require APP_ROOT . "/views/inc/header.php"; ?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>Log In</h2>
            <p>Please in your credentials to log in.</p>
            <form action="<?php echo URL_ROOT; ?>/users/login" method="post">
                <div class="form-group">
                    <label for="email">Email Address: <sup>*</sup></label>
                    <input type="email" name="email"
                           class="form-control form-control-lg
                           <?php echo(!empty ($data["emailError"]) ? "is-invalid" : "") ?>"
                           value="<?php echo $data["email"]; ?>">
                    <span class="invalid-feedback"><?php echo $data["emailError"]; ?> </span>
                </div>
                <div class="form-group">
                    <label for="name">Password: <sup>*</sup></label>
                    <input type="password" name="password"
                           class="form-control form-control-lg
                           <?php echo(!empty ($data["passwordError"]) ? "is-invalid" : "") ?>"
                           value="<?php echo $data["password"]; ?>">
                    <span class="invalid-feedback"><?php echo $data["passwordError"]; ?> </span>
                </div>

                <div class="row">
                    <div class="col">
                        <input type="submit" value="Log In" class="btn btn-success btn-block">
                    </div>

                    <div class="col">
                        <a href="<?php echo URL_ROOT; ?>/user/register" class="btn btn-light btn-block">
                            No account? Register!
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
<?php require APP_ROOT . "/views/inc/footer.php"; ?>
