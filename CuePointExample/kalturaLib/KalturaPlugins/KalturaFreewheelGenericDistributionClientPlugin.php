<?php
require_once(dirname(__FILE__) . "/../KalturaClientBase.php");
require_once(dirname(__FILE__) . "/../KalturaEnums.php");
require_once(dirname(__FILE__) . "/../KalturaTypes.php");
require_once(dirname(__FILE__) . "/KalturaContentDistributionClientPlugin.php");

class KalturaFreewheelGenericDistributionProfileOrderBy
{
	const CREATED_AT_ASC = "+createdAt";
	const CREATED_AT_DESC = "-createdAt";
	const UPDATED_AT_ASC = "+updatedAt";
	const UPDATED_AT_DESC = "-updatedAt";
}

class KalturaFreewheelGenericDistributionProviderOrderBy
{
}

abstract class KalturaFreewheelGenericDistributionProfileBaseFilter extends KalturaConfigurableDistributionProfileFilter
{

}

abstract class KalturaFreewheelGenericDistributionProviderBaseFilter extends KalturaDistributionProviderFilter
{

}

class KalturaFreewheelGenericDistributionProfileFilter extends KalturaFreewheelGenericDistributionProfileBaseFilter
{

}

class KalturaFreewheelGenericDistributionProviderFilter extends KalturaFreewheelGenericDistributionProviderBaseFilter
{

}

class KalturaFreewheelGenericDistributionProfile extends KalturaConfigurableDistributionProfile
{
	/**
	 * 
	 *
	 * @var string
	 */
	public $apikey = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $email = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $sftpPass = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $sftpLogin = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $contentOwner = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $upstreamVideoId = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $upstreamNetworkName = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $upstreamNetworkId = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $categoryId = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $replaceGroup = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $replaceAirDates = null;


}

class KalturaFreewheelGenericDistributionProvider extends KalturaDistributionProvider
{

}

class KalturaFreewheelGenericDistributionClientPlugin extends KalturaClientPlugin
{
	/**
	 * @var KalturaFreewheelGenericDistributionClientPlugin
	 */
	protected static $instance;

	protected function __construct(KalturaClient $client)
	{
		parent::__construct($client);
	}

	/**
	 * @return KalturaFreewheelGenericDistributionClientPlugin
	 */
	public static function get(KalturaClient $client)
	{
		if(!self::$instance)
			self::$instance = new KalturaFreewheelGenericDistributionClientPlugin($client);
		return self::$instance;
	}

	/**
	 * @return array<KalturaServiceBase>
	 */
	public function getServices()
	{
		$services = array(
		);
		return $services;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return 'freewheelGenericDistribution';
	}
}

