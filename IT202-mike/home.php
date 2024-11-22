<?php
require(__DIR__."/partials/nav.php");
?>
<link rel="stylesheet" type="text/css" href="styles.css">
<h1>Home</h1>
<?php
if(is_logged_in()){
    flash("Welcome, " . get_user_email());
}
else{
    flash("You're not logged in");
}

/*if(isset($_SESSION["user"]) && isset($_SESSION["user"]["email"])){
 echo "Welcome, " . $_SESSION["user"]["email"]; 
}
else{
  echo "You're not logged in";
}*/

//shows session info
echo "<pre>" . var_export($_SESSION, true) . "</pre>";
if(has_role('Admin')){
    echo 'admin';
} 
else {
    echo 'not admin';
}

$db = getDB();
        $stmt = $db->prepare("SELECT * from Roles where id=1");
        try {
            $r = $stmt->execute();
            if ($r) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                var_export($user,true);
            }
        } catch (Exception $e) {
            echo "<pre>" . var_export($e, true) . "</pre>";
        }


require(__DIR__."/partials/flash.php");
?>