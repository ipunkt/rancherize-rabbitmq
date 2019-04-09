<?php namespace RancherizeRabbitmq\Config;

/**
 * Class RabbitmqConfig
 * @package RancherizeRabbitmq\Config
 */
class RabbitmqConfig {

	/**
	 * @var bool
	 */
	protected $enabled = false;

	/**
	 * @var int
	 */
	protected $port = 0;

	/**
	 * @var bool
	 */
	protected $exposed = false;

	/**
	 * @return bool
	 */
	public function isEnabled(): bool {
		return $this->enabled;
	}

	/**
	 * @param bool $enabled
	 * @return RabbitmqConfig
	 */
	public function setEnabled( bool $enabled ): RabbitmqConfig {
		$this->enabled = $enabled;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getPort(): int {
		return $this->port;
	}

	/**
	 * @param int $port
	 * @return RabbitmqConfig
	 */
	public function setPort( int $port ): RabbitmqConfig {
		$this->port = $port;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function isExposed(): bool {
		return $this->exposed;
	}

	/**
	 * @param bool $exposed
	 */
	public function setExposed( bool $exposed ) {
		$this->exposed = $exposed;
	}


}