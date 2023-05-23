<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AjaxRequestsController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name("accueil");
Route::get('login', [AccountController::class, 'login'])->name("login");
Route::get('logoutadmin', [AccountController::class, 'logoutAdmin'])->name("logoutadmin");
Route::post('login', [AccountController::class, 'logged'])->name("login");
Route::get('userportal', [AccountController::class, 'home'])->name("userportal");
Route::get('images', [AdminController::class, 'images'])->name("galerie");
Route::get('addimage', [AdminController::class, 'addImage'])->name("addimage");
Route::post('addimage', [AdminController::class, 'storeImage'])->name("addimage");
Route::get('editimage/{id}', [AdminController::class, 'editImage'])->name("editimage")->whereNumber('id');
Route::post('editimage/{id}', [AdminController::class, 'updateImage'])->name("editimage")->whereNumber('id');
Route::get('deleteimage/{id}', [AdminController::class, 'deleteImage'])->name("deleteimage")->whereNumber('id');

Route::get('clientportal', [ClientsController::class, 'home'])->name("clientportal");
Route::get('defaultdata', [ClientsController::class, 'defaultData'])->name("defaultdata");
Route::post('defaultdata', [ClientsController::class, 'storeDefaultData'])->name("defaultdata");
Route::get('editdefaultdata/{id}', [ClientsController::class, 'editDefaultData'])->name("editdefaultdata")->whereNumber('id');
Route::post('editdefaultdata/{id}', [ClientsController::class, 'updateDefaultData'])->name("editdefaultdata")->whereNumber('id');
Route::get('userdata', [ClientsController::class, 'userData'])->name("userdata");

Route::get('categories', [AdminController::class, 'categories'])->name("categories");
Route::get('addcategorie', [AdminController::class, 'addCategorie'])->name("addcategorie");
Route::post('addcategorie', [AdminController::class, 'storeCategorie'])->name("addcategorie");
Route::get('editcategorie/{id}', [AdminController::class, 'editCategorie'])->name("editcategorie")->whereNumber('id');
Route::post('editcategorie/{id}', [AdminController::class, 'updateCategorie'])->name("editcategorie")->whereNumber('id');
Route::get('deletecategorie/{id}', [AdminController::class, 'deleteCategorie'])->name("deletecategorie")->whereNumber('id');

Route::get('carte', [AdminController::class, 'carte'])->name("carte");
Route::get('addplat', [AdminController::class, 'addPlat'])->name("addplat");
Route::post('addplat', [AdminController::class, 'storePlat'])->name("addplat");
Route::get('editplat/{id}', [AdminController::class, 'editPlat'])->name("editplat")->whereNumber('id');
Route::post('editplat/{id}', [AdminController::class, 'updatePlat'])->name("editplat")->whereNumber('id');
Route::get('deleteplat/{id}', [AdminController::class, 'deletePlat'])->name("deleteplat")->whereNumber('id');
Route::get('voirecarte', [AdminController::class, 'voireCarte'])->name("voirecarte");

Route::get('menus', [AdminController::class, 'menus'])->name("menus");
Route::get('addmenu', [AdminController::class, 'addMenu'])->name("addmenu");
Route::post('addmenu', [AdminController::class, 'storeMenu'])->name("addmenu");
Route::get('editmenu/{id}', [AdminController::class, 'editMenu'])->name("editmenu")->whereNumber('id');
Route::post('editmenu/{id}', [AdminController::class, 'updateMenu'])->name("editmenu")->whereNumber('id');
Route::get('deletemenu/{id}', [AdminController::class, 'deleteMenu'])->name("deletemenu")->whereNumber('id');
Route::get('voiremenu', [AdminController::class, 'voireMenus'])->name("voiremenu");

Route::get('formules', [AdminController::class, 'formules'])->name("formules");
Route::get('addformule', [AdminController::class, 'addFormule'])->name("addformule");
Route::post('addformule', [AdminController::class, 'storeFormule'])->name("addformule");
Route::get('editformule/{id}', [AdminController::class, 'editFormule'])->name("editformule")->whereNumber('id');
Route::post('editformule/{id}', [AdminController::class, 'updateFormule'])->name("editformule")->whereNumber('id');
Route::get('deleteformule/{id}', [AdminController::class, 'deleteFormule'])->name("deleteformule")->whereNumber('id');

