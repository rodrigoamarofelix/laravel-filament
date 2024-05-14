# Laravel com Filament

Projeto inicial usando Laravel, livewire class e Filament.

## Executando projeto

1. `docker compose upp --build -d`
2. `docker compose exec app php composer install`
3. `docker compose exec app php artisan migrate`

## Executando comandas dentro do container

1. `docker compose exec app php artisan {Seu comando}`

## Tecnologias

1. PHP v8.2.11
2. Laravel v11.6.0
3. Livewire 3.4
4. Filament 3.0
5. Postgress DB
6. Tailwind Css
7. Node 20

## Documentações

1. [Laravel 11](https://laravel.com/docs/11.x/releases "Laravel documentation")
2. [Livewire](https://laravel-livewire.com/ "Livewire documentation")
3. [Filament](https://filamentphp.com/docs/3.x/panels/installation, "Filament")

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
