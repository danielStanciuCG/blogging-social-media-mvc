<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css"
          integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/css/style.css">
    <title><?php echo SITE_NAME; ?></title>
</head>
<body>
<?php require APP_ROOT . "/views/inc/navbar.php"; ?>
<?php if (isLoggedIn()) : ?>
    <div class="container">
        <span class="badge badge-secondary mb-3">
            <?php echo $_SESSION["userFirstName"] . "'s Dashboard"; ?>
        </span>
    </div>
<?php endif; ?>
<div class="container">