Route::get('jours', [AdminController::class, 'jours'])->name("jours");
Route::get('addjour', [AdminController::class, 'addJour'])->name("addjour");
Route::post('addjour', [AdminController::class, 'storeJour'])->name("addjour");
Route::get('editjour/{id}', [AdminController::class, 'editJour'])->name("editjour")->whereNumber('id');
Route::post('editjour/{id}', [AdminController::class, 'updateJour'])->name("editjour")->whereNumber('id');
Route::get('deletejour/{id}', [AdminController::class, 'deleteJour'])->name("deletejour")->whereNumber('id');

Route::get('reservations', [AdminController::class, 'reservations'])->name("reservations");
Route::get('voirereservation/{id}', [AdminController::class, 'voireReservation'])->name("voirereservation")->whereNumber('id');
Route::get('deletereservation/{id}', [AdminController::class, 'deleteReservation'])->name("deletereservation")->whereNumber('id');

Route::get('horaires', [AdminController::class, 'horaires'])->name("horaires");
Route::get('addhoraire', [AdminController::class, 'addHoraire'])->name("addhoraire");
Route::post('addhoraire', [AdminController::class, 'storeHoraire'])->name("addhoraire");
Route::get('edithoraire/{id}', [AdminController::class, 'editHoraire'])->name("edithoraire")->whereNumber('id');
Route::post('edithoraire/{id}', [AdminController::class, 'updateHoraire'])->name("edithoraire")->whereNumber('id');
Route::get('deletehoraire/{id}', [AdminController::class, 'deleteHoraire'])->name("deletehoraire")->whereNumber('id');

Route::get('convives', [HomeController::class, 'convives'])->name("convives");
Route::get('setconvivesseuil', [HomeController::class, 'setConvivesSeuil'])->name("setconvivesseuil");
Route::post('setconvivesseuil', [HomeController::class, 'setConvivesNombre'])->name("setconvivesseuil");
Route::get('editconvivesseuil/{id}', [HomeController::class, 'editConvivesSeuil'])->name("editconvivesseuil")->whereNumber('id');
Route::post('editconvivesseuil/{id}', [HomeController::class, 'updateConvivesSeuil'])->name("editconvivesseuil")->whereNumber('id');

Route::post('ajaxgettoday', [AjaxRequestsController::class, 'ajaxGetDayName'])->name("ajaxgettoday");
Route::post('ajaxverifierSeuil', [AjaxRequestsController::class, 'ajaxVerifierSeuil'])->name("ajaxverifierseuil");
Route::post('afficherhoraires', [AjaxRequestsController::class, 'ajaxAfficherHoraires'])->name("afficherhoraires");

Route::get('reserver', [HomeController::class, 'reserver'])->name("reserver");
Route::post('reserver', [HomeController::class, 'storeReserver'])->name("reserver");

Route::get('newclient', [ClientsController::class, 'newClient'])->name("newclient");
Route::post('newclient', [ClientsController::class, 'storeNewClient'])->name("newclient");

Route::get('utilisateurs', [AdminController::class, 'Utilisateurs'])->name("utilisateurs");
Route::get('addutilisateur', [AdminController::class, 'addUtilisateur'])->name("addutilisateur");
Route::post('addutilisateur', [AdminController::class, 'storeUtilisateur'])->name("addutilisateur");
Route::get('editutilisateur/{id}', [AdminController::class, 'editUtilisateur'])->name("editutilisateur")->whereNumber('id');
Route::post('editutilisateur/{id}', [AdminController::class, 'updateUtilisateur'])->name("editutilisateur")->whereNumber('id');
Route::get('deleteutilisateur/{id}', [AdminController::class, 'deleteUtilisateur'])->name("deleteutilisateur")->whereNumber('id');
