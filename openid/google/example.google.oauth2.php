<?php

# Arvin Castro, arvin@sudocode.netㄎ
# 16 June 2011
# http://sudocode.net/article/430/get-a-users-google-email-address-via-oauth2-in-php

session_name('googleoauth2');
session_start();

require 'class-xhttp-php/class.xhttp.php';

# http://code.google.com/apis/console#access
$client_id = '399785139118.apps.googleusercontent.com';
$client_secret = 'd7v2jLGoBZM7C33chLtiqW6p';
$redirect_uri = 'http://www.zlf168.com/google/example.google.oauth2.php';

# Scope for getting the user's email address https://sites.google.com/site/oauthgoog/Home/emaildisplayscope
$scope = 'https://www.googleapis.com/auth/userinfo#email';
$scope .= ' https://www.googleapis.com/auth/userinfo.profile';

if(isset($_GET['signin'])) {

	# STEP 2:
	# Build URL for OAuth2 authorization
	$url = "https://accounts.google.com/o/oauth2/auth?".http_build_query(array(
		'client_id' => $client_id,
		'scope' => urldecode($scope),
		'redirect_uri' => $redirect_uri,
		'response_type' => 'code'
	));

	# STEP 3:
	# Redirect user to URL for authorization;
	//echo $url;
	header('Location: '.$url, true, 302);
	die();

} elseif(isset($_GET['code'])) {

	# STEP 4:
	# User granted access to us; User is redirected back to our application; code parameter is included

	# STEP 5:
	# Exchange code for access token and secret
	$data = array('post' => array(
		'code' => $_GET['code'],
		'client_id' => $client_id,
		'client_secret' => $client_secret,
		'redirect_uri' => $redirect_uri,
		'grant_type' => 'authorization_code',
	));
	$response = xhttp::fetch('https://accounts.google.com/o/oauth2/token', $data);

	if($response['successful']) {

		# STEP 6:
		# We got the access token; User is now logged in
		$_SESSION['loggedin'] = true;
		$_SESSION = array_merge($_SESSION, $response['json']);

		# Redirect user to remove code parameter in URL, Optional
		header('Location: '.$redirect_uri);
		die();

	} else {

		# STEP 6: Alternate
		# Unable to get access token; repeat STEP 5 or give up
	}

} elseif(isset($_GET['error'])) {

	# STEP 4: Alternate
	# User refused to give access to his email address; Ask feedback, optional; Repeat STEP 1

} elseif(isset($_GET['logout'])) {

	# STEP 10:
	# Log out of session; delete cookies
	$_SESSION = array();
	session_destroy();
	setcookie(session_name(), null, time() - 3600);
}

if(isset($_SESSION['loggedin'])) {

	# STEP 7:
	# Retrieve user's email; Pass access token via the Authorization header field
	$response = xhttp::fetch('https://www.googleapis.com/oauth2/v1/userinfo?alt=json', array(
		'headers' => array(
			'Authorization' => "OAuth $_SESSION[access_token]"
		)));

	if($response['successful']) {
		# STEP 8:
		# We got the user's email
		var_dump($response);


	} else {
		# STEP 8: Alternate
		# Error getting user's email; repeat STEP 7 or Refresh token (not included) or repeat STEP 2 or repeat STEP 1
		echo $response['body'];
	}

	# STEP 9:
	# Provide logout link to discard session
	echo '<br/><a href="?logout">Logout</a>.';

} else {
	# STEP 1: Provide link to user to Sign in with Google
	echo '<a href="?signin">Sign in with Google</a>.';
}

?>