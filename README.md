
# Suomi Tavu

[![build](https://github.com/andrewwippler/Suomi-Tavu/actions/workflows/build.yaml/badge.svg)](https://github.com/andrewwippler/Suomi-Tavu/actions/workflows/build.yaml)

Based off of the work by [Duukkis](http://www.palomaki.info/apps/haiku/). Working demo: https://tavu.wplr.rocks/

## Quickstart

- Clone this Repo
- `cp .env.example .env`
- `php artisan key:generate`
- `php artisan serve`
- POST text to `/api/tavu` as a form item with the name `textarea`

## See Also

- tests/Feature/TavuJsonTest.php

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
