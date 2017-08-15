<?php
/**
 * Cronjob
 *
 */
// Include spawn class.
require_once('class/Spawn.class.php');

// Get instance of spawn class.
$spawn = new Spawn();

// Collect data from API.
$spawn->getData();

// Get mon array.
$mons = $spawn->getMons();

// Get gym array.
$gyms = $spawn->getGyms();

// Check if we received data.
if (!empty($mons) || !empty($gyms)) {

    // Include sender class.
    require_once('class/Sender.class.php');

    // Get instance of sender class.
    $sender = new Sender();

    // Mons found.
    if (!empty($mons)) {
        // Iterate mon array.
        foreach ($mons AS $mon) {
            // Get mon channel ids.
            $channelIds = $sender->getMonChannelIds($mon);

            // Channel id found.
            if (!empty($channelIds->telegram) || !empty($channelIds->discord)) {

                // Get message string.
                $message = $sender->buildMonMessage($mon);

                // Message is required.
                if (!empty($message)) {
                    // Telegram.
                    if (!empty($channelIds->telegram)) {
                        // Process each channel id.
                        foreach ($channelIds->telegram AS $telegramId) {
                            // Send telegram message.
                            $sender->sendTelegram($mon, $message, $telegramId);
                        }
                    }
                    // Discord.
                    if (!empty($channelIds->discord)) {
                        // Process each channel id.
                        foreach ($channelIds->discord AS $discordId) {
                            // Send discord message.
                            $sender->sendDiscord($message, $discordId);
                        }
                    }
                }
            }
        }
    }

    // Gyms found.
    if (!empty($gyms)) {
        // Iterate gym array.
        foreach ($gyms AS $gym) {
            // Get raid channel ids.
            $channelIds = $sender->getRaidChannelIds($gym);

            // Channel id found.
            if (!empty($channelIds->telegram) || !empty($channelIds->discord)) {

                // Get message string.
                $message = $sender->buildRaidMessage($gym);

                // Message is required.
                if (!empty($message)) {
                    // Telegram.
                    if (!empty($channelIds->telegram)) {
                        // Process each channel id.
                        foreach ($channelIds->telegram AS $telegramId) {
                            // Send telegram message.
                            $sender->sendTelegram($gym, $message, $telegramId);
                        }
                    }
                    // Discord.
                    if (!empty($channelIds->discord)) {
                        // Process each channel id.
                        foreach ($channelIds->discord AS $discordId) {
                            // Send discord message.
                            $sender->sendDiscord($message, $discordId);
                        }
                    }
                }
            }
			if (isset($this->config->raidbot->enabled) && $this->config->raidbot->enabled === true) {
				// mimic telegram webhook
				$sender->sendRaidBotMessage($gym);
				}
        }
    }
}