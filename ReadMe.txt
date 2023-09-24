
Procedure

1- first install and configure "cors unblock" extension with chrome.

2- set SESSION_DOMAIN = localhost:8000 to .evn file in laravel (if using in local host)

3- comment // \App\Http\Middleware\VerifyCsrfToken::class, 
   in Middleware/kernal.php --> $middlewareGroups -> 'web'

4- create reactjs_data.txt in storage/app/textfiles 