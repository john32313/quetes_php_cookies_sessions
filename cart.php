<?php require 'inc/head.php'; ?>
<?php require 'inc/data/products.php'; ?>
<?php
if (!isset($_SESSION['username'])) {
    header('Location: http://quetes_php_cookies_sessions.test/login.php');
}
if (isset($_GET['remove'])) {
    $_SESSION['cart'] = array_map(function ($var) {
        $ret = null;
        if ($var['id'] !== $_GET['remove']) {
            $ret = $var;
        } else {
            if ($var['qty'] > 1) {
                $tab = ['id' => $var['id'], 'qty' => $var['qty'] - 1];
                $ret = $tab;
            }
        }
        return $ret;
    }, $_SESSION['cart']);
    header('Location: http://quetes_php_cookies_sessions.test/cart.php');
}
// var_dump($_SESSION);
?>
<section class="cookies container-fluid">
    <div class="row">
        <?php
        if (empty($_SESSION['cart'])) {
            echo '<h2>Panier vide</h2>';
        } else {
            foreach ($_SESSION['cart'] as $arrayCookie) {
                $cookie = $catalog[$arrayCookie["id"]];
        ?>
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 mt-2">
                    <figure class="thumbnail text-center">
                        <img src="assets/img/product-<?= $arrayCookie["id"]; ?>.jpg" alt="<?= $cookie['name']; ?>" class="img-responsive">
                        <figcaption class="caption">
                            <h3><?= $cookie['name']; ?></h3>
                            <p><?= $cookie['description']; ?></p>
                            <p>Quantité : <?= $arrayCookie["qty"] ?></p>
                            <a href="?remove=<?= $arrayCookie["id"]; ?>" class="btn btn-primary">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Remove from cart
                            </a>
                        </figcaption>
                    </figure>
                </div>
        <?php }
        } ?>
    </div>
</section>
<?php require 'inc/foot.php'; ?>