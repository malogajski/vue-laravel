<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\IndustriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Get Contacts
Route::get('getContacts', [ContactController::class, 'getContacts']);
// Get Contact
Route::get('getContact/{id}', [ContactController::class, 'getContact']);
// Save Contacts
Route::post('setContact', [ContactController::class, 'setContact']);
// Update Contacts
Route::post('updateContact/{id}', [ContactController::class, 'updateContact']);
// Delete Contact
Route::delete('deleteContact/{id}', [ContactController::class, 'deleteContact']);

// INDUSTRY
// Get industries
Route::get('getIndustries', [IndustriesController::class, 'getIndustries']);
// Get industry
Route::get('getIndustry/{id}', [IndustriesController::class, 'getIndustry']);
// Set industry
Route::post('setIndustry', [IndustriesController::class, 'setIndustry']);
// Update industry
Route::post('updateIndustry/{id}', [IndustriesController::class, 'updateIndustry']);
// Delete industry
Route::delete('deleteIndustry/{id}', [IndustriesController::class, 'deleteIndustry']);



