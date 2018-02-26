<?php
/*Patron Singleton*/

class cls_ws_pse  extends CI_Controller{

	private static $_instance;
	private static $_ws_pse;
	private static $_tranKey='024h1IlD';
	private static $_seed; 
	private static $_auth;
	private static $_transaction;
	private static $_ipAddress;
	private static $_userAgent;


	const wsdl = 'https://test.placetopay.com/soap/pse/?wsdl';
	const login='6dd490faf9cb87a9862245da41170ff2';
	const lenguaje='es';
	const moneda='COP';
	
	
	static $_parametros = array('location' => 'https://test.placetopay.com/soap/pse/',
								'trace'    => 1,
								'exceptions' => true,
								'encoding' => 'UTF-8'
	       						);
	

	public function __construct(){
	  	self::$_ws_pse= new SoapClient(self::wsdl,self::$_parametros);
	  	self::$_seed=date('c');
	  	self::$_tranKey=sha1(self::$_seed.self::$_tranKey);	  	
		//ip
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		    self::$_ipAddress = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		    self::$_ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
		    self::$_ipAddress = $_SERVER['REMOTE_ADDR'];
		}
		//agente de usuario 
		self::$_userAgent=$_SERVER['HTTP_USER_AGENT'];

	  	/*tipo*/
	  	$authentication= 
	  	array('login'	  => self::login, 
		      'tranKey'   => self::$_tranKey,
			  'seed' 	  => self::$_seed,
   		      'additional'=> array()	
		);
	  	self::$_auth=array('auth'=>$authentication);	  
	}
	/*--------------------------------*/
	public static function getBankList(){
		if (!(self::$_instance instanceof self)){
	       self::$_instance=new self();
	    } 
	    $expiration = 86400; // 1 dia
	   	$key='banco';
	   	
	   	if(apcu_exists($key))
	   	{
	   		return apcu_fetch($key);			
	   	}else
	   	{
	   		apcu_store($key,self::$_ws_pse->getBankList(self::$_auth)->getBankListResult->item, $expiration);
	   		return self::$_ws_pse->getBankList(self::$_auth)->getBankListResult->item;		
	   	}	    
	}

	public static function createTransaction($bankCode,$bankInterface,$description,$totalAmount,array $payer,$buyer=array(),$shipping=array(),$rowid_person=null)
	{
		if (!(self::$_instance instanceof self)){
	       self::$_instance=new self();
	    }
	    if(empty($buyer))
	    	$buyer=$payer;

	    if(empty($shipping))
	    	$shipping=$payer;


	    /*tipo*/
	  	$PSETranreturnURLs =
	    array('bankCode'  		=> $bankCode, 
		      'bankInterface'   => $bankInterface,
			  'returnURL'  	    => 'http://localhost/PSE/index.php/principal_informacion/?code='.$rowid_person,
   		      'reference'		=> self::$_ipAddress.$payer['documentType'].$payer['document'],
   		      'description'		=> $description,
   		      'language'		=> self::lenguaje,
   		      'currency'		=> self::moneda,
   		      'totalAmount'     => $totalAmount,
   		      'taxAmount'		=> '0',
   		      'devolutionBase'  => '0',
   		      'tipAmount'       => '0',
   		      'payer'			=> $payer,
   		      'buyer'			=> $buyer,
   		      'shipping'		=> $shipping,
   		      'ipAddress'		=> self::$_ipAddress,
   		      'userAgent'		=> self::$_userAgent,
   		      'additionalData'	=> array()
		);	
		$param = self::$_auth;
		$param['transaction'] = $PSETranreturnURLs;
		return self::$_ws_pse->createTransaction($param)->createTransactionResult;
	}
	/*------------------------------------*/
	public static function getTransactionInformation($transactionID=null)
	{
		if (isset($transactionID) and !empty($transactionID)){
			if (!(self::$_instance instanceof self)){
	       		self::$_instance=new self();
	    	}
	    }

		$param = self::$_auth;
		$param['transactionID'] = $transactionID;
		return self::$_ws_pse->getTransactionInformation($param)->getTransactionInformationResult;		
	}
}
?>



