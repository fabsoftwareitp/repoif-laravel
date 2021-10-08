<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompleteProfileController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view("/", "project.index")->name("project.index");

Route::get("/perfil/completar", [CompleteProfileController::class, "create"])
    ->middleware(["verified", "user.not.completed.profile"])
    ->name("profile.complete");

Route::post("/perfil/completar", [CompleteProfileController::class, "store"])
    ->middleware(["verified", "user.not.completed.profile"]);

Route::get("/perfil/editar", [ProfileController::class, "edit"])
    ->middleware(["verified"])
    ->name("profile.edit");

Route::post("/perfil/editar", [ProfileController::class, "update"])
    ->middleware(["verified"])
    ->name("profile.update");

Route::post("/perfil/deletar", [ProfileController::class, "destroy"])
    ->middleware(["auth"])
    ->name("profile.destroy");

Route::get("/perfil/{user}", [ProfileController::class, "show"])
    ->name("profile.show");

require __DIR__ . "/auth.php";
