<?php

use App\Livewire\Admin\Administrators\IndexAdministrators;
use App\Livewire\Admin\Administrators\CreateAdministrators;
use App\Livewire\Admin\Administrators\EditAdministrator;
use App\Livewire\Admin\Administrators\ShowAdministrator;
use App\Livewire\Admin\Apartments\CreateApartments;
use App\Livewire\Admin\Cities\IndexCities;
use App\Livewire\Admin\Cities\ShowCity;
use App\Livewire\Admin\Condominiums\CreateCondominiums;
use App\Livewire\Admin\Condominiums\EditCondominium;
use App\Livewire\Admin\Condominiums\IndexCondominiums;
use App\Livewire\Admin\Condominiums\ShowCondominium;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Diary\CreateDiary;
use App\Livewire\Admin\Diary\EditDiary;
use App\Livewire\Admin\Diary\IndexDiary;
use App\Livewire\Admin\Diary\ShowDiary;
use App\Livewire\Admin\Documents\IndexDocuments;
use App\Livewire\Admin\Documents\ShowDocuments;
use App\Livewire\Admin\Feedbacks\CreateFeedbacks;
use App\Livewire\Admin\Feedbacks\EditFeedbacks;
use App\Livewire\Admin\Feedbacks\IndexFeedbacks;
use App\Livewire\Admin\Feedbacks\ShowFeedbacks;
use App\Livewire\Admin\Logs\IndexLogs;
use App\Livewire\Admin\NoticesBoard\IndexNotices;
use App\Livewire\Admin\Payments\CreatePayments;
use App\Livewire\Admin\Payments\EditPayments;
use App\Livewire\Admin\Payments\IndexPayments;
use App\Livewire\Admin\Payments\ShowPayments;
use App\Livewire\Admin\Residents\CreateResidents;
use App\Livewire\Admin\Residents\EditResidents;
use App\Livewire\Admin\Residents\IndexResidents;
use App\Livewire\Admin\Residents\ShowResidents;
use App\Livewire\Admin\Settings;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;




Route::get('/', function () {
    return view('welcome');
})->name('home');



Route::middleware(['auth', 'verified', 'role:admin|condomino|amministratore'])->prefix('/admin')->group(function () {
    /* pdf' */
    Route::get('/pdfs', function () {
        return view('admin.pdfs.invoice');
    })->name('pdfs.invoice');
    
    /* DASHBOARD' */
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    /* SETTINGS' */
    Route::get('/settings', Settings::class)->name('settings');

    /* LOGS' */
    Route::get('/logs', IndexLogs::class)->name('logs');

    /* PAYMENTS */
    Route::get('/payments', IndexPayments::class)->name('payments');
    Route::get('/payments/create', CreatePayments::class)->name('payments.create');
    Route::get('/payments/{payment}/show', ShowPayments::class)->name('payments.show');
    Route::get('/payments/{payment}/edit', EditPayments::class)->name('payments.edit');

    /* AGENDA' */
    Route::get('/diary', IndexDiary::class)->name('diary');
    Route::get('/diary/create', CreateDiary::class)->name('diary.create');
    Route::get('/diary/{diary}/show', ShowDiary::class)->name('diary.show');
    Route::get('/diary/{diary}/edit', EditDiary::class)->name('diary.edit');

    /* ARCHIVIO' */
    Route::get('/archive', IndexDocuments::class)->name('archive');
    Route::get('/archive/{condominium}/show', ShowDocuments::class)->name('archive.show');

    /* CITTA' */
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
    Route::get('condominiums/{condominium}/apartments/add', CreateApartments::class)->name('condominums.apartments.add');
    /* FEEDBACKS */
    Route::get('condominiums/{condominium}/feedbacks/', IndexFeedbacks::class)->name('feedbacks');
    Route::get('condominiums/{condominium}/feedbacks/create', CreateFeedbacks::class)->name('feedbacks.create');
    Route::get('condominiums/{condominium}/feedbacks/{feedback}/edit', EditFeedbacks::class)->name('feedbacks.edit');
    Route::get('condominiums/{condominium}/feedbacks/{feedback}/show', ShowFeedbacks::class)->name('feedbacks.show');

    /* NOTICESBOARD */
    Route::get('/notices-board/{condominium}', IndexNotices::class)->name('noticesboard');
});



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

require __DIR__ . '/auth.php';
