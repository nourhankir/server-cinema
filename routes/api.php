<?php

require_once __DIR__ . '/../app/Controllers/UserController.php';
require_once __DIR__ . '/../app/Controllers/MovieController.php';
require_once __DIR__ . '/../app/Controllers/ShowtimeController.php';
require_once __DIR__ . '/../app/Controllers/SeatController.php';
require_once __DIR__ . '/../app/Controllers/PaymentController.php';

//localhost/cinema-server/public/Users
$router->get('Users', [new UserController(), 'index']);
//localhost/cinema-server/public/login
$router->post('login', [new UserController(), 'login']);
//localhost/cinema-server/public/register
$router->post('register', [new UserController(), 'register']);

//localhost/cinema-server/public/movies originL LIST_MOVIE
$router->get('movies', [new MovieController(), 'index']);
//localhost/cinema-server/public/movie?id=3 original get movie
$router->get('movie', [new MovieController(), 'show']);
//localhost/cinema-server/public/showtimes original LIST_SHOWTIMES
$router->get('showtimes', [new ShowtimeController(), 'index']);
//localhost/cinema-server/public/showtimes-by-movie?movie_id=1 original get showtimes by movie
$router->get('showtimes-by-movie', [new ShowtimeController(), 'byMovie']);
//localhost/cinema-server/public/seats?showtime_id=3 // original get seats 
$router->get('seats', [new SeatController(), 'byShowtime']);
//localhost/cinema-server/public/finalize-payment original finalize payment
$router->post('finalize-payment', [new PaymentController(), 'finalize']);
//localhost/cinema-server/public/validate-coupon original validate coupon
$router->post('validate-coupon', [new PaymentController(), 'validateCoupon']);
