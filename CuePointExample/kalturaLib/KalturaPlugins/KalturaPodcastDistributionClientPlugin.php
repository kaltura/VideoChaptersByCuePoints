<?php
require_once(dirname(__FILE__) . "/../KalturaClientBase.php");
require_once(dirname(__FILE__) . "/../KalturaEnums.php");
require_once(dirname(__FILE__) . "/../KalturaTypes.php");
require_once(dirname(__FILE__) . "/KalturaContentDistributionClientPlugin.php");

class KalturaPodcastDistributionProfileOrderBy
{
	const CREATED_AT_ASC = "+createdAt";
	const CREATED_AT_DESC = "-createdAt";
	const UPDATED_AT_ASC = "+updatedAt";
	const UPDATED_AT_DESC = "-updatedAt";
}

class KalturaPodcastDistributionProviderOrderBy
{
}

abstract class KalturaPodcastDistributionProfileBaseFilter extends KalturaDistributionProfileFilter
{

}

abstract class KalturaPodcastDistributionProviderBaseFilter extends KalturaDistributionProviderFilter
{

}

class KalturaPodcastDistributionProfileFilter extends KalturaPodcastDistributionProfileBaseFilter
{

}

class KalturaPodcastDistributionProviderFilter extends KalturaPodcastDistributionProviderBaseFilter
{

}

class KalturaPodcastDistributionProfile extends KalturaDistributionProfile
{
	/**
	 * 
	 *
	 * @var string
	 */
	public $xsl = null;

	/**
	 * 
	 *
	 * @var string
	 * @readonly
	 */
	public $feedId = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $metadataProfileId = null;


}

class KalturaPodcastDistributionProvider extends KalturaDistributionProvider
{

}

class KalturaPodcastDistributionClientPlugin extends KalturaClientPlugin
{
	/**
	 * @var KalturaPodcastDistributionClientPlugin
	 */
	protected static $instance;

	protected function __construct(KalturaClient $client)
	{
		parent::__construct($client);
	}

	/**
	 * @return KalturaPodcastDistributionClientPlugin
	 */
	public static function get(KalturaClient $client)
	{
		if(!self::$instance)
			self::$instance = new KalturaPodcastDistributionClientPlugin($client);
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
		return 'podcastDistribution';
	}
}

