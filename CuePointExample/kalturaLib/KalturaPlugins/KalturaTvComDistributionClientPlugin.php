<?php
require_once(dirname(__FILE__) . "/../KalturaClientBase.php");
require_once(dirname(__FILE__) . "/../KalturaEnums.php");
require_once(dirname(__FILE__) . "/../KalturaTypes.php");
require_once(dirname(__FILE__) . "/KalturaContentDistributionClientPlugin.php");

class KalturaTVComDistributionProfileOrderBy
{
	const CREATED_AT_ASC = "+createdAt";
	const CREATED_AT_DESC = "-createdAt";
	const UPDATED_AT_ASC = "+updatedAt";
	const UPDATED_AT_DESC = "-updatedAt";
}

class KalturaTVComDistributionProviderOrderBy
{
}

abstract class KalturaTVComDistributionProfileBaseFilter extends KalturaConfigurableDistributionProfileFilter
{

}

abstract class KalturaTVComDistributionProviderBaseFilter extends KalturaDistributionProviderFilter
{

}

class KalturaTVComDistributionProfileFilter extends KalturaTVComDistributionProfileBaseFilter
{

}

class KalturaTVComDistributionProviderFilter extends KalturaTVComDistributionProviderBaseFilter
{

}

class KalturaTVComDistributionProfile extends KalturaConfigurableDistributionProfile
{
	/**
	 * 
	 *
	 * @var int
	 */
	public $metadataProfileId = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $feedUrl = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $feedTitle = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $feedLink = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $feedDescription = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $feedLanguage = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $feedCopyright = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $feedImageTitle = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $feedImageUrl = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $feedImageLink = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $feedImageWidth = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $feedImageHeight = null;


}

class KalturaTVComDistributionProvider extends KalturaDistributionProvider
{

}

class KalturaTvComDistributionClientPlugin extends KalturaClientPlugin
{
	/**
	 * @var KalturaTvComDistributionClientPlugin
	 */
	protected static $instance;

	/**
	 * @var KalturaTvComService
	 */
	public $tvCom = null;

	protected function __construct(KalturaClient $client)
	{
		parent::__construct($client);
		$this->tvCom = new KalturaTvComService($client);
	}

	/**
	 * @return KalturaTvComDistributionClientPlugin
	 */
	public static function get(KalturaClient $client)
	{
		if(!self::$instance)
			self::$instance = new KalturaTvComDistributionClientPlugin($client);
		return self::$instance;
	}

	/**
	 * @return array<KalturaServiceBase>
	 */
	public function getServices()
	{
		$services = array(
			'tvCom' => $this->tvCom,
		);
		return $services;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return 'tvComDistribution';
	}
}

