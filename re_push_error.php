<?php
set_time_limit(0);

//错误文件名字
$fileDir = 'delivery/';		//文件目录
//$fileName = 'delivery_2017_05_27';	//文件名字，测试
$fileSuffix = '.txt';			//后缀
$errorFileName = array();

//自动获取文件名称
$month = array( '05','06','07','08','09','10','11' );
$day = array( '01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31' );
$fileName = 'delivery_2017_';
foreach( $month as $months ){
	foreach( $day as $days ){
		if( file_exists( $fileDir.$fileName.$months."_".$days.$fileSuffix ) ){
			$errorFileName[] = $fileName.$months."_".$days;
		}
	}
}

// var_dump($errorFileName);
// exit;

//$dataArr保存需推送报文,$dataError记录推送失败的订单，$dataSuccess记录推送成功的订单
$dataArr = $dataError = $dataSuccess =  array();

//循环获取文件内容，生成订单订单信息
foreach( $errorFileName as $val ){
	if( file_exists( $fileDir.$val.$fileSuffix ) ){
		$file = fopen( $fileDir.$val.$fileSuffix,'r' );
		while( !feof( $file ) ){
			$data = fgets( $file );
			if( strpos( $data, 'logistics_code' ) !== false ){
				//转码
				$coding = mb_detect_encoding( $data, array('GB2312','GBK','UTF-16','UCS-2','UTF-8','BIG5','ASCII' ) );
				$data = json_decode( iconv( $coding, 'UTF-8', $data ), true );
				if( !empty($data['order_id']) && !empty($data['way_bill_no']) && !empty($data['logistics_code']) ){
					//报文格式日志
					$LogisticsData = array(
						'orderId' => trim( $data['order_id'] ),	//订单号
						'wayBillNo' => trim( $data['way_bill_no'] ),	//运单号
						'cbepcomCode' => 'EFS',	//电商平台编码
						'logisticsCode' => trim( $data['logistics_code'] ),	//物流企业编码
						'isSubscribe' => '1',	//是否订阅
						'dataSource' => '10',	//字符串，默认值 10：快递鸟
					);
					$dataArr[] = json_encode( $LogisticsData );
				}
				
			}
		}
		fclose($file);
	}
}

// var_dump($dataArr);
// exit;

//CURL请求更新
$url = 'http://121.33.205.117:8008/logistics/rest/logistics/proapply/getmailapply.do';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST,true);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));

foreach( $dataArr as $val ){
	curl_setopt($ch,CURLOPT_POSTFIELDS,$val);
	$result = json_decode( curl_exec($ch),true );
	if( $result['status'] == 1 ){
		$dataSuccess[] = $val;
	}else{
		$dataError[] = $val;
	}
}
var_dump($dataError);
echo '<hr />';
//var_dump($dataSuccess);
exit;

