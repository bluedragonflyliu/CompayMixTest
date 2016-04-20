<?php 
class Template
{
	private $arrayConfig = array(
			'suffix' 		=>'.m', //设置模板文件的后缀名
			'templateDir'	=>'./mytemplate/', //设置模板所在的文件夹
			'compileDir' 	=> './cache', // 设置编译后存放的目录
			'cache_htm' 	=> true, //设置是否需要编译成静态的html文件
			'suffix_cache' 	=> '.html', //设置编译文件的后缀
			'cache_time' 	=> 2000,//设置多长时间进行自动更新，单位秒
			'php_turn' 		=> true,
			'cache_control' => 'control.dat',
			'debug' 		=> true,
		);
	public $file; //模板文件名
	private $value = array();
	private $compileTool;
	static private $instance = null;
	public $debug = array();
	private $T_P = array();
	private $T_R = array();
	
	private $controlData = array();

	public function __construct($arrayConfig = array())
	{
		$this->debug['begin'] = microtime(true);
		$this->arrayConfig = $arrayConfig +$this->arrayConfig;
		$this->getPath();
		if(!is_dir($this->arrayConfig['templateDir'])){
			exit("template dir isn't found");
		}
		if(!is_dir($this->arrayConfig['compileDir'])){
			mkdir($this->arrayConfig['compileDir'],0770,true);
		}
		include('./compileclass.php');
	}


	/**
	*路径处理为绝对路径
	*/
	public function getPath()
	{
		$this->arrayConfig['templateDir']=strtr(realpath($this->arrayConfig['templateDir']),'\\','/').'/';
		$this->arrayConfig['compileDir']=strtr(realpath($this->arrayConfig['compileDir']),'\\','/').'/';
	}

	/**
	*取得模板引擎实例
	*@return object
	*@access public
	*@static
	*/

	public static function getInstance()
	{
		if(is_null(self::$instance))
		{
			self::$instance = new Template();
		}
		return self::$instance;
	}

	/*单步设置引擎*/
	public function setConfig($key, $value=null)
	{
		if(is_array($key))
		{
			$this->arrayConfig = $key+$this->arrayConfig;
		} else {
			$this->arrayConfig[$key] = $value;
		}
	}

	/*获得当前模板引擎配置，仅供调试使用*/
	public function getConfig($key = null)
	{
		echo $key;
		if($key)
		{
			return $this->arrayConfig[$key];
		}else{
			return $this->arrayConfig;
		}
	}

	/**
	*注入单个变量
	*
	*@param string $key 模板变量名
	*@param mixed $value 模板变量的值
	*@return void
	*/
	public function assign($key,$value)
	{
		$this->value[$key] = $value;
	}

	/**
	*注入数组变量
	*@param array $array
	*/
	public function assignArray($array)
	{
		if(is_array($array))
		{
			foreach ($array as $k => $v) {
				$this->value[$k]=$v;
			}
		}
	}

	public function path()
	{
		$path=$this->arrayConfig['templateDir'].$this->file.$this->arrayConfig['suffix'];
		return $path;
	}
	/**
	*判断是否开启了缓存
	*/
	public function needCache()
	{
		return $this->arrayConfig['cache_htm'];
	}

	/**
	*是否需要重新生成静态文件
	*@param $file
	*@return bool
	*/
	public function reCache($file)
	{
		$flag = false;
		$cacheFile = $this ->arrayConfig['compileDir'].'/'.md5($file).'.htm';
		if($this->arrayConfig['cache_htm'] ===true)
		{
			$timeFlag = (time()-@filemtime($cacheFile))<$this->arrayConfig['cache_time']?true:false;
			if(is_file($cacheFile)&&filesize($cacheFile)>1&& $timeFlag)
			{
				$flag = true;
			} else {
				$flag = false;
			}
		}
		return $flag;
	}

	/**
	*显示模板
	*@param $file
	*/
	public function show($file)
	{
		$this->file = $file;
		if(!is_file($this->path()))
		{
			exit('找不到对应的模板');
		}
		$compileFile = $this->arrayConfig['compileDir'].'/'.md5($file).'.php';
		$cacheFile = $this->arrayConfig['compileDir'].md5($file).'.htm';
		//var_dump($compileFile);
		//var_dump($this->path());
		if($this->reCache($file)===false)
		{
			$this->debug['cached'] = 'false';
			$this->compileTool = new CompileClass($this->path(),$compileFile,$this->arrayConfig);
			if($this->needCache())
			{
				ob_start();
			}
			extract($this->value, EXTR_OVERWRITE);
		
			if(!is_file($compileFile) || filemtime($compileFile)<filemtime($this->path()))
			{
				$this->compileTool->vars = $this->value;
				$this->compileTool->compile();
				include $compileFile;
			} else {
				include $compileFile;
			}

			if($this->needCache()){
				$message = ob_get_contents();
				file_put_contents($cacheFile, $message);
			}
		}else{
			readfile($cacheFile);
			$this->debug['cached'] = true;
		}
		$this->debug['spend'] = microtime(true)-$this->debug['begin'];
		$this->debug['count'] = count($this->value);
		$this->debug_info();
	}

	public function debug_info()
	{
		if($this->arrayConfig['debug']===true)
		{
			echo '<br />','----------------debug info -----------------<br/ >';
			echo '程序运行日期：',date("Y-m-d h:i:s"),'<br />';
			echo '模板解析耗时：',$this->debug['spend'],'秒<br />';
			echo '模板包含标签数目：', $this->debug['count'].'<br />';
			echo '是否使用静态缓存：',$this->debug['cached'].'<br />';
			echo '模板引擎实例参数：',var_dump($this->getConfig());
		}
	}

	/**
	*清除缓存
	*/
	public function clean($path = null)
	{
		if($path === null)
		{
			$path = $this->arrayConfig['compileDir'];
			$path = glob($path.'*'.$this->arrayConfig['suffix_cache']);
		} else {
			$path = $this->arrayConfig['compileDir'].md5($path).'.htm';
		}
		foreach ((array)$path as $v) {
			unlink($v);
		}
	}
}

?>