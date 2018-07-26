<?php require APP_ROOT . "/views/inc/header.php"; ?>

<a href="<?php echo URL_ROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>

<h1><?php echo $data["post"]->title; ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
    Written by <?php echo $data["user"]->name . " on " . $data["post"]->created_at; ?>
</div>
<p><?php echo $data["post"]->body; ?></p>

<?php if ($data["user"]->id == $_SESSION["userId"]) : ?>
    <hr>
    <a href="<?php echo URL_ROOT . "/posts/edit/" . $data["post"]->id; ?>" class="btn btn-dark">Edit</a>

    <form class="pull-right" action="<?php echo URL_ROOT . "/posts/delete/" . $data["post"]->id; ?>" method="post">
        <input type="submit" value="Delete" class="btn btn-danger">
    </form>
<?php endif; ?>

<?php require APP_ROOT . "/views/inc/footer.php"; ?>
