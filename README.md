Notifier for Gomap
===========

PHP script to get notified about spawns and raids via Telegram and Discord.

Requirements
------------
* php
* libcurl
* cronjob

Installation
------------

1. Make a copy of <a href="https://github.com/d4NY0H/gomap-notifier/blob/master/config.json.example">config.json.example</a> and rename the file to config.json.
2. Configure config.json
3. Rename <a href="https://github.com/d4NY0H/gomap-notifier/blob/master/ivList.springfield.json">ivList.springfield.json</a> to ivList.*yourcityname*.json
4. Configure ivList.*yourcityname*.json
5. Set write permissions of maxeid.txt and maxgid.txt to chmod 0664.
6. Create a cronjob on your server to trigger the script every minute. Example for linux systems:

	```
    crontab -e
    */1 * * * * wget -O /dev/null -o /dev/null http://127.0.0.1/cronjob.php
	```

Configuration
------------

**config.json**

1. **Map**
	* **Bounds**
	
		Edit your outer bounds to specify the rectangle area for which you like to receive data.
		Example:

		```
	    "boundNorth": "52.56350",
	    "boundEast":  "13.552260",
	    "boundSouth": "52.459605",
	    "boundWest":  "13.213513",
	    "homeTown":   "Berlin",
		```

		You can get those latitude / longitude values by setting markers at <a href="https://maps.google.de">https://maps.google.de</a>.

		Set the Name of your hometown.

    * **Districts**
      	
		It's possible to configure districts to notify in separate channels.
 		Example:
		
		```
		"districts": [
	      {
	        "name":       "Mitte",
	        "active":     true,
	        "latitude":   "52.459605",
	        "longitude":  "13.213513",
	        "radiusKm":   4
	      }
	    ]
		```
		
		ivList.mitte.json

2. Raids
3. Telegram
4. Discord
5. Channel
	* IV List
	* IV
	* Raid
	* Pokemon

**ivList.yourcityname.json**

-> todo

How to get Telegram API Keys
------------
1. Go to <a href="https://telegram.org/dl/webogram">Telegram Web Client</a>. Enter your phone number and follow the instructions to create your account.
2. Talk to the <a href="https://telegram.me/botfather">BotFather</a> to create a new bot. Use the `/newbot` command and follow his instructions. It will give you an **API Token** when you are finished.
3. Start a conversation with your bot. In the top left click on the menu bars, then click create group. Type in the name of the bot you previously created, then click on it when it appears below. Then click next. Type any message to your bot.
4. Enter your bot token in to replace the `<BOT_TOKEN_HERE>` in the following url `https://api.telegram.org/bot<BOT_TOKEN_HERE>/getUpdates`. Then go to it, and find the section that says `"chat":{"id":<CHAT_ID>`. This number is your **chatId**. Every chat_id is prefixed with `-100`.

**Alternatively or if you like to get the chat_id of private channels:**

1. Login under your account at web version of Telegram : <a href="https://web.telegram.org">https://web.telegram.org</a>
2. Find your channel and check the URL. It should be like `https://web.telegram.org/#/im?p=c1055587116_11052224402541910257`
3. Grab `1055587116` from it, and add `-100` as a prefix.
4. So your channel id will be `-1001055587116`.

Troubleshooting
------------

**reset.php**

This file can be used to delete the content of the <a href="https://github.com/d4NY0H/gomap-notifier/blob/master/maxeid.txt">maxeid.txt</a> and <a href="https://github.com/d4NY0H/gomap-notifier/blob/master/maxgid.txt">maxgid.txt</a> files. This is necessary if the ids have changed on the server side and no notifications are sent anymore.