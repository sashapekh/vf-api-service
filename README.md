# vf-api-service

## install
```composer require sashapekh/vf-api-service```

## publish files
```php artisan vendor:publish --provider="Sashapekh\VfApi\VfApiServiceProvider" --force```
## run migration
```php artisan make:migration```

## add variables to .env file

```VF_SERVICE_URL= <domain service>``` 

```VF_SERVICE_TOKEN_URI= <uri for get token>```

```VF_SERVICE_SMS_MULTIPLE= <uri for send multiple phones one message>```

```VF_SERVICE_SMS_ONE= <uri for send a message for one phone>```

```VF_SERVICE_USER= <user for service>```

```VF_SERVICE_PASSWORD=< password for service>```

### usage in code
```php 
        return (new SendSmsService())->sendOneSms("<phone>", "<message>");
```
