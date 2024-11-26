# Currency Exchange Rate API

This Laravel application provides an API to manage and fetch historical exchange rates for multiple currencies. It automatically fetches exchange rates daily and allows users to query rates for specific dates.

---

## Features

- Add currencies to the database if they do not already exist.
- Automatically fetch and store USD exchange rates against at least ten other currencies daily.
- Use Laravel's job queues for database-writing operations.
- Provide an API endpoint to retrieve exchange rates for a specific date.
- Unit and feature tests with decent code coverage.

---

## Requirements

- PHP >= 7.3
- Laravel >= 8.x
- Composer
- MySQL or PostgreSQL database
- OpenExchangeRates or ExchangeRatesAPI API key

---

## Setup Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/yudeshika/cem.git
cd cem/cem

Please change .env.example to .env and setup your database credentials and API Keys
- CURRENCY_EXCHANGE_API_KEY=<YOUR_KEY>
- CURRENCY_EXCHANGE_URL=http://openexchangerates.org/api/

php artisan migrate
php artisan db:seed
php artisan serve

php artisan sheduele:run  // To Shedule Jobs
php artisan queue:work  // To run Que

php artisan test   // To Run test Cases
