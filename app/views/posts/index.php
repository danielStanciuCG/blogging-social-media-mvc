<?php require APP_ROOT . "/views/inc/header.php"; ?>
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Posts</h1>
        </div>
        <div class="col-md-6">
            <a href="<?php echo URL_ROOT ?>/posts/add" class="btn btn-primary pull-right">
                <i class="fa fa-pencil"></i> Add Post
            </a>
        </div>
    </div>
<?php foreach ($data["posts"] as $post) : ?>
    <div class="card card-body mb-3">
        <h2 class="title"><?php echo $post->title; ?></h2>
        <div class="bg-light p-2 mb-3">
            Written by <?php echo $post->name . " on " . $post->postDate; ?>
        </div>
        <p class="card-text">
            <?php echo $post->body; ?>
        </p>
        <a href="<?php echo URL_ROOT . "/posts/show/" . $post->postId; ?>" class="btn btn-dark">More</a>
    </div>
<?php endforeach; ?>
<?php require APP_ROOT . "/views/inc/footer.php"; ?>