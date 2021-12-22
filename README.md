# Router.php
 code source de mon routeur php
 
## Utilisation :
Les fonctions disponibles sont :
 - get
 - post
 - put
 - patch
 - delete
 - options


```php
Routes::get('/blog', function () {
 return "Mon super Blog !";
});
 
Routes::get('/blog/{id}', function ($id) {
 return "Blog " . $id;
});

Routes::run();
```
ou
```php
$router = new Router();

$router->get('/blog', function () {
 return "Mon super Blog !";
});

$router->get('/blog/{id}', function ($id) {
 return "Blog " . $id;
});

$router->run();
```

## License

`nirbose/router.php` is released under the MIT public license. See the enclosed `LICENSE` for details.
