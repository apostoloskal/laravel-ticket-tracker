## Installation
### Clone project

```bash
git clone https://github.com/apostoloskal/laravel-ticket-tracker.git
```

## On linux run:

```bash
cd laravel-ticket-tracker
bash setup.sh
```

## Or manually:
### Install dependencies

```bash
cd laravel-ticket-tracker
npm i
composer i
```

### Start mailhog for email monitoring

```bash
cd mailhog
docker compose up
cd ..
```

### Create .env file

```bash
cp .env.example .env

sed -ri -e 's/APP_NAME=\w+/APP_NAME=TicketTracker/g' \
-e 's/MAIL_MAILER=\w+/MAIL_MAILER=smtp/g' \
-e 's/MAIL_FROM_ADDRESS="[^"]+"/MAIL_FROM_ADDRESS="ticket@tickettracker.com"/g' \
-e 's/MAIL_PORT=\w+/MAIL_PORT=1025/g' \
.env
```

### Execute necessary laravel setup commands

```bash
php artisan key:generate
php artisan migrate --force --seed
php artisan storage:link
```

## Run

```bash
composer run dev
```

## Note

If file uploads fail even though they are small in size, you may need to configure your server's upload limits in the php.ini file. (If artisan migrate succeeded, there should be an admin account whom you can login as.)

<ins>Admin User:</ins>
Username: admin
Password: admin