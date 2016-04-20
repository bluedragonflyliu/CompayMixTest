<?php 
 $url = 'POST_URL'; 
    $fields=array( 
        'a' => 'a', 
        'b'   => 'b', 
    ); 
      
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_POST, count($fields)); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields); 
    ob_start(); 
    curl_exec($ch); 
      
    $result = ob_get_contents(); 
      
    ob_end_clean(); 
    echo $result; 
    curl_close($ch);

?>