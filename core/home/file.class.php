<?php
namespace core\home;
use core\sss\sss;

class file extends sss
{
	//允许前台通过url直接访问的函数
	protected $actions = "*";
	
	//无需登陆的访问函数
	protected $noNeedLogin = ["login",'index'];

	public function index()
	{
		$parent_id = input('parent_id','get', 0);
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
		include(TEMPLATE . "file/index.php");
	}

	public function folder_add()
	{
		$parent_id = input('parent_id','get', 0);
		if (is_post()) {
			//开始数据验证
			$access_password = input('access_password','post',null);
			if($access_password != null && strlen($access_password) < 4 && strlen($access_password) > 32){
				$this->error('访问密码请设置4-32位');
			}
			$folder_name = input('folder_name','post') ?: $this->error('请输入文件夹名称');
			$ret = $this->db->where("user_id", get_user_id())
							->where("parent_id", $parent_id)
							->where("folder_name", $folder_name)
							->getOne("file_folder");
			if ($ret) {
				$this->error('此文件夹已存在');
			}
			//开始写入数据库
			$data = [
				"parent_id" 	=> $parent_id,
				"user_id"		=> (int)get_user_id(),
				"folder_name"	=> $folder_name,
				"access_password" => $access_password,
				"is_public" 	=> input('is_public','post',0),
				"total_size" 	=> 0,
				"status"		=> "normal",
				"create_time" 	=> time(),
				"update_time" 	=> time(),
			];
			
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
		}else{
			include(TEMPLATE . "file/folder_add.php");
		}
	}

