<!DOCTYPE html>
<html lang="eng">
<link rel="stylesheet" type="text/css" href="/assets/css/styles.css">
<head>
    <title><?= $header ?></title>
</head>
<body>
<nav class="navbar">
    <div>
        <a class="link" href="/">Main page</a>
    </div>
    <div>
        <?php if ($_SESSION['user']) {?>
        <a class="link" href="">User Info</a>
        <a class="link" href="/users/logout">Logout</a>
        <?php } else { ?>
        <a class="link" href="/users/register">Registration</a>
        <a class="link" href="/users/login">Login</a>
        <?php } ?>
    </div>
</nav>
<?= $body ?>
</body>
</html>