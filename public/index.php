<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
$router = new Router();

//Imports a Controllers
use Controllers\LoginController;
use Controllers\CitaController;
use Controllers\ApiController;
use Controllers\AdminController;
use Controllers\ServicioController;

$router->get("/", [LoginController::class, 'login']);
$router->post("/", [LoginController::class, 'login']);
$router->get("/logout", [LoginController::class, 'logout']);

//Recuperar Password
$router->get("/forgotpw", [LoginController::class, 'forgot_password']);
$router->post("/forgotpw", [LoginController::class, 'forgot_password']);
$router->get("/recovery", [LoginController::class, 'recovery']);
$router->post("/recovery", [LoginController::class, 'recovery']);

//Crear cuenta
$router->get("/create", [LoginController::class, 'create']);
$router->post("/create", [LoginController::class, 'create']);

//ConfirmarCuenta
$router->get("/confirm", [LoginController::class, 'confirm']);
$router->get("/mensaje", [LoginController::class, 'mensaje']);

//Area privada
$router->get("/cita", [CitaController::class, 'index']);

//Area de Admin
$router->get("/admin", [AdminController::class, 'index']);

//Api de Citas
$router->get("/api/servicios", [ApiController::class, 'index']);
$router->post("/api/guardar", [ApiController::class, 'guardar']);
$router->post("/api/eliminar", [ApiController::class, 'eliminar']);

//Crud de servicios
$router->get("/servicios", [ServicioController::class, "index"]);
$router->get("/servicios/crear", [ServicioController::class, "crear"]);
$router->post("/servicios/crear", [ServicioController::class, "crear"]);
$router->get("/servicios/actualizar", [ServicioController::class, "actualizar"]);
$router->post("/servicios/actualizar", [ServicioController::class, "actualizar"]);
$router->post("/servicios/eliminar", [ServicioController::class, "eliminar"]);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();