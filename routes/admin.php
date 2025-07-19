use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;

Route::get('/admin', [AdminController::class, 'index']);
Route::get('/admin/login', [AdminAuthController::class, 'login']);

Route::prefix('admin')->group(function () {
    // Login form
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');

    // Submit login form
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

    // Logout
    Route::post('/logout', function () {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    })->name('admin.logout');
});
Route::middleware('guest:admin')->group(function () {
    Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
});

