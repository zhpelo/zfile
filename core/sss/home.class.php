<?php
class Home extends SSS
{
	//允许前台通过url直接访问的函数
	protected $actions = ["index", "user","dashboard", "vip", "login", "page", "images","trash", "download", "forgetpwd","register", "receive", "upload"];
	
	//无需登陆的访问函数
	protected $noNeedLogin = ["login",'share', "vip", "page","download", "register", "forgetpwd"];

	protected function dashboard()
	{
		$down_count = $this->db->where('up_user_id', get_user_id())->getValue("file_downlog", "count(*)");
		$file_count = $this->db->where('user_id', get_user_id())->getValue("file", "count(*)");
		include(TEMPLATE . "/dashboard.php");
	}

	public function index()
	{
		$op = input('c','get','index');
		$page = input('page','get', 1);
		if ($op == 'index') {
			$data = $this->db->where("status", 'normal')
			->orderBy("create_time", "Desc")
			->paginate("images", $page);
		}elseif($op == 'list'){
			$cat_id = input('cat_id','get') ?: $this->error('参数出错');
			p($cat_id);
		}elseif($op == 'show'){
			$img_id = input('img_id','get') ?: $this->error('参数出错');
			$data = $this->db->where("status", 'normal')->where("img_id", $img_id)->getOne("images");
			$related_data =  $this->db->where("status", 'normal')
										->orderBy("create_time", "Desc")
										->paginate("images", $page);
		}
		
		include(TEMPLATE . "/index/$op.php");
	}


	protected function page()
	{
		$template_data = $this->db->where("page_url", (string)$_GET['page_url'])
			->orderBy("create_time", "Desc")
			->getOne("page");
		// p($template_data);
		include(TEMPLATE . "/page.php");
	}

	protected function user()
	{
		$op = input('c','get','index');
		if ($op) {
			if ($op == 'logout') {
				//退出
				unset($_SESSION['is_login']);
				unset($_SESSION['user']);
				redirect('?a=login');
			}
			if ($op == 'index') {
				if (is_post()) {
					if (!isset($_POST['nickname']) || strlen($_POST['nickname']) > 12 || strlen($_POST['nickname']) < 4) {
						$this->error('用户名不符合规定，请修改');
					}
					if ($_POST['bio'] != '' && (strlen($_POST['bio']) > 24 || strlen($_POST['bio']) < 6)) {
						$this->error('个人简介不符合规定，请修改');
					}
					$nickname = (string)$_POST['nickname'];
					$bio = (string)$_POST['bio'];

					$this->db->where("user_id", get_user_id())->update("user", ['nickname' => $nickname, 'bio' => $bio]);
					$this->success('修改成功',);
				} else {
					$template_data = $this->db->where("user_id", get_user_id())->getOne("user");
				}
			}

			if ($op == 'setpass') {
				if (is_post()) {
					if (!isset($_POST['newpassword']) || strlen($_POST['newpassword']) > 24 || strlen($_POST['newpassword']) < 6) {
						$this->error('新密码不符合规定，请修改');
					}
					if (!isset($_POST['newpassword2']) || $_POST['newpassword2'] != $_POST['newpassword']) {
					}
					$user = $this->db->where("user_id", get_user_id())->getOne("user");
					if ($user['password'] != md5(md5((string)$_POST['oldpassword']))) {
						$this->error('旧密码不正确');
					}
					$this->db->where("user_id", $user['user_id'])->update("user", ['password' => md5(md5((string)$_POST['newpassword']))]);
					$this->success('密码修改成功',);
				}
			}

			if($op  == 'vip_order'){
				$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

				$data = $this->db->join("vip v", "vo.vip_id=v.vip_id", "LEFT")
							->orderBy("vo.create_time", "Desc")
							->paginate("vip_order vo", $page,"v.title viptitle, vo.*");
			}
		}
		include(TEMPLATE . "/user/{$op}.php");
	}

