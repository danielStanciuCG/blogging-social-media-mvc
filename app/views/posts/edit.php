<?php require APP_ROOT . "/views/inc/header.php"; ?>

<a href="<?php echo URL_ROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<div class="card card-body bg-light mt-5">
    <h2>Edit Post</h2>
    <p>Create a post with this form.</p>
    <form action="<?php echo URL_ROOT . "/posts/edit/" . $data["id"]; ?>" method="post">
        <div class="form-group">
            <label for="title">Title: <sup>*</sup></label>
            <input type="text" name="title"
                   class="form-control form-control-lg
                           <?php echo(!empty ($data["titleError"]) ? "is-invalid" : "") ?>"
                   value="<?php echo $data["title"]; ?>">
            <span class="invalid-feedback"><?php echo $data["titleError"]; ?> </span>
        </div>
        <div class="form-group">
            <label for="body">Body: <sup>*</sup></label>
            <textarea name="body"
                      class="form-control form-control-lg
                           <?php echo(!empty ($data["bodyError"]) ? "is-invalid" : "") ?>">
                <?php echo $data["body"]; ?>
            </textarea>
            <span class="invalid-feedback"><?php echo $data["bodyError"]; ?> </span>
        </div>
        <input type="submit" class="btn btn-success" value="Submit">
    </form>
</div>

<?php require APP_ROOT . "/views/inc/footer.php"; ?>
