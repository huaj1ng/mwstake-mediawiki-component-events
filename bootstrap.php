<?php

use MWStake\MediaWiki\ComponentLoader\Bootstrapper;

if ( defined( 'MWSTAKE_MEDIAWIKI_COMPONENT_EVENTS_VERSION' ) ) {
	return;
}

define( 'MWSTAKE_MEDIAWIKI_COMPONENT_EVENTS_VERSION', '2.0.1' );

Bootstrapper::getInstance()
	->register( 'events', function () {
		$GLOBALS['wgServiceWiringFiles'][] = __DIR__ . '/includes/ServiceWiring.php';
		$GLOBALS['wgMWStakeNotificationEventConsumers'] = [];

		$GLOBALS['wgExtensionFunctions'][] = static function () {
			// During the app lifecycle, Notifier just queues events
			// This is where it actually emits them (before shutdown)
			$notifier = \MediaWiki\MediaWikiServices::getInstance()->getService( 'MWStake.Notifier' );
			register_shutdown_function( [ $notifier, 'flush' ] );
		};
	} );
