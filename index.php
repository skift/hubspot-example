<?php
/**
 * Here is a tiny PHP app to show how to interact with the OAuth2 HubSpot library (which probably exists in the language you use if it's not PHP) to get information about a conttact list
 */

@ini_set('display_errors', 1);
@ini_set('error_reporting', E_ALL & ~E_NOTICE);

try {
    session_start();
    $base_link = dirname($_SERVER['PHP_SELF']);
    ?>
    <h1>Welcome to my HubSpot app</h1>
    <ul>
        <li><a href="<?php echo $base_link; ?>/authorize.php">Authorize</a></li>
        <li><a href="<?php echo $base_link; ?>/sign-up.html">Sign Up</a></li>
        <li><a href="<?php echo $base_link; ?>/all.php">See All The Lists</a></li>
    </ul>
    <?php
} catch (Throwable $t) {
    echo 'Eek a bug!';
    exit();
}
