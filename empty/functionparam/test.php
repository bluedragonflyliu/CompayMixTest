<?php 
	header("Content-type:text/html;charset=utf-8");
	$foo = null;
	if (version_compare(PHP_VERSION, '5.1.2', '>=')) {
	    //SPL autoloading was introduced in PHP 5.1.2
	    if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
	        spl_autoload_register('june_autoloader', true, true);
	    } else {
	        spl_autoload_register('june_autoloader');
	    }
	} else {
	    function __autoload($classname)
	    {
	        june_autoloader($classname);
	    }
	}
	register_shutdown_function('catch_php_error');
	function june_autoloader($class_name){
	    $class = 'core/'.$class_name. '.class.php';
	    require_once($class);
	}
	function catch_php_error(){
		if(empty(error_get_last ())){
			return false;
		} else {
			echo 'sorry that have one bug';
		}
		
	}

    class IoC
    {
        protected static $registry = [];

        public static function bind($name, Callable $resolver)
        {
            static::$registry[$name] = $resolver;
        }

        public static function make($name)
        {
            if (isset(static::$registry[$name])) {
                $resolver = static::$registry[$name];
                return $resolver();
            }
            throw new Exception('Alias does not exist in the IoC registry.');
        }
    }

    IoC::bind('bim', function () {
        return new Bim();
    });
    IoC::bind('bar', function () {
        return new Bar(IoC::make('bim'));
    });
    IoC::bind('foo', function () {
        return new Foo(IoC::make('bar'));
    });


    // 从容器中取得Foo
     $aa = IoC::make('bim');
     var_dump($aa);
     die();
    $foo = IoC::make('foo');
    $foo->doSomething(); // Bim::doSomething|Bar::doSomething|Foo::doSomething
?>