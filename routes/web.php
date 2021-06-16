<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return response()->json([
        "message" => config('app.name') . " - " . $router->app->version(),
        "status" => 200,
    ], 200);
});

/**
 * Authors Routes
 *
 */
$router->group(['prefix' => 'authors'], function () use ($router) {
    $router->get("/", "AuthorsController@index");
    $router->post("/", "AuthorsController@store");

    // Author id prefix routes
    $router->group(['prefix' => "{author}"], function () use ($router) {
        $router->get("/", "AuthorsController@show");
        $router->put("/", "AuthorsController@update");
        $router->delete("/", "AuthorsController@destroy");
    });
});
