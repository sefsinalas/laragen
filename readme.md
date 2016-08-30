# <img alt="laragen" src="https://raw.githubusercontent.com/mayconbordin/laragen/master/artwork/logo_h.png" width="300">

Este paquete es solo un fork para corregir un mini bug en el proyecto original.

Para usar agregar lo siguiente a composer.json:

```json
"repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/sefsinalas/laragen"
        }
    ],
    "require": {
	...
        "laravelcollective/html": "5.2.*"
    },
```

Y luego, por supuesto:
```php
composer update
```

[Link al proyecto original](https://github.com/mayconbordin/laragen)