	protected function vip()
	{
		if (isset($_GET['c'])){
			
			//发起支付操作
			if ($_GET['c'] == 'pay') {

				//不登录不允许访问
				if (!isset($_SESSION['is_login']) && !$_SESSION['is_login']) {
					redirect('?a=login');
				}
				$pay_type = $_GET['pay_type'];
				$vip_type = $_GET['vip_type'];
				$a = new Pay();
				$a->vippay($pay_type,$vip_type);
				exit('000');
			}
	
			//支付成功同步回调
			if ($_GET['c'] == 'return') {
				$a = new Pay();
				$a->return();
			}

			//支付成功异步回调
			if ($_GET['c'] == 'notify') {
				$a = new Pay();
				$a->notify();
			}
		}
		include(TEMPLATE . "/vip.php");
	}

	protected function file()
	{
		$c = input('c','get','index');
		if ($c == 'folder_add') {
			if (is_post()) {
				//开始写入数据库
				$data = [
					"parent_id" 	=> (isset($_GET['parent_id']) && $_GET['parent_id']) ? (int)$_GET['parent_id'] : 0,
					"user_id"		=> (int)get_user_id(),
					"folder_name"	=> (string)$_POST['folder_name'],
					"access_password" => (strlen($_POST['access_password']) >= 4) ? (string)$_POST['access_password'] : null,
					"is_public" 	=> (int)$_POST['is_public'] ?: 0,
					"total_size" 	=> 0,
					"status"		=> "normal",
					"create_time" 	=> time(),
					"update_time" 	=> time(),
				];
				$ret = $this->db->where("user_id", $data['user_id'])
					->where("parent_id", $data['parent_id'])
					->where("folder_name", $data['folder_name'])
					->getOne("file_folder");
				if ($ret) {
					$this->error('此文件夹已存在');
				}
				if ($data['is_public']) {
					$data['alias'] = $this->alias('file_folder');
				}
				$folder_id =  $this->db->insert('file_folder', $data);
				if ($folder_id > 0) {
					$this->success('新建文件夹成功');
				} else {
					// echo "Last executed query was ". $this->db->getLastQuery();
					$this->error('新建文件夹失败，请重试');
				}
			}
		}
		if ($c == 'folder_edit') {
			$folder_id = input('folder_id','get') ?: $this->error('参数错误');

			$data = $this->db->where("user_id", get_user_id())
					->where("folder_id", $folder_id)
					->getOne("file_folder");
			if(!$data){
				$this->error('你没有权限操作此文件夹');
			}
			if (is_post()) {
				$folder_name = input('folder_name','post') ?: $this->error('文件目录名称填写有误');
				//判断是否更新了文件夹名称
				if($data['folder_name'] != $folder_name){
					$ret = $this->db->where("user_id", $data['user_id'])
									->where("parent_id", $data['parent_id'])
									->where("folder_name", $folder_name)
									->getOne("file_folder");	
					if ($ret) {
						$this->error('此目录下已有同名文件夹，禁止修改');
					}
				}
				$is_public = input('is_public','post',0);
				$access_password = input('access_password','post',null);
				$updata = [
					"folder_name"	=> $folder_name,
					"access_password" => $access_password ,
					"is_public" 	=> $is_public,
					"update_time" 	=> time(),
				];
				if ($updata['is_public']) {
					$updata['alias'] = $this->alias('file_folder');
				}
				$ret =  $this->db->where('folder_id',$data['folder_id'])->update('file_folder', $updata);
				if ($ret) {
					$this->success('文件夹修改成功');
				} else {
					$this->error('文件夹修改失败，请重试');
				}
			}
		}
		if ($c == 'edit') {
			$file_id = input('file_id','get') ?: $this->error('file_id参数错误');
			$data = $this->db->where("user_id", get_user_id())
					->where("file_id", $file_id)
					->getOne("file");
			if(!$data){
				$this->error('你没有权限操作此文件');
			}
			if (is_post()) {
				$name = input('name','post') ?: $this->error('文件名称填写有误');
				$access_password = input('access_password','post',null);
				//判断是否更新了文件夹名称
				if($data['name'] != $name){
					$ret = $this->db->where("user_id", $data['user_id'])
									->where("parent_id", $data['parent_id'])
									->where("name", $name)
									->getOne("file");	
					if ($ret) {
						$this->error('此目录下已有同名文件，禁止修改');
					}
				}
				$updata = [
					"name"	=> $name,
					"access_password" => $access_password ,
					"update_time" 	=> time(),
				];
				$ret =  $this->db->where('file_id',$data['file_id'])->update('file', $updata);
				if ($ret) {
					$this->success('文件修改成功');
				} else {
					$this->error('文件修改失败，请重试');
				}
			}
		}

		if($c == 'delete'){
			
			if (isset($_GET['file_id']) && $_GET['file_id'] > 0) {
				$key = 'file_id';
				$id = (int)$_GET['file_id'];
				$table_name = 'file';
			} else if (isset($_GET['folder_id']) && $_GET['folder_id'] > 0) {
				$key = 'folder_id';
				$id = (int)$_GET['folder_id'];
				$table_name = 'file_folder';
			} else {
				$this->error('参数错误');
			}
			$ret = $this->db->where("user_id", get_user_id())
				->where($key, $id)
				->getOne($table_name);
			if (!$ret) {
				$this->error('id参数错误');
			}
			$this->db->where("user_id", get_user_id())->where($key, $id);
			if ( $this->db->update($table_name, ['status' => 'trash', 'delete_time' => time()]) ) {
				$this->success('文件已移至回收站，30天后自动删除');
			} else {
				$this->error('删除失败，请稍后重试');
			}
		}
		//永久删除
		if ($c == 'yongyou_delete') {
			if (isset($_GET['file_id']) && $_GET['file_id'] > 0) {
				$key = 'file_id';
				$id = (int)$_GET['file_id'];
				$table_name = 'file';
			} else if (isset($_GET['folder_id']) && $_GET['folder_id'] > 0) {
				$key = 'folder_id';
				$id = (int)$_GET['folder_id'];
				$table_name = 'file_folder';
			} else {
				$this->error('参数错误');
			}
			$ret = $this->db->where("user_id", get_user_id())
				->where($key, $id)
				->getOne($table_name);
			if (!$ret) {
				$this->error('id参数错误');
			}
			$this->db->where("user_id", get_user_id())->where($key, $id);
			if ($this->db->delete($table_name)) {
				// if(1){
				//开始删除文件
				if ($table_name == 'file') {
					if (!$this->db->where('md5', $ret['md5'])->getOne($table_name)) {
						zpl_unlink($ret['url']);
					}
				}
				$this->success('删除成功');
			} else {
				$this->error('删除失败，请稍后重试');
			}
		}
		if ($c == 'index') {
			$parent_id = (isset($_GET['parent_id']) && $_GET['parent_id'] > 0) ? (int)$_GET['parent_id'] : 0;
			$template_data['folder'] = $this->db->where("user_id", get_user_id())
				->where("parent_id", $parent_id)
				->where("status", 'normal')
				->orderBy("create_time", "Desc")
				->get("file_folder");

			$template_data['file'] = $this->db->where("user_id", get_user_id())
				->where("parent_id", $parent_id)
				->where("status", 'normal')
				->orderBy("create_time", "Desc")
				->get("file");
		}
		if ($c == 'save') {
			if(!is_vip()){
				$this->error('此功能仅限vip用户使用，请先去开通VIP吧！','/index.php?a=vip');
			}
			$parent_id = input('parent_id','get',0);

			$alias = input('alias','get')?: $this->error('alias 参数错误');
			$file = $this->db->where("alias", $alias)
									->where("status", 'normal')
									->getOne("file");
			if($file['user_id'] == get_user_id()){
				$this->error('不能保存自己分享的文件');
			}
			$folder_id = input('folder_id','get',null);
			if($folder_id != null){

				//判断这个文件夹id是否属于当前用户
				if($folder_id >0){
					$folder =  $this->db->where("user_id", get_user_id())
										->where("folder_id", $folder_id)
										->where("status", 'normal')
										->getOne("file_folder");
					if(!$folder){
						$this->error('当前操作不合法！');
					}
				}
				
				$is_exist = $this->db->where("name", $file['name'])
									->where("parent_id", $folder_id)
									->where("status", 'normal')
									->getOne("file");
				if($is_exist){
					$this->error('此目录下，已经存在同名文件，请更换到其他目录');
				}
				//开始保存文件
				unset($file['file_id']);
				$file['user_id'] = get_user_id();
				$file['create_time'] = $file['update_time'] = time();
				$file['expire_time'] = $file['delete_time'] = NULL;
				$file['alias'] = $this->alias();
				$file['parent_id'] = $folder_id;
				if($this->db->insert('file', $file)){
					$this->success('文件已经保存到您的网盘中',"/index.php?a=file&c=index&parent_id={$folder_id}");
				}else{
					$this->error('操作出错，请重试！');
				}
				
			}
			
			$folder =  $this->db->where("user_id", get_user_id())
								->where("parent_id", $parent_id)
								->where("status", 'normal')
								->orderBy("create_time", "Desc")
								->get("file_folder");
		}
		include(TEMPLATE . "/file_$c.php");
	}

