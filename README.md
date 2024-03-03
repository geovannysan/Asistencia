
# Sistema de asistencia con laravel 9

uso de apirest con laravel 
y modelo vista controlador 



## API Reference

#### post registra asistencia

```http
  post /api/entrada
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `cedula` | `string` | **Required**.              |

#### Post registra salida

```http
  post /api/assistencia
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `cedula`      | `string` | **Required**.                 |



## Installation

Ejecutar en local
Descargar xampp 
importar base de datos entradas.sql
archivo .env  si es necesario cambiar parameros de conección

Descargar composer
- https://getcomposer.org/download/

``` 
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=entradas
DB_USERNAME=root
DB_PASSWORD=
``` 

ejecutar  en cmd despues de clonar el repositorio y entrar a la carpeta 
``` 
  composer i 
  npm i
  npm run dev 
  ctr + c
  php artisan migrate
  php artisan db:seed
  php artisan serve
```

    
## Desplegar
```
  composer i 
```

importar base de datos entradas.sql

cambiar parametros de acuardo a hosting o servidor de base de dato

``` 
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=entradas
DB_USERNAME=root
DB_PASSWORD=
``` 

subir todo el proyecto al hosting o a servidor y apuntar a la carpeta public




## En caso de no ejecutar
el proyecto se encuantra desplegado 

puede visitar:
- https://asistencia.covagu.com


## Authors

- [@geovannysan](https://github.com/geovannysan)

