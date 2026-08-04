#!/bin/bash

composer i
npm i

cp .env.example .env

sed -ri -e 's/APP_NAME=\w+/APP_NAME=TicketTracker/g' \
-e 's/MAIL_MAILER=\w+/MAIL_MAILER=smtp/g' \
-e 's/MAIL_FROM_ADDRESS="[^"]+"/MAIL_FROM_ADDRESS="ticket@tickettracker.com"/g' \
-e 's/MAIL_PORT=\w+/MAIL_PORT=1025/g' \
.env

php artisan key:generate

php artisan migrate

php artisan db:seed

cd mailhog
docker compose up
cd ..

php artisan storage:link

composer run dev