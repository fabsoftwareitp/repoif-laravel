<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CompleteProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectCommentController;
use App\Http\Controllers\StaticPageController;

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

Route::get("/", [ProjectController::class, "index"])
    ->name("project.index");

Route::get("/projetos/publicar", [ProjectController::class, "create"])
    ->middleware(["auth", "verified"])
    ->name("project.create");

Route::post("/projetos", [ProjectController::class, "store"])
    ->middleware(["auth", "verified"])
    ->name("project.store");

Route::get("/projetos/{project}", [ProjectController::class, "show"])
    ->name("project.show");

Route::get("/projetos/{project}/editar", [ProjectController::class, "edit"])
    ->middleware(["auth", "verified"])
    ->name("project.edit");

Route::post("/projetos/{project}", [ProjectController::class, "update"])
    ->middleware(["auth", "verified"])
    ->name("project.update");

Route::delete("/projetos/{project}", [ProjectController::class, "destroy"])
    ->middleware(["auth", "verified"])
    ->name("project.destroy");

Route::post("/projetos/{project}/like", [ProjectController::class, "like"])
    ->middleware(["auth", "verified"])
    ->name("project.like");


Route::post("/projetos/{project}/comentarios", [ProjectCommentController::class, "create"])
    ->middleware(["auth", "verified"])
    ->name("project-comment.create");

Route::put("/projetos/{project}/comentarios/{projectComment}", [ProjectCommentController::class, "update"])
    ->middleware(["auth", "verified"])
    ->name("project-comment.update");

Route::delete("/projetos/{project}/comentarios/{projectComment}", [ProjectCommentController::class, "destroy"])
    ->middleware(["auth", "verified"])
    ->name("project-comment.destroy");

Route::post("/projetos/{project}/comentarios/{projectComment}/like", [ProjectCommentController::class, "like"])
    ->middleware(["auth", "verified"])
    ->name("project-comment.like");


Route::get("/perfil/completar", [CompleteProfileController::class, "create"])
    ->middleware(["auth", "user.not.completed.profile"])
    ->name("profile.complete");

Route::post("/perfil/completar", [CompleteProfileController::class, "store"])
    ->middleware(["auth", "user.not.completed.profile"]);

Route::get("/perfil/editar", [ProfileController::class, "edit"])
    ->middleware(["auth"])
    ->name("profile.edit");

Route::post("/perfil/editar", [ProfileController::class, "update"])
    ->middleware(["auth"])
    ->name("profile.update");

Route::post("/perfil/deletar", [ProfileController::class, "destroy"])
    ->middleware(["auth"])
    ->name("profile.destroy");

Route::get("/perfis/{user}", [ProfileController::class, "show"])
    ->name("profile.show");


Route::get("/sobre", [StaticPageController::class, "about"])
    ->name("static-page.about");

require __DIR__ . "/auth.php";
