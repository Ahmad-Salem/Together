<?php
// function randStrGen($len){
// 	$result = "";
//     $chars = "abcdefghijklmnopqrstuvwxyz0123456789$$$$$$$1111111";
//     $charArray = str_split($chars);
//     for($i = 0; $i < $len; $i++){
// 	    $randItem = array_rand($charArray);
// 	    $result .= "".$charArray[$randItem];
//     }
//     return $result;
// }

  // Original PHP code by Chirp Internet: www.chirp.com.au
  // Please acknowledge use of this code by including this header.

  function cryptPass($input,$round=9)
	{
		$salt="";
		$saltChars=array_merge(range('A','Z'),range('a','z'),range(0,9));

		for($i=0;$i<22;$i++)
		{
			$salt .=$saltChars[array_rand($saltChars)];	
		}

		return crypt($input,sprintf('$2y$%02d$',$round).$salt);
	}

?>