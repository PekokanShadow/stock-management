<?php

use App\Http\Controllers\{
    HubController,
    InventoryController,
    MonitorController,
    NotebookController,
    UpsController,
    PrinterController,
    KomputerController,
    OtherController,
    StockController,
    BarcodeController,
    ProfileController,
    RoleController,
    SettingController,
    UserController
};
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

// Redirect the home route to the inventory rekap page
Route::get('/', function () {
    return redirect('profile');
});

// Authentication routes
Auth::routes();

// Protect all routes with authentication middleware
Route::middleware(['auth'])->group(function () {

    // Inventory Rekap Route
    Route::get('/inventory/rekap', [StockController::class, 'stock'])->name('inventory.rekap');

    // Account Routes

    Route::get('/profile/account', [ProfileController::class, 'account'])->name('profile.account');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Role Management Routes
    Route::get('profile/role', [RoleController::class, 'index'])->name('role.index');
    Route::get('/profile/createrole', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/profile/role', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/profile/editrole/{role}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/profile/role/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/profile/createrole/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

    // User Management Routes
    Route::get('/profile/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/profile/createuser', [UserController::class, 'createuser'])->name('profile.createuser');
    Route::post('/profile/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/profile/edituser/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/profile/user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('profile/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    // Inventory CRUD Routes
    Route::get('/inventory/create', [InventoryController::class, 'create'])->name('inventory.create');
    Route::post('/inventory/store', [InventoryController::class, 'store'])->name('inventory.store');
    Route::get('/inventory/edit/{stocknumber}', [InventoryController::class, 'edit'])->name('inventory.edit');
    Route::put('/inventory/update/{stocknumber}', [InventoryController::class, 'update'])->name('inventory.update');
    Route::get('/inventory/details/{stocknumber}', [InventoryController::class, 'show'])->name('inventory.details');
    Route::delete('/inventory/{stocknumber}', [InventoryController::class, 'destroy'])->name('inventory.delete');

    Route::get('/inventory/komputer', [KomputerController::class, 'komputer'])->name('inventory.komputer');
    Route::get('/inventory/komputer/create', [KomputerController::class, 'create'])->name('inventory.komputer.create');
    Route::post('/inventory/komputer', [KomputerController::class, 'store'])->name('inventory.komputer.store');
    Route::get('/inventory/komputer/{komputer}/edit', [KomputerController::class, 'edit'])->name('inventory.komputer.edit');
    Route::put('/inventory/komputer/{komputer}', [KomputerController::class, 'update'])->name('inventory.komputer.update');
    Route::delete('/inventory/komputer/{stocknumber}', [KomputerController::class, 'destroy']);
    // Notebook routes
    Route::get('/inventory/notebook', [NotebookController::class, 'notebook'])->name('inventory.notebook');
    Route::get('/inventory/notebook/create', [NotebookController::class, 'create'])->name('inventory.notebook.create');
    Route::post('/inventory/notebook', [NotebookController::class, 'store'])->name('inventory.notebook.store');
    Route::get('/inventory/notebook/{notebook}/edit', [NotebookController::class, 'edit'])->name('inventory.notebook.edit');
    Route::put('/inventory/notebook/{notebook}', [NotebookController::class, 'update'])->name('inventory.notebook.update');
    Route::delete('/inventory/notebook/{stocknumber}', [NotebookController::class, 'destroy']);

    // Monitor routes
    Route::get('/inventory/monitor', [MonitorController::class, 'monitor'])->name('inventory.monitor');
    Route::get('/inventory/monitor/create', [MonitorController::class, 'create'])->name('inventory.monitor.create');
    Route::post('/inventory/monitor', [MonitorController::class, 'store'])->name('inventory.monitor.store');
    Route::get('/inventory/monitor/{monitor}/edit', [MonitorController::class, 'edit'])->name('inventory.monitor.edit');
    Route::put('/inventory/monitor/{monitor}', [MonitorController::class, 'update'])->name('inventory.monitor.update');
    Route::delete('/inventory/monitor/{stocknumber}', [MonitorController::class, 'destroy']);

    // UPS routes
    Route::get('/inventory/ups', [UpsController::class, 'ups'])->name('inventory.ups');
    Route::get('/inventory/ups/create', [UpsController::class, 'create'])->name('inventory.ups.create');
    Route::post('/inventory/ups', [UpsController::class, 'store'])->name('inventory.ups.store');
    Route::get('/inventory/ups/{ups}/edit', [UpsController::class, 'edit'])->name('inventory.ups.edit');
    Route::put('/inventory/ups/{ups}', [UpsController::class, 'update'])->name('inventory.ups.update');
    Route::delete('/inventory/ups/{stocknumber}', [UpsController::class, 'destroy']);

    // Printer routes
    Route::get('/inventory/printer', [PrinterController::class, 'printer'])->name('inventory.printer');
    Route::get('/inventory/printer/create', [PrinterController::class, 'create'])->name('inventory.printer.create');
    Route::post('/inventory/printer', [PrinterController::class, 'store'])->name('inventory.printer.store');
    Route::get('/inventory/printer/{printer}/edit', [PrinterController::class, 'edit'])->name('inventory.printer.edit');
    Route::put('/inventory/printer/{printer}', [PrinterController::class, 'update'])->name(' inventory.printer.update');
    Route::delete('/inventory/printer/{stocknumber}', [PrinterController::class, 'destroy']);

    // Hub routes
    Route::get('/inventory/hub', [HubController::class, 'hub'])->name('inventory.hub');
    Route::get('/inventory/hub/create', [HubController::class, 'create'])->name('inventory.hub.create');
    Route::post('/inventory/hub', [HubController::class, 'store'])->name('inventory.hub.store');
    Route::get('/inventory/hub/{hub}/edit', [HubController::class, 'edit'])->name('inventory.hub.edit');
    Route::put('/inventory/hub/{hub}', [HubController::class, 'update'])->name('inventory.hub.update');
    Route::delete('/inventory/hub/{stocknumber}', [hubController::class, 'destroy']);

    // Other routes
    Route::get('/inventory/other', [OtherController::class, 'other'])->name('inventory.other');
    Route::get('/inventory/other/create', [OtherController::class, 'create'])->name('inventory.other.create');
    Route::post('/inventory/other', [otherController::class, 'store'])->name('inventory.other.store');
    Route::get('/inventory/other/{other}/edit', [otherController::class, 'edit'])->name('inventory.other.edit');
    Route::put('/inventory/other/{other}', [otherController::class, 'update'])->name('inventory.other.update');
    Route::delete('/inventory/other/{stocknumber}', [otherController::class, 'destroy']);

    // Rekap routes
    Route::get('/inventory/rekap', [StockController::class, 'stock'])->name('inventory.rekap');
    Route::get('/inventory/rekap/create', [StockController::class, 'create'])->name('inventory.rekap.create');
    Route::post('/inventory/rekap', [StockController::class, 'store'])->name('inventory.rekap.store');
    Route::get('/inventory/rekap/{rekap}/edit', [StockController::class, 'edit'])->name('inventory.rekap.edit');
    Route::put('/inventory/rekap/{rekap}', [StockController::class, 'update'])->name('inventory.rekap.update');
    Route::delete('/inventory/rekap/{stocknumber}', [StockController::class, 'destroy']);

    Route::get('/generate-barcode/{stocknumber}', [BarcodeController::class, 'generateBarcode'])
        ->where('stocknumber', '.*')
        ->name('generate.barcode');

    // Route to give permissions to a role
    Route::get('give-permission-to-role', function () {
        $role = Role::findOrFail(1); // Example role ID, adjust as needed
        $permissions = Permission::all(); // Get all permissions

        $role->givePermissionTo($permissions); // Assign all permissions to the role

        return 'Permissions assigned to role successfully!';
    });
});
