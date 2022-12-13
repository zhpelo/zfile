<?php
namespace core\sss;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class email extends sss
{
	protected $mail;

	public function __construct()
    {
		parent::__construct();
		$mail = new PHPMailer(true);
		//Server settings
		// $mail->SMTPDebug = SMTP::DEBUG_SERVER;                   //Enable verbose debug output
		$mail->isSMTP();                                            //Send using SMTP
		$mail->Host       = $this->config['mail_smtp_host'];        //Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		$mail->Username   = $this->config['mail_smtp_user'];        //SMTP username
		$mail->Password   = $this->config['mail_smtp_pass'];        //SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;     		//Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
		$mail->Port       = $this->config['mail_smtp_port'];        //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
		
		//Recipients
		$mail->setFrom($this->config['mail_from'], $this->config['sitename']);

		$this->mail = $mail;

	}
    public function send_code($address,$event)
    {
		$this->mail->addAddress($address);               //Name is optional
		//Content
		$this->mail->isHTML(true);                    //Set email format to HTML
		$this->mail->Subject = '【验证码】- '.$this->config['sitename'];
		$code = mt_rand(1000,9999);
		// message
		switch ($event){
			case 'register':
				$message = "<p>您的注册验证码是</p><h1>$code</h1>";
				break;  
			case 'setpwd':
				$message = "<p>您的重置验证码是</p><h1>$code</h1>";
				break;
			case 'setemail':
				$message = "<p>您正在绑定邮箱，验证码是</p><h1>$code</h1>";
				break;
			default:
				$message = "<p>您的验证码是</p><h1>$code</h1>";
		}
		$this->mail->Body = $message;
		
		if($this->mail->send()){
			//写入数据库
			$data = [
				"event" 		=> $event,
				"type"			=> 'email',
				"addressee"		=> $address,
				"code"			=> $code,
				"is_use" 		=> 0,
				"create_time" 	=> time(),
				"expire_time"	=> time() + (10 * 60),  //十分钟内有效
			];
			$this->db->insert('captcha', $data);
		}else{
			return false;
		}
		return true;
    }
}
