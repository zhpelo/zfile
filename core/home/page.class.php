<?php
namespace core\home;
use core\sss\sss;

class page extends sss
{
	//允许前台通过url直接访问的函数
	protected $actions = ["index"];
	
	//无需登陆的访问函数
	protected $noNeedLogin = ['index'];

	public function index()
	{
		$page_url = input("page_url", "get") ?: $this->error("请求出错");
		$template_data = $this->db->where("page_url", (string)$_GET['page_url'])
			->orderBy("create_time", "Desc")
			->getOne("page");
		include(TEMPLATE . "page/index.php");
	}

}
