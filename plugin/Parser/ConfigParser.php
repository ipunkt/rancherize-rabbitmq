<?php namespace RancherizeRabbitmq\Parser;

use Rancherize\Configuration\Configuration;
use Rancherize\Configuration\PrefixConfigurationDecorator;
use RancherizeMailhog\Config\MailhogConfig;
use RancherizeRabbitmq\Config\RabbitmqConfig;

/**
 * Class ConfigParser
 * @package RancherizeMailhog\Parser
 */
class ConfigParser {

	/**
	 * @param Configuration $configuration
	 */
	public function parse( Configuration $configuration ) {
		$mailhogConfiguration = new PrefixConfigurationDecorator( $configuration, 'mailhog.' );

		$config = new RabbitmqConfig();

		if ( !$configuration->has( 'rabbitmq' ) )
			return $config;

		$config->setEnabled( true );
		if ( $mailhogConfiguration->has( 'port' ) )
			$config->setExposed( true );

		$config->setPort( $mailhogConfiguration->get( 'port' ) );

		return $config;

	}

}