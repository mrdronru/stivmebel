#!/bin/sh
cd /var/www/u2240000/data/flatica || exit 1
. ./env.sh
exec /opt/python/python-3.8.8/bin/python send_campaign.py campaign2.csv
