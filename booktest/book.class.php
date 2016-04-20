<?php 
class Book implements Nameable{
	
}
$rc = new ReflectionClass('Book');
if($rc->implementsInterface('Nameable')) {
	print "Book implements Nameable<br />";
}
abstract class Database {
	abstract public function connect();
	abstract public function query();
	abstract public function fetch();
	abstract public function close();
}
?>