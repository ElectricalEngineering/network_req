#!/bin/bash

find . -type d -exec chmod 775 {} \;
find . -type f -exec chmod 664 {} \;
chown -Rv www-data.www-data .
chmod a+x $0