	public function folder_edit()
	{
		$parent_id = input('parent_id','get', 0);
		
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
					$this->error('此目录下已有同名文件夹');
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
		}else{
			include(TEMPLATE . "file/folder_edit.php");
		}
	}

	public function trash()
	{
		$restore = input('restore','get',null);
		if($restore){
			$file_id = input('file_id','get') ?: $this->error('file_id参数错误!');
			$this->db->where("file_id", $file_id)
						->where("user_id", (int)get_user_id())
						->update("file", ['status' => 'normal', 'delete_time' => NULL]);

			$this->success('文件已还原');
		}else{
			$template_data['file'] = $this->db->where("user_id", get_user_id())
												->where("status", 'trash')
												->orderBy("delete_time", "Desc")
												->get("file");

			include(TEMPLATE . "file/trash.php");
		}
	}

	public function upload()
	{
		$parent_id = input('parent_id','get', 0);
		if (is_post()) {
			$md5 = md5_file($_FILES['file']['tmp_name']);
			$extension = pathinfo($_FILES['file']['name'])['extension'];
			// $save_filename = $md5 . '.' . $extension;
			// $save_filepath = 'upload/' . date('Y/m/d/', time());
			$save_filename = $md5;
			$save_filepath = 'upload/file/' . substr($md5, 0, 2) . '/';
			//开始创建文件目录
			zpl_mkdir($save_filepath);
			//移动临时文件到 指定目录
			$ret = move_uploaded_file($_FILES["file"]["tmp_name"], $save_filepath . $save_filename);
			if (!$ret) $this->error('文件上传失败');
			//开始写入数据库
			$data = [
				"user_id"   => (int)get_user_id(),
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
			$file_id =  $this->db->insert('file', $data);

			if ($file_id > 0) {
				echo "ok"; die();
			} else {
			    var_dump($this->db->getLastError());
				$this->error('写入数据库失败，请重试');
			}
		} else {
			include(TEMPLATE . "file/upload.php");
		}
	}

	public function share()
	{
		$alias = input('alias','get') ?: $this->error('alias参数错误');
		$type = input('type','get','file') ?: $this->error('type参数错误');
		$access_password = input('access_password','post', null);

		$data = $this->db->where("alias", $alias)->getOne($type =='file'? 'file':'file_folder');
		if (!$data) $this->error('找不到此文件');

		if ($data['status'] != 'normal') $this->error('此分享链接已经失效！','/');

		// 如果分享的文件有分享密码
		if($data['access_password']){
			//先判断是否
			if(!isset($_SESSION['unlock_file']) || $_SESSION['unlock_file'] != $alias){
				if($access_password == $data['access_password']){
					$_SESSION['unlock_file'] = $alias;
				}else{
					include(TEMPLATE . "/share_password.php");die();
				}
			}
		}
		
		// 验证结束

		if ($type == 'folder') {
			$parent_id = input('parent_id','get') ?:  $data['folder_id'];
			$data['folder'] = $this->db->where("parent_id", $parent_id)
										->where("user_id", $data['user_id'])
										->where("is_public", 1)
										->get("file_folder");
			$data['file'] = $this->db->where("parent_id", $parent_id)
										->where("user_id", $data['user_id'])
										->get("file");
			$web_title = $data['folder_name'].' 文件夹分享';
		} else {
			$web_title = $data['name'];
		}
		
		if (isset($data['expire_time']) && $data['expire_time'] <= time()) {
			$this->error('文件失效');
		}
		if (isset($_GET['c']) && ($_GET['c'] == 'download' || $_GET['c'] == 'vipdownload')) {
			if($_GET['c'] == 'vipdownload' && !is_vip()){
				$this->error('此功能仅限vip用户使用，请先去开通VIP吧！','/index.php?a=vip');
			}
			$file_dir = ROOT . '/' . $data['url'];
			//检查文件是否存在 
			if (!file_exists($file_dir)) {
				$this->error('文件找不到');
			} else {
				//写入下载日志
				$a = $this->db->insert('file_downlog', [
					'file_id' => $data['file_id'],
					'user_id' => get_user_id(),
					'up_user_id' => $data['user_id'],
					'ip' => get_real_ip(),
					'create_time' => time(),
				]);
				$file = fopen($file_dir, "r"); // 打开文件  
				$file_size=filesize($file_dir);
				header("Expires: 0");
				// 输入文件标签  
				Header("Content-type: application/octet-stream");
				Header("Accept-Ranges: bytes");
				// Header("Accept-Length:".$file_size);
				header("Content-Length: ".$file_size);
				Header("Content-Disposition: attachment; filename=" . $data['name']);
				ob_end_clean();//缓冲区结束
				ob_implicit_flush();//强制每当有输出的时候,即刻把输出发送到浏览器
				header('X-Accel-Buffering: no'); // 不缓冲数据
				if(is_vip()){
					//vip用户限速10M
					$buffer= 10240000;
				}else{
					//vip用户限速0.05M
					$buffer= 51200;
				}
				
				$buffer_count=0;
				session_write_close(); //关闭session文件锁
				while(!feof($file)&&$file_size-$buffer_count > 0 ){//循环读取文件数据
					echo fread($file,$buffer);
					$buffer_count += $buffer;
					sleep(1);
				}
				fclose($file);
			}
			return;
		}
		$template_data = $data;
		include(TEMPLATE . "index/index.php");
	}

	//文件编辑
	public function edit(){
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
		include(TEMPLATE . "file/edit.php");
	}

	//文件删除
	public function delete(){
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

	//文件转存
	public function save(){
		if(!is_vip()){
			$this->error('此功能仅限vip用户使用，请先去开通VIP吧！',url('vip/index'));
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
				$this->success('文件已经保存到您的网盘中', url("file/index",["parent_id" => $folder_id]));
			}else{
				$this->error('操作出错，请重试！');
			}
			
		}
		
		$folder =  $this->db->where("user_id", get_user_id())
							->where("parent_id", $parent_id)
							->where("status", 'normal')
							->orderBy("create_time", "Desc")
							->get("file_folder");

		// include(TEMPLATE . "file/delete.php");
	}


	protected function alias($table_name = 'file')
	{
		$unique = FALSE;
		$max_loop = 100;
		$i = 0;
		$alias_length = $this->config['alias_length'];

		while (!$unique) {
			// retry if max attempt reached
			if ($i >= $max_loop) {
				$alias_length++;
				$i = 0;
			}
			$alias = strrand($this->config['alias_string'], $alias_length);
			if (!$this->db->where("alias", $alias)->getOne($table_name)) $unique = TRUE;
			$i++;
		}
		return $alias;
	}

	protected function file()
	{
		$c = input('c','get','index');
		
		
		if ($c == 'edit') {
			
		}

		if($c == 'delete'){
			
			
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
		
		if ($c == 'save') {
			
		}
		include(TEMPLATE . "/file_$c.php");
	}

}
