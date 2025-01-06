<?php 

use Paki\Ticketify\Http\Controllers\TicketController;
use Paki\Ticketify\Http\Controllers\AdminTicketController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::get('tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::post('tickets/store', [TicketController::class, 'store'])->name('tickets.store');
    Route::post('tickets/{ticket}/reply', [TicketController::class, 'reply'])->name('tickets.reply');
    Route::post('tickets/{ticket}/resolve', [TicketController::class, 'markAsResolved'])->name('tickets.resolve');
});

Route::middleware(['auth', 'isAdmin'])->prefix('admin')->group(function () {
    Route::get('/dashboard/tickets', [AdminTicketController::class, 'dashboard'])->name('admin.tickets.dashboard');
    Route::get('tickets', [AdminTicketController::class, 'index'])->name('admin.tickets.index');
    Route::get('tickets/{ticket}', [AdminTicketController::class, 'show'])->name('admin.tickets.show');
    Route::post('tickets/{ticket}/reply', [AdminTicketController::class, 'reply'])->name('admin.tickets.reply');
    Route::post('tickets/{ticket}/close', [AdminTicketController::class, 'close'])->name('admin.tickets.close');
});
// Compare this snippet from src/Models/Ticket.php: