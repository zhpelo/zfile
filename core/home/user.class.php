<?php
namespace core\home;
use core\sss\sss;

class user extends sss
{
	//允许前台通过url直接访问的函数
	protected $actions = "*";
	
	//无需登陆的访问函数
	protected $noNeedLogin = ["login","register", "forgetpwd"];

	public function index()
	{
		include(TEMPLATE . "/user/index.php");
	}

	
	public function dashboard()
	{
		$down_count = $this->db->where('up_user_id', get_user_id())->getValue("file_downlog", "count(*)");
		$file_count = $this->db->where('user_id', get_user_id())->getValue("file", "count(*)");
		include(TEMPLATE . "/user/dashboard.php");
	}

	public function profit()
	{
		include(TEMPLATE . "/user/profit.php");
	}

	protected function login()
	{
		if (is_post()) {
			if (!isset($_POST['username']) || strlen($_POST['username']) > 12 || strlen($_POST['username']) < 4) {
				$this->error('用户名不符合规定，请修改');
			}
			if (!isset($_POST['password']) || strlen($_POST['password']) > 24 || strlen($_POST['password']) < 6) {
				$this->error('密码不符合规定，请修改');
			}
			$username = (string)$_POST['username'];
			$password = md5(md5((string)$_POST['password']));
			$ret = $this->db->where("username", $username)->where("password", $password)->getOne("user");
			if ($ret) {
				//开始执行登录操作
				$this->direct($ret['user_id']);
				$this->success('登陆成功',$_SERVER['PHP_SELF'].'?s=user/index');
			} else {
				$this->error('账号或密码错误');
			}
		} else {
			include(TEMPLATE . "/user/login.php");
		}
	}
	protected function direct($user_id)
	{
		$user = $this->db->where("user_id", $user_id)->getOne("user");
		if ($user) {
			//写入数据库
			$this->db->where("user_id", $user_id)->update("user", ['login_time' => time(), 'login_ip' => get_real_ip()]);

			$_SESSION['is_login'] = TRUE;
			$_SESSION['user'] = [
				'user_id' => $user['user_id'],
				'username' => $user['username'],
			];
		}
	}
	protected function register()
	{
		if (is_post()) {
			if (!isset($_POST['username']) || strlen($_POST['username']) > 12 || strlen($_POST['username']) < 4) {
				$this->error('用户名不符合规定，请修改');
			}
			if (!isset($_POST['password']) || strlen($_POST['password']) > 32 || strlen($_POST['password']) < 6) {
				$this->error('密码不符合规定，请修改');
			}
			if (!isset($_POST['email']) || !is_email($_POST['email'])) {
				$this->error('邮箱格式不正确，请修改');
			}
			if (!isset($_POST['code']) || strlen($_POST['code']) != 4) {
				$this->error('验证码不符合规定，请修改');
			}
			if ($_POST['password'] != $_POST['password1']) {
				$this->error('两次输入的密码不一致');
			}

			//验证邮箱验证码
			$ret = $this->db->where("code", $_POST['code'])->where("addressee", $_POST['email'])->getOne("captcha");
            if(!$ret || $ret['is_use'] == 1 || $ret['expire_time'] <= time()){
                $this->error('验证码已过期或已被使用，请重新获取');
            }
			//将验证码设置为已使用
			$this->db->where("id", $ret['id'])->update("captcha", ['is_use' => 1]);

			//开始写入数据库
			$data = [
				"username" 		=> (string)$_POST['username'],
				"nickname" 		=> (string)$_POST['username'],
				"email" 		=> (string)$_POST['email'],
				"password" 		=> md5(md5((string)$_POST['password'])),
				"create_time" 	=> time(),
			];
			$ret = $this->db->where("username", $data['username'])->getOne("user");
			if ($ret) {
				$this->error('此用户名已存在');
			}
			$user_id =  $this->db->insert('user', $data);
			if ($user_id > 0) {
				$this->success('注册成功，请登录', '?a=login');
			} else {
				$this->error('注册失败，请重试');
			}
		} else {
			include(TEMPLATE . "/user/register.php");
		}
	}
	protected function forgetpwd()
	{
		if (is_post()) {

			$email = input('email','post',null,'is_email') ?: $this->error('邮箱格式不正确，请修改');
			$code = input('code','post') ?: $this->error('邮箱验证码不正确');
			$newpassword = input('newpassword','post') ?: $this->error('请填写新密码');

			//验证邮箱验证码
			$ret = $this->db->where("code", $code)
							->where("event", 'forgetpwd')
							->where("addressee", $email)
							->getOne("captcha");

            if(!$ret || $ret['is_use'] == 1 || $ret['expire_time'] <= time()){
                $this->error('验证码已过期或已被使用，请重新获取');
            }
			//将验证码设置为已使用
			$this->db->where("id", $ret['id'])->update("captcha", ['is_use' => 1]);

			$ret = $this->db->where("email", $email)->update("user",['password' => md5(md5( $newpassword )) ]);
			if ( $ret ) {
				$this->success('密码修改成功，请登录', '?a=login');
			} else {
				$this->error('密码修改失败，请重试');
			}
		} else {
			include(TEMPLATE . "/forgetpwd.php");
		}
	}

	//注销登陆
	protected function logout(){
		//退出
		unset($_SESSION['is_login']);
		unset($_SESSION['user']);
		redirect($_SERVER['PHP_SELF'].'?s=user/login');
	}

}
