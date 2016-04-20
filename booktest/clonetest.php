<?php 
class Address {
	protected $city;
	protected $country;

	public function setCity($city) {
		$this->city = $city;

	}
	public function getCity(){
		return $this->city;
	}
	public function setCountry($country) {
		$this->country = $country;
	} 
	public function getCountry() {
		return $this->country;
	}
}
class Person {
	protected $name;
	protected $address;
	private $__data = array();

	public function __construct() {
		$this->address = new Address;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getName(){
		return $this->name;
	}

	public function __get($property) {
		if (isset($this->__data['property'])) {
			return $this->__data['property'];
		} else {
			return false;
		}
	}
	public function __set($property, $value) {
		$this->__data[$property] = $value; 
	}

	public function __call($method, $arguments) {

		$this->address = clone $this->address; //在聚合类中适当 的实现克隆、
		echo '<hr />';
		var_dump($this->address);
		var_dump($arguments);
		var_dump($method);
		echo '<hr />';
		if (method_exists($this->address, $method)) {
			return call_user_func_array(array($this->address, $method), $arguments);
		}
	}
}

$rasmus = new Person;
$rasmus -> setName('Rasmus Lerdorf');
$rasmus -> setCity('Sunnyvale');

$zeev = clone $rasmus;
$zeev->setName('Zeev Suraski');
$zeev->setCity('Tel Aciv');

print $rasmus->getName().'lives in '. $rasmus->getCity().'.<br />';
print $zeev->getName().'lives in'.$zeev->getCity().'.';

