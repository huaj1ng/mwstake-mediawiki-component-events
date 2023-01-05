<?php

namespace MWStake\MediaWiki\Component\Events\Tests;

use MediaWiki\User\UserIdentity;
use MWStake\MediaWiki\Component\Events\INotificationEvent;

class DummySubEvent extends DummyEvent implements INotificationEvent {

	/** @var int|null */
	private $agentId;

	/**
	 * @param int|null $agentId
	 */
	public function __construct( ?int $agentId = 1 ) {
		$this->agentId = $agentId;
	}

	public function getAgent() : UserIdentity {
		return \User::newFromId( $this->agentId );
	}

	/**
	 * @inheritDoc
	 */
	public function getKey() : string {
		return 'dummy-sub-event';
	}

	/**
	 * @inheritDoc
	 */
	public function hasPriorityOver() : array {
		return [];
	}
}
