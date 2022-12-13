<?php
namespace core\home;


use Alipay\EasySDK\Kernel\Factory;
use Alipay\EasySDK\Payment\Common\Client;
use Alipay\EasySDK\Kernel\Util\ResponseChecker;
use Alipay\EasySDK\Kernel\Config;
use core\sss\sss;

class vip extends sss
{
	//允许前台通过url直接访问的函数
	protected $actions = "*";
	
	//无需登陆的访问函数
	protected $noNeedLogin = ['index'];

	public function index()
	{
		//获取VIP种类数据
		$data = $this->db->where('status','on')->get('vip');
		
		include(TEMPLATE . "vip/index.php");
	}

	public function pay()
	{
        $pay_type = input('pay_type','get', "alipay");
        $vip_type = input('vip_type','get', 1);
        $order_id = input('order_id','get',null);
        if(!$order_id){
           
            if($vip_type == 1){
                //判断是否已经购买过体验VIP
                $Experienced = $this->db->where('vip_id',$vip_type)
                                        ->where('user_id',get_user_id())
                                        ->where('status','paid')
                                        ->getOne('vip_order');
                if($Experienced){
                    $this->error("您已经购买过体验VIP了，不能重复购买！");
                }
            }
            $vip = $this->db->where('vip_id',$vip_type)->getOne('vip');
            if(!$vip || $vip['status'] == "off"){
                $this->error("抱歉，此vip种类已经下架！");
            }
            //创建支付订单
            $order_data = [
                "user_id"   => get_user_id(),
                'title'     => $vip['title'].'-裂变网盘',
                'vip_id'    => $vip_type,
                'price'     => $vip['price'],
                'pay_type'  => $pay_type,
                'create_time' => time(),
                'status'    => 'unpaid'
            ];
            $order_id =  $this->db->insert('vip_order', $order_data);
        }else{
            $order_data = $this->db->where("order_id",$order_id)->getOne('vip_order');
            if($order_data['user_id'] != get_user_id()){
                $this->error("您无权操作此订单");
            }
        }

		
        if($pay_type == 'alipay'){
            // $_SERVER['REQUEST_SCHEME']
            $notify_url = 'http://'.$_SERVER['HTTP_HOST'].url('vip/notify',["pay_type" => "alipay"]);
			$return_url = 'http://'.$_SERVER['HTTP_HOST'].url('vip/return',["pay_type" => "alipay"]);
            
			Factory::setOptions(getOptions());
            $result = Factory::payment()->page()
                ->asyncNotify($notify_url)
                ->pay($order_data['title'], $order_id, $order_data['price'], $return_url);
            echo $result->body; die();
        }else{
            $this->error("暂时仅支持支付宝支付");
        }
	}

	//支付成功同步回调
	public function return()
	{
		$this->success('恭喜您，支付完成', url("vip/order"));
	}

	//支付成功异步回调
	public function notify()
	{
		Factory::setOptions(getOptions());
		$verify_result = Factory::payment()->common()->verifyNotify($_POST);
        if($verify_result) {
            //验证成功
            $out_trade_no = $_POST['out_trade_no'];
            $order = $this->db->where('order_id ', $out_trade_no)->getOne("vip_order");
            if($order['status'] == 'unpaid'){
                //更改订单状态
                $this->db->where('order_id ', $out_trade_no)->update('vip_order', ["status"=>"paid", "pay_time" => time()]);
                $vip = $this->db->where('vip_id ', $order['vip_id'])->getOne("vip");
                //变更用户VIP组
                $this->db->where('user_id', $order['user_id'])->update('user', [ "vip_id"=>$order['vip_id'], "vip_time" => strtotime($vip['expire'])]);
            }
            echo 'SUCCESS'; die();
        }else{
			echo 'ERROR'; die();
        }
	}

	public function order()
	{
		$page = input('page','get',1);

		$data = $this->db->join("vip v", "vo.vip_id=v.vip_id", "LEFT")
                    ->Where("vo.user_id", get_user_id())
					->orderBy("vo.create_time", "Desc")
					->paginate("vip_order vo", $page,"v.title viptitle, vo.*");

		include(TEMPLATE . "vip/order.php");
	}

}


