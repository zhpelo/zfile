<?php
namespace core\home;
use core\sss\sss;

class index extends sss
{
	//允许前台通过url直接访问的函数
	protected $actions = ["index"];
	
	//无需登陆的访问函数
	protected $noNeedLogin = ["login",'index'];

	public function index()
	{
		include(TEMPLATE . "index/index.php");
	}

}
