<?php
class Admin extends SSS
{
	//允许前台通过url直接访问的函数
	protected $actions = ['login','home',"user",'file','vip','vip_order','page','system'];
	protected $noNeedLogin = "*";

	public function __construct()
    {
		parent::__construct();
		//判断是否登录
		if ($this->action != 'login' ) {
			if(!isset($_SESSION['admin_id'])) $this->error('请登录后访问','?a=login');
		}
    }
    protected function home1()
	{
        //判断是否登录
		if (isset($_SESSION['admin_id']) && $_SESSION['admin_id'] > 0) {
			//退出登录
			if (isset($_GET['do']) && $_GET['do'] == 'logout') {
				unset($_SESSION['admin_id']);
				unset($_SESSION['admin']);
				redirect('?a=login');
			}
			if (isset($_GET['do']) &&  strlen($_GET['do']) >= 4) {
				if (is_post() && $_GET['do'] == 'system') {
					foreach ($_POST as $name => $value) {
						$this->db->where("option_name", $name)->update('options', ['option_value' => $value]);
					}
					$this->success('修改成功');
				}
				include(ADMIN_TEMPLATE . "/" . $_GET['do'] . ".php");
			} else {
				include(ADMIN_TEMPLATE . "/base.php");
			}
		} else {
			if (is_post() && $_GET['do'] == 'login') {
				$username = $_POST['username'];
				$password = $_POST['password'];


				$ret = $this->db->where("username", $username)->where("password", md5(md5($password)))->getOne("admin");

				if ($ret) {
					$_SESSION['admin']['id'] = $_SESSION['admin_id'] = $ret['admin_id'];
					$_SESSION['admin']['username'] = $ret['username'];
					$_SESSION['admin']['login_time'] = $ret['login_time'];
					redirect('?do=base');
				} else {
					exit('账号密错误！');
				}
			}
			include(ADMIN_TEMPLATE . "/login.php");
		}
    }
	protected function login()
	{
		if (is_post()) {
			$username = $_POST['username'];
			$password = $_POST['password'];
			$ret = $this->db->where("username", $username)->where("password", md5(md5($password)))->getOne("admin");
			if ($ret) {
				$_SESSION['admin']['id'] = $_SESSION['admin_id'] = $ret['admin_id'];
				$_SESSION['admin']['username'] = $ret['username'];
				$_SESSION['admin']['login_time'] = $ret['login_time'];
				redirect('?a=home');
			} else {
				exit('账号密错误！');
			}
		}
		include(ADMIN_TEMPLATE . "/login.php");
	}
	protected function home()
	{
	    $today = mktime(0,0,0);
		// 今日注册用户
		$today_reg_num = $this->db->where("create_time", $today, ">=")->getValue("user", "count(*)");
		// 总注册用户数
		$reg_num = $this->db->getValue("user", "count(*)");
		
		// 今日登录用户
		$today_login_num = $this->db->where("login_time", $today, ">=")->getValue("user", "count(*)");
		
		// 今日上传文件数
		$today_upload_num = $this->db->where("create_time", $today, ">=")->getValue("file", "count(*)");
		// 总上传文件数
		$upload_num = $this->db->getValue("file", "count(*)");
		// 今日总下载数
		$today_down_num = $this->db->where("create_time", $today, ">=")->getValue("file_downlog", "count(*)");
		// 总下载次数
		$down_num = $this->db->getValue("file_downlog", "count(*)");
		
		include(ADMIN_TEMPLATE . "/home.php");
	}

	protected function user()
	{
		//开始业务处理代码
		$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
		$data = $this->db->orderBy("create_time", "Desc")->arraybuilder()->paginate("user", $page);
		include(ADMIN_TEMPLATE . "/user.php");
	}

	protected function vip_order()
	{
		//开始业务处理代码
		$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
		$data = $this->db->join("user u", "vo.user_id=u.user_id", "LEFT")
							->join("vip v", "vo.vip_id=v.vip_id", "LEFT")
							->orderBy("vo.create_time", "Desc")
							->paginate("vip_order vo", $page,"u.username, v.title, vo.*");
	
							// p($data );
		include(ADMIN_TEMPLATE . "/vip_order.php");
	}

	protected function vip()
	{
		$vip_id = input('vip_id','get', null);
		$op = input('c','get',null);
		if (is_post()){
			$data = [
				'title' => input('title','post'),
				'price' => input('price','post'),
				'expire' => input('expire','post'),
				'introduce' => input('introduce','post'),
			];

			if($op == 'add'){
				if($this->db->insert('vip', $data)){
					$this->success('VIP等级 已经添加成功','?a=vip');
				}else{
					$this->error('操作失败');
				}
			}
			if($op == 'edit'){
				if($this->db->where('vip_id', $vip_id)->update('vip', $data)){
					$this->success('VIP等级 更新成功','?a=vip');
				}else{
					$this->error('操作失败');
				}
			}
			$this->error('未定义操作');
		}else{
			
			if($op){
				if($op == 'edit'){
					$data = $this->db->where('vip_id', $vip_id)->getOne("vip");
				}
			}else{
				$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
				$data = $this->db->paginate("vip", $page);
			}
			include(ADMIN_TEMPLATE . "/vip.php");
		}
	}


	protected function file()
	{
		$op = input('c','get',null);
		if($op){
			$file_id = input('file_id','get') ?: $this->error('file_id参数错误!');
			if($op == 'ban'){
				$this->db->where("file_id", $file_id)->update("file", ['status' => 'ban','expire_time' => time()]);
				$this->success('文件封禁成功');
			}
			if($op == 'unban'){
				$this->db->where("file_id", $file_id)->update("file", ['status' => 'normal','expire_time' => NULL]);
				$this->success('文件解封成功');
			}
			if($op == 'delete'){
				$this->db->where("file_id", $file_id)->update("file", ['status' => 'trash', 'delete_time' => time()]);
				$this->success('文件已移至回收站，30天后自动删除');
			}
			if($op == 'restore'){
				$this->db->where("file_id", $file_id)->update("file", ['status' => 'normal', 'delete_time' => NULL]);
				$this->success('文件已还原');
			}
		}
		


		if (is_post()){
			$file_id = input('file_id','post') ?: $this->error('file_id参数错误!');
			//文件分享封禁
		}else{
			//开始业务处理代码
			$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
			$data = $this->db->join("user u", "f.user_id=u.user_id", "LEFT")->orderBy("f.create_time", "Desc")->paginate("file f", $page,"u.username, f.*");
	
			include(ADMIN_TEMPLATE . "/file.php");
		}
		
	}

	protected function page()
	{
		include(ADMIN_TEMPLATE . "/page.php");
	}


	protected function system()
	{
		if (is_post() && $_GET['a'] == 'system') {
			foreach ($_POST as $name => $value) {
				$this->db->where("option_name", $name)->update('options', ['option_value' => $value]);
			}
			$this->success('修改成功');
		}
		
		$data = $this->db->orderBy("option_id", "asc")->get("options");

		include(ADMIN_TEMPLATE . "/system.php");
	}
}