function getOptions()
{
    $options = new Config();
    $options->protocol = 'https';
    $options->gatewayHost = 'openapi.alipay.com';
    $options->signType = 'RSA2';
    $options->appId = '2018010401584520';
    // 为避免私钥随源码泄露，推荐从文件中读取私钥字符串而不是写入源码中
    $options->merchantPrivateKey = 'MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQCCwHKNC8cZCt4nqfH+gUqxUHMmEpfwfyQ+2PPWMEVw8+zOfizFWLn9ajocC2XVCnIOkiTVB2bzbrp+TARu1Q+vITKzfsv0oGVKb4RIEo0fAAeYCKsKAUTEjMLXoPE8jxc5mxbMn1D1i+O8pq6p21QaDe/mMFcwyqxEUYu4Gd83o94XcCZrTvEJXo+T4prddeAD/095DBoJSr/x8TJ5KWUdyS2k6pzQOcOnmbU+MkCC2MU+D8wCUapJa/pDOYHjqVPBM3zhFkSUjubPrhcDkAs3bGx2twMEx5Zf1zBYm4DIk9eoLejRv31vM17aJeqFxiGoEtlRx1Tpb/5LELw960jlAgMBAAECggEAAjsCOUHALb8vtwGBLVRLT+cNb9LVYLbqiV/uGPNN2/VtTsB8RwmScq5DO4M+Q3ogI/t+QVwU94YmDE2DrdhYoiYw1TsOg6fQ0opAeXJHkgXQG1nagRswbyHvmPoX426VeNgadXcqTGYMhoVZaXBiaOdf9k9QzXZHpgq2FXfrhOlycl4x2MpqnY09rMQRxJC+eWj8H9L/V0mtkjvU0iKavtEqZnu7Ubk9u0JCIya4g0cv9p8hilLnAiwyYkgjngQxVFo4lLvPEFfIUeOnfYQINPP5ph4DnN3+Vbmdpb6Se4fk0r+r0Drt5p6EHEHs5RunHhjWRWa/zGR1X+/d35tu6QKBgQDMuBMceJw80vir1v9Knk4MKg+ONtoBN1joe/Q2rLFoZMN3leHQp+yesrJZbsR5Foy2Nc/ZAG6tjsDaBiH6wK3v7a92ZR7eDTAIfXNDDHAlvHEAA1k+tXHrg0TIOBOIg2qw6ez25QoA3KS/mlpqHKf/nQVuiPI/ZOK3Gd5UD2bG2wKBgQCjgRsLGKYEXOZLsX9bF6dcSc2DtOMPmHdelFm1R8qtK4hovmcuvmJV2A33MbGiVBgGX+16sESvi640R4FXA+JaFZCibiNpPecwXw8BflUVVzgxz35YB4Zk26rShTtwO3UXe7x3Nrp+gfmeJ/kIpXFuHzaMnndiptcQJXavvnnbPwKBgQCiP7190iVZm4dUgghBNmf7AhbkCpsLXbdMQnlSH9pXN40nqRWYjo5dVJk/giebJIEPJGT/wnT1fu9fnH6vwqfYQVPQDOLC8EbCY9LHMANuFQSmEwFXTuzj0FziJndsuWMEpdGV9/7OohC8fnPsJ5wKXYNhkI4WKjn5DjqD+tTlAwKBgQCOBrfXC7IqWAgz+BsIpaNbJ0C+B4K1KVuHbJYAQjxr8EStt7cpg3cn2mVHNIN43lOANhOzXypK0qqf/vz6+QTF+7WHYuSfpoYMHoaKZZLC1uCZZAP7s42qTqYz+EeJVhyAKZuscn3NJloOZ+qK+Ctv3O0leQF7UDHAdMqEHpD7QQKBgBRUzBxmtBYXlSKjjDKIFCT93IiGVame8egm38f9QKMTqausZjOqszu3/HPrqMIW5AFtEvS/xPsvwUdsI0iNn+Zvvurs5JzQuPX0hvxjNEgpt0vJ9iZDTJBbAfpW5izlztoDxDD3R1xyyif1nsC27xzNWSvOQmiUwjl3OvTb49gq';
    
    // $options->alipayCertPath = '<-- 请填写您的支付宝公钥证书文件路径，例如：/foo/alipayCertPublicKey_RSA2.crt -->';
    // $options->alipayRootCertPath = '<-- 请填写您的支付宝根证书文件路径，例如：/foo/alipayRootCert.crt" -->';
    // $options->merchantCertPath = '<-- 请填写您的应用公钥证书文件路径，例如：/foo/appCertPublicKey_2019051064521003.crt -->';
    
    //注：如果采用非证书模式，则无需赋值上面的三个证书路径，改为赋值如下的支付宝公钥字符串即可
    $options->alipayPublicKey = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAhIT7hbrAbt/QqO3njhjZyNikVvcmX/PxcJ34TLX4X+60XL4RIO2/9okqt5tL9W9wVq9oP10aXrt0Gn24PPjyua3zrQpjGAoyp5pW9YUIgz70GuUBpywhRMWIQMqpohApzwibVDeH0+Fic6aR2jp3AyFUf8FXkwgYcBLbw53tEPzBUGjW/KuyoUOEV9Q036jDIfbx6JW98EBXXIxR2m2eL1ME0ACj9IDhF6s0AMQstfcF0nqWlXi0lwoJ7a/hX1dz3ZJyWguu4raN+s2fhf8uQY/SdesFm9jhysjBzqC6XOE3tklPgfkWale8m6gBbxYXGKPB/IANVspw0tIJBi1MswIDAQAB';
    //可设置异步通知接收服务地址（可选）
    // $options->notifyUrl = "http://liebianshidai.com/?a=vip&c=notify";
    //可设置AES密钥，调用AES加解密相关接口时需要（可选）
    $options->encryptKey = "<-- 请填写您的AES密钥，例如：aa4BtZ4tspm2wnXLb1ThQA== -->";
    return $options;
}