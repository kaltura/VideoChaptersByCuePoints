<?php
require_once(dirname(__FILE__) . "/../KalturaClientBase.php");
require_once(dirname(__FILE__) . "/../KalturaEnums.php");
require_once(dirname(__FILE__) . "/../KalturaTypes.php");
require_once(dirname(__FILE__) . "/KalturaContentDistributionClientPlugin.php");

class KalturaFreewheelDistributionProfileOrderBy
{
	const CREATED_AT_ASC = "+createdAt";
	const CREATED_AT_DESC = "-createdAt";
	const UPDATED_AT_ASC = "+updatedAt";
	const UPDATED_AT_DESC = "-updatedAt";
}

class KalturaFreewheelDistributionProviderOrderBy
{
}

abstract class KalturaFreewheelDistributionProfileBaseFilter extends KalturaDistributionProfileFilter
{

}

abstract class KalturaFreewheelDistributionProviderBaseFilter extends KalturaDistributionProviderFilter
{

}

class KalturaFreewheelDistributionProfileFilter extends KalturaFreewheelDistributionProfileBaseFilter
{

}

class KalturaFreewheelDistributionProviderFilter extends KalturaFreewheelDistributionProviderBaseFilter
{

}

class KalturaFreewheelDistributionProfile extends KalturaDistributionProfile
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
	public $accountId = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $metadataProfileId = null;


}

class KalturaFreewheelDistributionProvider extends KalturaDistributionProvider
{

}

class KalturaFreewheelDistributionClientPlugin extends KalturaClientPlugin
{
	/**
	 * @var KalturaFreewheelDistributionClientPlugin
	 */
	protected static $instance;

	protected function __construct(KalturaClient $client)
	{
		parent::__construct($client);
	}

	/**
	 * @return KalturaFreewheelDistributionClientPlugin
	 */
	public static function get(KalturaClient $client)
	{
		if(!self::$instance)
			self::$instance = new KalturaFreewheelDistributionClientPlugin($client);
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
		return 'freewheelDistribution';
	}
}

