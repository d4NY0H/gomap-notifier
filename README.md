Notifier for Gomap
===========

PHP script to get notified about spawns and raids via Telegram and Discord.

Requirements
------------

-> todo

Installation
------------

1. Make a copy of <a href="https://github.com/d4NY0H/gomap-notifier/blob/master/config.json.example">config.json.example</a> and rename the file to config.json.
2. Configure config.json
3. Rename <a href="https://github.com/d4NY0H/gomap-notifier/blob/master/ivList.springfield.json">ivList.springfield.json</a> to ivList.*yourcityname*.json
4. Configure ivList.*yourcityname*.json
5. Create a cronjob on your server to trigger the script every minute. Example for linux systems:

	```
    crontab -e
    */1 * * * * wget -O /dev/null -o /dev/null http://127.0.0.1/cronjob.php
	```

Configuration
------------

**config.json**

-> todo

**ivList.yourcityname.json**

-> todo

Troubleshooting
------------

**reset.php**

-> todo