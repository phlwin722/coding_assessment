    <?php 
    use Illuminate\Support\Facades\Route;
    use Illuminate\Http\Request;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\ProductController;


    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

    Route::prefix('auth')->controller(UserController::class)->group(function () {
        Route::post("/login", 'Login');
        Route::middleware("auth:sanctum")->post('/logout', 'Logout');
    });

    Route::prefix('products')->middleware('auth:sanctum')->controller(ProductController::class)->group(function () {
        Route::get("/index", "index");
        Route::post("/create", "create");
        Route::post("/update/{id}", "update");
        Route::delete("/delete/{id}", "delete");
        Route::get('/findData/{id}', 'findData');
    });