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
      	
		- It's possible to configure districts to notify in separate channels.
		  Notifications will be sent for a given radius around latitude / longitude values. 
 		  
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
		
		- Multiple Pokemon: Configure which Pokemon you want to receive notifications about in ivList.*yourdistrictname*.json. Then add this Object to the `ivList` array:
			
			```
			{
		        "name":     "Yourdistrictname",
		        "active":   true,
		        "fileName": "ivList.yourdistrictname.json",
		        "telegram": {
		          "yourdistrictname": "__CHAT_ID__"
		        },
		        "discord": {
		          "yourdistrictname": "__WEBHOOK__"
		        }
	      	}
			```

		- Single Pokemon or Raids: Add your district to any raid or pokemon channel config between telegram or discord. 
		- Example:
			```
		      {
		        "name":   "Icognito",
		        "active": true,
		        "ids":    [201],
		        "telegram": {
				  "Yourhometownname": "__CHAT_ID__",
		          "Yourdistrictname": "__CHAT_ID__"
		        },
		        "discord": {
				  "Yourhometownname": "__WEBHOOK__",
		          "Yourdistrictname": "__WEBHOOK__"
		        }
			```

		- Replace *yourdistrictname* with your real districts name.

2. **Raids**

	- Acticate this by setting a minimum level. Notifications will be sent for a given radius around latitude / longitude values.

	- Example:
	```
	  "raids": {
	    "minLevel":   5,
        "latitude":   "52.459605",
        "longitude":  "13.213513",
	    "radiusKm":   9
	  },
	```

3. **Telegram**
	
	- Set `"active": true,` to activate telegram notifications.
	- Set `apiKey` to the API Token from the <a href="https://telegram.me/botfather">BotFather</a>.
	- Set your Bot name.

4. **Discord**
	
	- Set `"active": true,` to activate discord notifications. Name your Discord Bot. Leave `avatar` and `webhook` untouched.

	- Example:
	```
	  "discord": {
	    "active":   true,
	    "botName":  "PokeBot",
	    "avatar":   "http://i.imgur.com/Su8yH00.png",
	    "webhook":  "https://discordapp.com/api/webhooks/"
	  },
	```

5. **Channel**
	* IV List
	
		- Use the IV list if you want to receive nofications about many different pokemon in a single channel. You can configure IV lists for your hometown or any defined district. Add your data to any activated notification mode (telegram / discord).
		- The `__WEBHOOK__` is the part of the Discord webhook that is following right after `https://discordapp.com/api/webhooks/`
		- This was created to configure a list with minimum IV values on a per pokemon base. Unfortunately IV data is currently disabled.
		- Example:
		```   
		  {
	        "name":     "Springfield",
	        "active":   true,
	        "fileName": "ivList.springfield.json",
	        "telegram": {
	          "Springfield": "__CHAT_ID__"
	        },
	        "discord": {
	          "Springfield": "__WEBHOOK__"
	        }
	      }
		```

	* IV
		- The IV channel is currently disabled because there is no data to receive.

	* Raid
		- Set `"active": true,` to activate Raid notifications.
		- Add your data to any activated notification mode (telegram / discord).
		- Currently, there is only one Raid channel supported. Will be changed soon.
		- Example:
		```
		    "raid": [
		      {
		        "name": "Raid",
		        "active": true,
		        "telegram": {
		          "Springfield": "__CHAT_ID__"
		        },
		        "discord": {
		        }
		      }
		    ]
		```

	* Pokemon
		- These Channels will notify Pokemon regardless wich IV values they have.
		- Set `"active": true,` to activate Pokemon notifications.
		- It is possible to add one `[201]` or multiple `[147, 148]` Pokemon Ids to the `ids` array. You can find the ids in the file <a href="https://github.com/d4NY0H/gomap-notifier/blob/master/nameList.json">nameList.json</a>.
		- Add your data to any activated notification mode (telegram / discord).
		- Example:
		```
	      {
	        "name":   "Icognito",
	        "active": true,
	        "ids":    [201],
	        "telegram": {
	          "Springfield": "__CHAT_ID__"
	        },
	        "discord": {
	          "Springfield": "__WEBHOOK__"
	        }
	      }
		```

6. IV List

 	* ivList.yourcityname.json

		- Add all Pokemon you want to get notified of in a single channel.
		- The parents object key is the Pokemon id. You can find the ids in the file <a href="https://github.com/d4NY0H/gomap-notifier/blob/master/nameList.json">nameList.json</a>.
		- Edit the minimum IV value in the childs object. Since IV data isn't available now, you should set all values to zero.
		- Edit the name of the Pokemon.
		- Example:
		```
			"3" :   { "minIv": 0,   "name": "Bisaflor" },
		```

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