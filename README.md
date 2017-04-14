Yii 2 Project
============================

Este sistema da un ejemplo basico de desarrollo con el framework yii2.

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

Tener instalado PHP 5.6.0.


INSTALLATION
------------

### Instacion de Composer

Si no tiene [Composer](http://getcomposer.org/), puede instalarlo siguiendo las instrucciones instructions
en [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

Si ya lo tiene instalado use los siquientes comandos antes de descagar el proyecto:

~~~
php composer.phar global require "fxp/composer-asset-plugin:^1.2.0"
~~~

Ahora debe clonar el proyecto hacia su directorio de publicaci[on de html.

~~~
git clone https://github.com/TecladoZurdo/ncsis.git sisvac
~~~
]
Luego de clonar cambiarse al directorio 
~~~
cd sisvac
~~~

Dentro del directorio proceder a instalar los componentes con el siguiente comando.
~~~
composer install
~~~

CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

**NOTES:**
- Yii won't create the database for you, this has to be done manually before you can access it.
- Check and edit the other files in the `config/` directory to customize your application as required.
- Refer to the README in the `tests` directory for information specific to basic application tests.




```
<VirtualHost *:80>
    ServerAdmin correo@electronico.com
    DocumentRoot "/opt/lampp/htdocs/sisvac/web"
    ServerName sisvac
    ErrorLog "logs/sisvac-error_log"
    CustomLog "logs/sisvac-access_log" common
</VirtualHost>
```