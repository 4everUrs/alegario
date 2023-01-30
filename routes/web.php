<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Ap\AccountPayables;
use App\Http\Livewire\Ar\AccountsRecievable;
use App\Http\Livewire\Bm\Allocation;
use App\Http\Livewire\Bm\History;
use App\Http\Livewire\Bm\RequestList;
use App\Http\Livewire\Collections\Collections;
use App\Http\Livewire\Disbursement\DisburseRequests;
use App\Http\Livewire\General\ChartOfAccounts;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('/login');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('bm/requests', RequestList::class)->name('bmrequest');
    Route::get('bm/allocation', Allocation::class)->name('bmallocation');
    Route::get('bm/history', History::class)->name('bmhistory');
    Route::get('disburse/request', DisburseRequests::class)->name('disburserequest');
    Route::get('general/charts-of-accounts', ChartOfAccounts::class)->name('generalchart');
    Route::get('collections', Collections::class)->name('collections');
    Route::get('recievable', AccountsRecievable::class)->name('recievables');
    Route::get('payables', AccountPayables::class)->name('payables');
});

require __DIR__ . '/auth.php';
