<?php
require 'Twilio.php';

$account_sid = 'AC68513ea0607fb9e2266cc3d9fd102a4c'; 
$auth_token = '83fface7c02471e8b27228be79d3687d'; 
$client = new Services_Twilio($account_sid, $auth_token); 
 
$client->account->messages->create(array( 
	'To' => "+19204826538", 
	'From' => "+19204826538",
	'Body' => "There is no Spoon!",    
));
?>
