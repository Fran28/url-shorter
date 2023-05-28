## About 

Para poder ejecutar el presente proyecto, deben ejecutarse las migraciones correspondientes con anterioridad.

--php artisan migrate;

Luego inicializar el servidor:

--php artisan serve;

## Registro

Url: /api/register

body:
{
    "name": "test",
    "email": "test@gmail.com",
    "password": "12345678"
}

Devuelve token que debe usarse como header, ejemplo: 
Authorization: Bearer lGMuqxjVWA05uMiW80EUd3ewvpO54YQKCf4pC4vD

## Login

Url: /api/login

Body: 
{
  "email": "johndoe@example.com",
  "password": "secretpassword"
}

Devuelve token que debe usarse como header, ejemplo: 
Authorization: Bearer lGMuqxjVWA05uMiW80EUd3ewvpO54YQKCf4pC4vD

## Acortar Url

Url: /api/v1/short-urls

Body: 
{
    "url" : "https://google.com"
}

Devolvera la url acortada. Requiere el token generado por login o registro.