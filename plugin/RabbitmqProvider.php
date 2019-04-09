<?php namespace RancherizeRabbitmq;

use Rancherize\Blueprint\Events\MainServiceBuiltEvent;
use Rancherize\Plugin\Provider;
use Rancherize\Plugin\ProviderTrait;
use RancherizeRabbitmq\Event\EventHandler;
use RancherizeRabbitmq\Parser\ConfigParser;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * Class MailhogProvider
 */
class RabbitmqProvider implements Provider {

	use ProviderTrait;

	/**
	 */
	public function register() {
		$this->container[ConfigParser::class] = function () {
			return new ConfigParser();
		};

		$this->container[EventHandler::class] = function ( $c ) {
			return new EventHandler( $c[ConfigParser::class] );
		};
	}

	/**
	 */
	public function boot() {
		/**
		 * @var EventDispatcher $dispatcher
		 */
		$dispatcher = $this->container['event'];
		$listener = $this->container[EventHandler::class];
		$dispatcher->addListener( MainServiceBuiltEvent::NAME, [$listener, 'built'] );
	}
}