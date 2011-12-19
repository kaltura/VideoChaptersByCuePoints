<?php
require_once(dirname(__FILE__) . "/../KalturaClientBase.php");
require_once(dirname(__FILE__) . "/../KalturaEnums.php");
require_once(dirname(__FILE__) . "/../KalturaTypes.php");
require_once(dirname(__FILE__) . "/KalturaContentDistributionClientPlugin.php");

class KalturaDoubleClickDistributionProfileOrderBy
{
	const CREATED_AT_ASC = "+createdAt";
	const CREATED_AT_DESC = "-createdAt";
	const UPDATED_AT_ASC = "+updatedAt";
	const UPDATED_AT_DESC = "-updatedAt";
}

class KalturaDoubleClickDistributionProviderOrderBy
{
}

abstract class KalturaDoubleClickDistributionProfileBaseFilter extends KalturaConfigurableDistributionProfileFilter
{

}

abstract class KalturaDoubleClickDistributionProviderBaseFilter extends KalturaDistributionProviderFilter
{

}

class KalturaDoubleClickDistributionProfileFilter extends KalturaDoubleClickDistributionProfileBaseFilter
{

}

class KalturaDoubleClickDistributionProviderFilter extends KalturaDoubleClickDistributionProviderBaseFilter
{

}

class KalturaDoubleClickDistributionProfile extends KalturaConfigurableDistributionProfile
{
	/**
	 * 
	 *
	 * @var string
	 */
	public $channelTitle = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $channelLink = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $channelDescription = null;

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
	public $cuePointsProvider = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $itemsPerPage = null;


}

class KalturaDoubleClickDistributionProvider extends KalturaDistributionProvider
{

}


class KalturaDoubleClickService extends KalturaServiceBase
{
	function __construct(KalturaClient $client = null)
	{
		parent::__construct($client);
	}

	function getFeed($distributionProfileId, $hash, $page = 1, $period = -1)
	{
		$kparams = array();
		$this->client->addParam($kparams, "distributionProfileId", $distributionProfileId);
		$this->client->addParam($kparams, "hash", $hash);
		$this->client->addParam($kparams, "page", $page);
		$this->client->addParam($kparams, "period", $period);
		$this->client->queueServiceActionCall('doubleclickdistribution_doubleclick', 'getFeed', $kparams);
		$resultObject = $this->client->getServeUrl();
		return $resultObject;
	}
}
class KalturaDoubleClickDistributionClientPlugin extends KalturaClientPlugin
{
	/**
	 * @var KalturaDoubleClickDistributionClientPlugin
	 */
	protected static $instance;

	/**
	 * @var KalturaDoubleClickService
	 */
	public $doubleClick = null;

	protected function __construct(KalturaClient $client)
	{
		parent::__construct($client);
		$this->doubleClick = new KalturaDoubleClickService($client);
	}

	/**
	 * @return KalturaDoubleClickDistributionClientPlugin
	 */
	public static function get(KalturaClient $client)
	{
		if(!self::$instance)
			self::$instance = new KalturaDoubleClickDistributionClientPlugin($client);
		return self::$instance;
	}

	/**
	 * @return array<KalturaServiceBase>
	 */
	public function getServices()
	{
		$services = array(
			'doubleClick' => $this->doubleClick,
		);
		return $services;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return 'doubleClickDistribution';
	}
}

