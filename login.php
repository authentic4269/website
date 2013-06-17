<?php
require_once("global_header.php");

session_start();

$error = false;

$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

$password = hash('sha512', $password.LOGIN_SALT);

if($_POST && !empty($username) && !empty($password)) {
	if ($username == LOGIN_USERNAME && $password == LOGIN_PASSWORD) {
		$_SESSION["logged_in"] = true;
		header("Location: brothers_admin.php");
	} else {
		$error = true;
	}
}

?>
<?php

require_once("global_header.php");
?>
<form action="login.php" method="post" id="lform">
	<?php if ($error) { echo "There was an error<br />"; }?>
  <div class="form_field">
    <label for="username">Username: </label>
    <input type="text" name="username" />
  </div>
  <div class="form_field">
    <label for="password">Password: </label>
    <input type="password" name="password" />
  </div>
  <div class="form_field">
    <input type="submit" value="Login" />
  </div>
</form>
<?php

require_once("global_footer.php");

?>
