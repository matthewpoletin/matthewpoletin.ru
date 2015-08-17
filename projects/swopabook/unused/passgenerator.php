<?php
	function f_passw_generator($count_char=8) {
	      $mass =
	      array('a','b','c','d','e','f','g','h','i','j','k','l',
	      'm','n','o','p','q','r','s','t','u','v','w','x','y','z',
	      'A','B','C','D','E','F','G','H','I','J','K','L',
	      'M','N','O','P','Q','R','S','T','U','V', 'W',
	      'X','Y','Z','1','2','3','4','5','6','7','8','9','0');
	      $passw = '';
	      $count = count($mass)-1;
	      for ($i=0; $i<$count_char; $i++) {
	         $passw .= $mass[mt_rand(0, $count)];
	      }
	      return $passw;
	   }
	echo f_passw_generator(10);
?>