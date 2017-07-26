Notifier for Gomap

Cronjob:
```
crontab -e
*/1 * * * * wget -O /dev/null -o /dev/null http://127.0.0.1/cronjob.php
```