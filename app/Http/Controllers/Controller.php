<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Parse\ParseClient;
use Parse\ParseUser;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        ParseClient::initialize( "vyjA4UubIRue43nhmI8KefPVZrwE1xuZP3by1hBd", "7sLqdRXY6NhDXErz1kioC9GPJSgMQz3BUmfUJL75", "MPysOkJV0DeuArKeVS6IkjMsosV8HposdpuV7l13" );
        ParseClient::setServerURL('https://parseapi.back4app.com/','parse');

        try {
            $user = ParseUser::logIn("admin", "admin");
            // Do stuff after successful login.
        } catch (ParseException $error) {
            // The login failed. Check error to see why.
        }


    }
}
