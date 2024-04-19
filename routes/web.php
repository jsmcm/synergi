<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;
use App\Http\Middleware\IsAdmin;
use App\Http\Requests\UserRequest;

use Illuminate\Support\Str;

use App\Services\UserService;
use App\Services\CommentService;


Route::get("/", function() {

    if (Auth()->user()) {
        return Redirect::route("profile.edit");
    }

    return Inertia::render('Index');
});


Route::get("/thank-you", function() {
    return Inertia::render("ThankYou", [
        "name" => Request()->query("name"),
    ]);
})->name("user.thanks");


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/users', function () {
    return Inertia::render('UserList', [
        "pageData" => User::whereNotIn("id", [Auth()->user()->id])
                    ->paginate(config("synergi.users.paginationSize"))
    ]);
})->middleware(['auth', IsAdmin::class, 'verified'])->name('user.list');


Route::delete("/users", [UserController::class, "delete"])
    ->middleware(["auth", IsAdmin::class, "verified"])
    ->name("user.delete");


Route::get("/users/edit/{user?}", function (User $user = null) {

    // If the user object is null then we're not editing,
    // we're adding a new user.
    if ($user == null) {
        $user = new User();
    }

    $page = Request()->query('page', 1);

    return Inertia::render("UserEdit", [
        "user"          => $user->load("comments"),
        "currentPage"   => $page
    ]);

})
->middleware(["auth", IsAdmin::class, "verified"])
->name("user.update");



Route::put("/users/edit/{user}", function (User $user, UserRequest $request) {

    $validatedData = $request->validated();

    try {
        $user->name     = $validatedData["name"];
        $user->email    = $validatedData["email"];

        $user->save();

        $commentService = new CommentService();
        $comment = $commentService->store($user, filter_var($validatedData["comment"], FILTER_UNSAFE_RAW));

    } catch (\Exception $e) {

        if ($e->getCode() == 23000) {
            return Redirect::route("user.list", ["page" => Request()->currentPage??1])
            ->with("error", "Failed: this email or mobile is already in use by another user"); // probably won't do this for real. It could leak sensitive data..
        }

        return Redirect::route("user.list")
            ->with("error", "Failed: ".$e->getCode()); // probably won't do this for real. It could leak sensitive data..
    }

    return Redirect::route('user.list', ["page" => Request()->currentPage??1])
        ->with("message", "User Saved!");

})
->middleware(["auth", IsAdmin::class, "verified"])
->name("user.put");


Route::post("/users", function (UserRequest $request) {

    $validatedData = $request->validated();

    try {

        $userService = new UserService();
        $user = $userService->store($validatedData["role"]??"client", $validatedData["name"], $validatedData["email"], Hash::make(Str::random(64)));

        if ($user && $validatedData["comment"]) {
            $commentService = new CommentService();
            $comment = $commentService->store($user, filter_var($validatedData["comment"], FILTER_UNSAFE_RAW));
        }

    } catch (\Exception $e) {

        if ($e->getCode() == 23000) {

            if (Auth()->user() && Auth()->user()->role == "admin") {
                return Redirect::route("user.list", ["page" => Request()->currentPage??1])
                    ->with("error", "Failed: this email is already registered. Please log in instead."); // probably won't do this for real. It could leak sensitive data..
            } else {
                return Redirect::back()
                    ->with("error", "Failed: this email is already registered. Please log in instead."); // probably won't do this for real. It could leak sensitive data..
            }
        }

        if (Auth()->user() && Auth()->user()->role == "admin") {
            return Redirect::route("user.list")
                ->with("error", "Failed: ".$e->getMessage()); // probably won't do this for real. It could leak sensitive data..
        } else {
            return Redirect::back()
            ->with("error", "Failed: ".$e->getMessage()); // probably won't do this for real. It could leak sensitive data..  
        }
    }

    if (Auth()->user() && Auth()->user()->role == "admin") {
        return Redirect::route('user.list', ["page" => Request()->currentPage??1])
            ->with("message", "User Added!");
    } else {
        return Redirect::route('user.thanks', ["name" => $user->name]); 
    }

})
->name("user.post");


Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
