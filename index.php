<?php require 'inc/data/products.php'; ?>
<?php require 'inc/head.php'; ?>

<?php

if (!isset($_SESSION['username'])) {
    header('Location: http://quetes_php_cookies_sessions.test/login.php');
}

if (isset($_GET['add_to_cart'])) {
    $array = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    $isset = false;
    foreach (array_values($array) as $ind => $value) {
        if ($value['id'] === $_GET['add_to_cart']) {
            $update = ["id" => $value["id"], "qty" => ($value["qty"] + 1)];
            $array[$ind] = $update;
            print_r($_SESSION['cart'][$ind]);
            echo '<br/>';
            $isset = true;
        }
    }
    if (!$isset) {
        $new = ['id' => $_GET['add_to_cart'], 'qty' => 1];
        array_push($array, $new);
    }

    $_SESSION['cart'] = $array;
}
var_dump($_SESSION);
?>

<section class="cookies container-fluid">
    <div class="row">
        <?php foreach ($catalog as $id => $cookie) { ?>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <figure class="thumbnail text-center">
                    <img src="assets/img/product-<?= $id; ?>.jpg" alt="<?= $cookie['name']; ?>" class="img-responsive">
                    <figcaption class="caption">
                        <h3><?= $cookie['name']; ?></h3>
                        <p><?= $cookie['description']; ?></p>
                        <a href="?add_to_cart=<?= $id; ?>" class="btn btn-primary">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add to cart
                        </a>
                    </figcaption>
                </figure>
            </div>
        <?php } ?>
    </div>
</section>
<?php require 'inc/foot.php'; ?>