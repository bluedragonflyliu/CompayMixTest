<?php 
$users = array('david' => 'fadj&32', 'adam' => '8HEj838');
$realm = 'My website';
$username = pc_validate_digest($realm, $users);
print 'Hello, '.htmlentities($username);
function pc_validate_digest($realm, $users) {
	if (!isset($_SERVER['PHP_AUTH_DIGEST'])) {
		pc_send_digest($realm);
	}
	return $username;
}
function pc_send_digest($realm) {
	header('HTTP/1.0 401 Unauthorized');
	$nonce = md5(uniqid());
	$opaque = md5($realm);
	header("WWW-Authenticate: Digest realm=\" $realm \" qop=\" auth \" "."nonce=\"$nonce\" opaque=\"$opaque\"");
	echo "You need to enter a valid username and password.";
	exit;
}

function pc_parse_digest($digest, $realm, $users) {
	$digest_info = array();
	foreach (array('username', 'uri', 'nonce' , 'cnonce' , 'response') as $part) {
		if (preg_match('/'.$part.'=([\? "]?)(.*?)\1/', $digest, $match)) {
			$digest_info[$part] = $match[2];
		} else {
			return false;
		}
	}
	if (preg_match('/qop=auth(,|$)/', $digest) {
		$digest_info['qop'] = 'auth';
	} else {
		return false;
	}
}

?>