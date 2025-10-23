<?php

use App\Livewire\Admin\Administrators\IndexAdministrators;
use App\Livewire\Admin\Administrators\CreateAdministrators;
use App\Livewire\Admin\Administrators\EditAdministrator;
use App\Livewire\Admin\Administrators\ShowAdministrator;
use App\Livewire\Admin\Apartments\CreateApartments;
use App\Livewire\Admin\Apartments\EditApartments;
use App\Livewire\Admin\Cities\IndexCities;
use App\Livewire\Admin\Cities\ShowCity;
use App\Livewire\Admin\Condominiums\CreateCondominiums;
use App\Livewire\Admin\Condominiums\EditCondominium;
use App\Livewire\Admin\Condominiums\IndexCondominiums;
use App\Livewire\Admin\Condominiums\ShowCondominium;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Residents\CreateResidents;
use App\Livewire\Admin\Residents\EditResidents;
use App\Livewire\Admin\Residents\IndexResidents;
use App\Livewire\Admin\Residents\ShowResidents;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

/* Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard'); */

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('/admin')->group(function () {

    /* CITTA' */
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/cities', IndexCities::class)->name('cities');
    Route::get('/cities/{city}/show', ShowCity::class)->name('cities.show');

    /* AMMINISTRATORE */
    Route::get('/administrators', IndexAdministrators::class)->name('administrators');
    Route::get('/administrators/create', CreateAdministrators::class)->name('amministrators.create');
    Route::get('/administrators/{administrator}/edit', EditAdministrator::class)->name('amministrators.edit');
    Route::get('/administrators/{administrator}/show', ShowAdministrator::class)->name('amministrators.show');

    /* RESIDENTI */
    Route::get('/residents', IndexResidents::class)->name('residents');
    Route::get('/residents/create', CreateResidents::class)->name('residents.create');
    Route::get('/residents/{resident}/edit', EditResidents::class)->name('residents.edit');
    Route::get('/residents/{resident}/show', ShowResidents::class)->name('residents.show');

    /* CONDOMINI */
    Route::get('/condominiums', IndexCondominiums::class)->name('condominiums');
    Route::get('/condominiums/create', CreateCondominiums::class)->name('condominiums.create');
    Route::get('/condominiums/{condominium}/edit', EditCondominium::class)->name('condominiums.edit');
    Route::get('/condominiums/{condominium}/show', ShowCondominium::class)->name('condominiums.show');
    /* APPARTAMENTI */
    Route::get('condominiums/{condominium}/apartments/create', CreateApartments::class)->name('condominums.apartments.create');
    Route::get('condominiums/{condominium}/apartments/{apartment}/edit', EditApartments::class)->name('condominums.apartments.edit');

    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

require __DIR__ . '/auth.php';
