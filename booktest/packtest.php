<?php 
	$fp = fopen('./test.text','w');
	$books = array( array('Elmer Gantry', 'Sinclair Lewis', 1927),
					array('The Scarlatti Inheritance', 'Robert Ludlum', 1971),
					array('The Parsifal Mosaic', 'William Styron', 1979)
				);

	foreach ($books as $book) {
		fwrite($fp, pack('A26A15A4', $book[0], $book[1], $book[2]). "\n" );
	}
	foreach ($books as $book) {
		$title 	= str_pad(substr($book[0],0,26),26,'*');
		$author = str_pad(substr($book[1],0,15),15,'*');
		$year 	= str_pad(substr($book[2],0,4), 4,'-');
		fwrite($fp, $title.$author.$year. "\n" );
 	}

 	fclose($fp);
?>