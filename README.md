Installation:
1. `composer install`
2. Copy file `.env_example` to `.env` and set variables for redis

API:
1. / GET - return statistic, example: `{"RU": 10, "CY": 12, ...}`
2. /hit POST - add hit for country, parameter "country" is required 