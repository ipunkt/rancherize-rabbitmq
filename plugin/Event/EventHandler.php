<?php namespace RancherizeRabbitmq\Event;

use Rancherize\Blueprint\Events\MainServiceBuiltEvent;
use Rancherize\Blueprint\Infrastructure\Service\Service;
use RancherizeRabbitmq\Parser\ConfigParser;

/**
 * Class EventHandler
 * @package RancherizeMailhog\Event
 */
class EventHandler {
	/**
	 * @var ConfigParser
	 */
	private $configParser;

	/**
	 * EventHandler constructor.
	 * @param ConfigParser $configParser
	 */
	public function __construct( ConfigParser $configParser ) {
		$this->configParser = $configParser;
	}

	/**
	 * @param MainServiceBuiltEvent $event
	 */
	public function built( MainServiceBuiltEvent $event ) {

		$mainService = $event->getMainService();
		$configuration = $event->getEnvironmentConfiguration();

		$rabbitmqConfig = $this->configParser->parse( $configuration );
		if ( !$rabbitmqConfig->isEnabled() )
			return;

		$rabbitmqService = new Service();
		$rabbitmqService->setName( 'Mailhog' );
		$rabbitmqService->setImage( 'rabbitmq:3-management' );

		$mainService->addLink( $rabbitmqService, 'rabbitmq' );
		$mainService->setEnvironmentVariable( 'RMQ_HOST', 'rabbitmq' );
		$mainService->setEnvironmentVariable( 'RMQ_PORT', '5672' );
        $mainService->setEnvironmentVariable( 'RMQ_USERNAME', 'guest' );
        $mainService->setEnvironmentVariable( 'RMQ_PASSWORD', 'guest' );
		if ( $rabbitmqConfig->isExposed() )
			$rabbitmqService->expose( 15672, $rabbitmqConfig->getPort() );

		$event->getInfrastructure()->addService( $rabbitmqService );


	}
}