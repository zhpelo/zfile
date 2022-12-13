<?php
class Api extends SSS
{
    //允许前台通过url直接访问的函数
	protected $actions = ["email",'user'];
    //无需登陆的访问函数
    protected $noNeedLogin = ["email",'user'];
    public function home()
	{
        exit('api url');
    }

    public function email()
	{
        //发送邮件
        if($this->do == 'send'){
            $event = input('event','post') ?: $this->error('event参数错误');

            $addr = input('email','post',null,'is_email') ?: $this->error('email参数错误');
            if($event == 'register'){
                if($this->db->where("email", $addr)->getOne("user")){
                    $this->error('当前邮箱已被使用，请更换其他邮箱');
                }
            }
            if($event == 'forgetpwd'){
                if(!$this->db->where("email", $addr)->getOne("user")){
                    $this->error('此邮箱并未再本站注册');
                }
            }

            $email = new Email();
            if($email->send_code($addr,$event)){
                $this->success('邮件发送成功');  
            }else{
                $this->error('邮件发送失败');
            }
        }
    }


    protected function user()
	{
        if($this->do == 'set_email'){
            if(!isset($_POST['email']) ||  !isset($_POST['code'])){
                $this->error('参数错误1');
            }
            $addr = (string)$_POST['email'];
            if(!is_email($addr)){
                $this->error('参数错误2');
            }



            $code = $_POST['code'];

            $ret = $this->db->where("code", $code)->where("addressee", $addr)->getOne("captcha");

            if(!$ret || $ret['is_use'] == 1 || $ret['expire_time'] <= time()){
                $this->error('验证码已过期或已被使用，请重新获取');
            }
            $this->db->where("id", $ret['id'])->update("captcha", ['is_use' => 1]);

            $this->db->where("user_id", $_SESSION['user']['user_id'])->update("user", ['email' => $addr]);
            $this->success('修改成功',);
        }
    }

    
    /**
     * 操作成功返回的数据
     * @param string $msg    提示信息
     * @param mixed  $data   要返回的数据
     * @param int    $code   错误码，默认为1
     * @param string $type   输出类型
     * @param array  $header 发送的 Header 信息
     */
    protected function success($msg = '', $data = null, $code = 1, $type = null, array $header = [])
    {
        $this->result($msg, $data, $code, $type, $header);
    }

    /**
     * 操作失败返回的数据
     * @param string $msg    提示信息
     * @param mixed  $data   要返回的数据
     * @param int    $code   错误码，默认为0
     * @param string $type   输出类型
     * @param array  $header 发送的 Header 信息
     */
    protected function error($msg = '', $data = null, $code = 0, $type = null, array $header = [])
    {
        $this->result($msg, $data, $code, $type, $header);
    }

    /**
     * 返回封装后的 API 数据到客户端
     * @access protected
     * @param mixed  $msg    提示信息
     * @param mixed  $data   要返回的数据
     * @param int    $code   错误码，默认为0
     * @param string $type   输出类型，支持json/xml/jsonp
     * @param array  $header 发送的 Header 信息
     * @return void
     * @throws HttpResponseException
     */
    protected function result($msg, $data = null, $code = 0, $type = null, array $header = [])
    {
        $result = [
            'code' => $code,
            'msg'  => $msg,
            'time' => $_SERVER["REQUEST_TIME"] ,
            'data' => $data,
        ];
        // 如果未设置类型则自动判断
        $type = $type ? $type : 'json';

        if (isset($header['statuscode'])) {
            http_response_code($header['statuscode']);
            $code = $header['statuscode'];
            unset($header['statuscode']);
        } else {
            http_response_code(200);
            //未设置状态码,根据code值判断
            $code = $code >= 1000 || $code < 200 ? 200 : $code;
        }
        header('Content-Type:application/json; charset=utf-8');
        exit(json_encode($result));
    }
}