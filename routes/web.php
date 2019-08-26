<?php
use App\User;
use Illuminate\Http\Request;
use App\Events\Registered;
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
    return view('welcome');
});

Route::get('/register', function () {
    return view('register');
});
Route::get('/login', function () {
    return view('login');
});
Route::post('/register', function (Request $request) {
    $user = new User();
    $user->fill($request->all());
    $user->save();
    event(new Registered($user));
    return 'đăng kí thành công';
});
Route::post('/login', function (Request $request) {
    $email = $request->email;
    $password=$request->password;
    if (Auth::attempt(['email' => $email, 'password' => $password])) {
   		return 'đăng nhập thành công';
	}
	else{
		return 'sai email hoặc password';
	}
    // var_dump($password);
});