	protected function images()
	{
		$op = input('c','get','index');
		
		if ($op == 'index') {
			$data = $this->db->where("user_id", get_user_id())
				->where("status", 'normal')
				->orderBy("create_time", "Desc")
				->get("images");
			
		}elseif($op == 'add'){
			if (is_post()) {
				$title = input('title','post') ?: $this->error('title参数错误');
				$tag = input('tag','post') ?: $this->error('tag参数错误');
				$intro = input('intro','post') ?: $this->error('intro参数错误');

				$md5 = md5_file($_FILES['file']['tmp_name']);
				$extension = pathinfo($_FILES['file']['name'])['extension'];
				$save_filename = $md5 . '.' . $extension;
				$save_filepath = 'upload/' . substr($md5, 0, 2) . '/';
				//开始创建文件目录
				zpl_mkdir($save_filepath);
				//移动临时文件到 指定目录
				$ret = move_uploaded_file($_FILES["file"]["tmp_name"], $save_filepath . $save_filename);
				if (!$ret) $this->error('文件上传失败');

				//开始写入数据库
				$data = [
					"cat_id"	=> 1,
					"user_id"   => get_user_id(),
					"title" 	=> $title,
					"md5"		=> $md5,
					"tag"		=> $tag,
					"intro"		=> $intro,
					"filesize"	=> $_FILES["file"]["size"],
					"picurl"	=> $save_filepath . $save_filename,
					"create_time" => time(),
					"update_time" => time(),
					"status" => 'normal',
				];
				$img_id =  $this->db->insert('images', $data);
				// p( $this->db->getLastQuery());
				if ($img_id > 0) {
					$this->success('壁纸上传成功','/index.php?a=images&c=index');
				} else {
					$this->error('文件上传失败，请重试');
				}

			}
		}elseif($op == 'edit'){
			
		}
		include(TEMPLATE . "/images/$op.php");
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
				$this->success('登陆成功','/index.php?a=user&c=index');
			} else {
				$this->error('账号或密码错误');
			}
		} else {
			include(TEMPLATE . "/login.php");
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
			include(TEMPLATE . "/register.php");
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
	protected function upload()
	{
		if (is_post()) {
			$parent_id = input('parent_id','get',0);
			$md5 = md5_file($_FILES['file']['tmp_name']);
			$extension = pathinfo($_FILES['file']['name'])['extension'];
			// $save_filename = $md5 . '.' . $extension;
			// $save_filepath = 'upload/' . date('Y/m/d/', time());
			$save_filename = $md5;
			$save_filepath = 'upload/' . substr($md5, 0, 2) . '/';

			//开始创建文件目录
			zpl_mkdir($save_filepath);
			//移动临时文件到 指定目录
			$ret = move_uploaded_file($_FILES["file"]["tmp_name"], $save_filepath . $save_filename);
			if (!$ret) $this->error('文件上传失败');
			//开始写入数据库
			$data = [
				"user_id"   => 0,
				"parent_id" => $parent_id,
				"name" 		=> $_FILES["file"]["name"],
				"md5"		=> $md5,
				"alias"		=> $this->alias(),
				"suffix"	=> $extension,
				"size"	=> $_FILES["file"]["size"],
				"url"	=> $save_filepath . $save_filename,
				"create_time" 	=> time(),
				"expire_time" => NULL,
			];
			if (isset($_SESSION['is_login']) && $_SESSION['is_login']) {
				$data['user_id'] = (int)get_user_id();
			}
			$file_id =  $this->db->insert('file', $data);
			if ($file_id > 0) {
				if (isset($_GET['c']) && $_GET['c'] == 'folder') {
					exit('ok');
				}
				include(TEMPLATE . "/upload_success.php");
			} else {
				$this->error('文件上传失败，请重试');
			}
		} else {
			redirect('?do=home');
		}
	}


}
