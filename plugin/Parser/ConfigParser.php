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
		$rabbitmqConfiguration = new PrefixConfigurationDecorator( $configuration, 'rabbitmq.' );

		$config = new RabbitmqConfig();

		if ( !$configuration->has( 'rabbitmq' ) )
			return $config;

		$config->setEnabled( true );
		if ( $rabbitmqConfiguration->has( 'port' ) )
			$config->setExposed( true );

		$config->setPort( $rabbitmqConfiguration->get( 'port' ) );

		return $config;

	}

}