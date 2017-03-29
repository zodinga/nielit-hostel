<?php
use Illuminate\Support\Facades\Input;
use App\hmsModel\Room;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middlewareGroups'=>['web']],function(){

	Route::get('/',['as'=>'public.index','uses'=>'PublicController@getIndex']);
	Route::get('about',['as'=>'public.about','uses'=>'PublicController@getAbout']);
	Route::get('contact',['as'=>'public.contact','uses'=>'PublicController@getContact']);
	Route::post('contact',['as'=>'public.contact','uses'=>'PublicController@postContact']);
	//Authentication
	Route::get('auth/login',['as'=>'login','uses'=>'Auth\AuthController@getLogin']);
	Route::post('auth/login','Auth\AuthController@postLogin');
	Route::get('auth/logout',['as'=>'logout','uses'=> 'Auth\AuthController@getLogout']);

	//Registration
	Route::get('auth/register','Auth\AuthController@getRegister');
	Route::post('auth/register','Auth\AuthController@postRegister');

	//Password Reset Routes
	Route::get('password/reset/{token?}','Auth\PasswordController@showResetForm');
	Route::post('password/email','Auth\PasswordController@sendResetLinkEmail');
	Route::post('password/reset','Auth\PasswordController@reset');
	//End Auth

	Route::get('dashboard',['uses'=>'Hms\DashboardController@getDashboard','as'=>'dashboard']);

	//STUDENTS SEX ASSIGN
	Route::post('sex',['uses'=>'Hms\AdmissionController@postAssign', 'as'=>'sex.assign','middleware' => 'roles','roles' => ['Admin']]);
	//END STUDENTS SEX ASSIGN

	//FacultyS
	//Route::resource('users','UserController',['except'=>['create']]);
	Route::get('users',['as'=>'users.index','uses'=>'UserController@index','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::get('users/create',['as'=>'users.create','uses'=>'UserController@create','middleware' => 'roles','roles' => ['Admin']]);
	Route::post('users/create',['as'=>'users.store','uses'=>'UserController@store','middleware' => 'roles','roles' => ['Admin']]);
	Route::get('users/{id}',['as'=>'users.show','uses'=>'UserController@show','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::get('users/{id}/edit',['as'=>'users.edit','uses'=>'UserController@edit','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::put('users/{id}',['as'=>'users.update','uses'=>'UserController@update','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::delete('users/{id}',['as'=>'users.destroy','uses'=>'UserController@destroy','middleware' => 'roles','roles' => ['Admin']]);
	//END USERS

	//Admin Route
	Route::post('assign',['uses'=>'AdminController@postAssign', 'as'=>'admin.assign','middleware' => 'roles','roles' => ['Admin']]);

	//HOSTEL MGT SYSTEM
	//SEARCH
	Route::get('students/search', ['uses'=>'Hms\AdmissionController@search','as'=>'hms.students.search','middleware'=>'roles','roles'=>['Reception','Admin','Warden']
		]);
	//END SEARCH
	//ADMISSION
	Route::get('admissions',['as'=>'admissions','uses'=>'Hms\AdmissionController@index','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::get('admissions/create/{id}',['as'=>'admissions.create','uses'=>'Hms\AdmissionController@create','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::post('admissions/create',['as'=>'admissions.store','uses'=>'Hms\AdmissionController@store','middleware' => 'roles','roles' => ['Admin','Warden']]);
	//END ADMISSION

	//HOSTELLER
	Route::get('hostellers',['as'=>'hostellers.index','uses'=>'Hms\HostellerController@index','middleware'=>'roles','roles'=>['Admin','Warden']]);
	Route::get('hostellers/create',['as'=>'hostellers.create','uses'=>'Hms\HostellerController@create','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::post('hostellers/create',['as'=>'hostellers.store','uses'=>'Hms\HostellerController@store','middleware' => 'roles','roles' => ['Admin','Warden']]);

	Route::get('hostellers/new',['as'=>'hostellers.new','uses'=>'Hms\HostellerController@new','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::post('hostellers/new',['as'=>'hostellers.save','uses'=>'Hms\HostellerController@save','middleware' => 'roles','roles' => ['Admin','Warden']]);

	Route::get('hostellers/{id}',['as'=>'hostellers.show','uses'=>'Hms\HostellerController@show','middleware'=>'roles','roles'=>['Admin','Warden']]);
	Route::get('hostellers/{id}/edit',['as'=>'hostellers.edit','uses'=>'Hms\HostellerController@edit','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::put('hostellers/{id}',['as'=>'hostellers.update','uses'=>'Hms\HostellerController@update','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::delete('hostellers/{id}',['as'=>'hostellers.destroy','uses'=>'Hms\HostellerController@destroy','middleware' => 'roles','roles' => ['Admin','Warden']]);
	//END HOSTELLER

	//ROOM
	Route::get('rooms',['as'=>'rooms.index','uses'=>'Hms\RoomController@index','middleware'=>'roles','roles'=>['Admin','Warden']]);
	Route::get('rooms/create',['as'=>'rooms.create','uses'=>'Hms\RoomController@create','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::post('rooms/create',['as'=>'rooms.store','uses'=>'Hms\RoomController@store','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::get('rooms/{id}',['as'=>'rooms.show','uses'=>'Hms\RoomController@show','middleware'=>'roles','roles'=>['Admin','Warden']]);
	Route::get('rooms/{id}/edit',['as'=>'rooms.edit','uses'=>'Hms\RoomController@edit','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::put('rooms/{id}',['as'=>'rooms.update','uses'=>'Hms\RoomController@update','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::delete('rooms/{id}',['as'=>'rooms.destroy','uses'=>'Hms\RoomController@destroy','middleware' => 'roles','roles' => ['Admin','Warden']]);
	//END ROOM

	Route::get('/ajax-room',function(){
		$id=Input::get('id');
		$rooms=Room::where('building','=',$id)->get();
		return Response::json($rooms);
	});

	//ADMIT FEE
	Route::get('admitFee',['as'=>'admitFee.index','uses'=>'Hms\admitFeeController@index','middleware'=>'roles','roles'=>['Admin','Warden']]);
	Route::get('admitFee/create',['as'=>'admitFee.create','uses'=>'Hms\admitFeeController@create','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::post('admitFee/create',['as'=>'admitFee.store','uses'=>'Hms\admitFeeController@store','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::get('admitFee/{id}',['as'=>'admitFee.show','uses'=>'Hms\admitFeeController@show','middleware'=>'roles','roles'=>['Admin','Warden']]);
	Route::get('admitFee/{id}/edit',['as'=>'admitFee.edit','uses'=>'Hms\admitFeeController@edit','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::put('admitFee/{id}',['as'=>'admitFee.update','uses'=>'Hms\admitFeeController@update','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::delete('admitFee/{id}',['as'=>'admitFee.destroy','uses'=>'Hms\admitFeeController@destroy','middleware' => 'roles','roles' => ['Admin','Warden']]);
	//SEARCH
	Route::get('searchAdmit',['uses'=>'Hms\admitFeeController@search','as'=>'hms.admitFee.search','middleware'=>'roles','roles'=>['Reception','Admin','Warden']]);
	//END SEARCH
	//END ADMIT FEE

	//ROOM RENT
	Route::get('roomRent',['as'=>'roomRent.index','uses'=>'Hms\roomRentController@index','middleware'=>'roles','roles'=>['Admin','Warden']]);
	Route::get('roomRent/create/{id}',['as'=>'roomRent.create','uses'=>'Hms\roomRentController@create','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::post('roomRent/create',['as'=>'roomRent.store','uses'=>'Hms\roomRentController@store','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::get('roomRent/{id}',['as'=>'roomRent.show','uses'=>'Hms\roomRentController@show','middleware'=>'roles','roles'=>['Admin','Warden']]);
	Route::get('roomRent/{id}/edit',['as'=>'roomRent.edit','uses'=>'Hms\roomRentController@edit','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::put('roomRent/{id}',['as'=>'roomRent.update','uses'=>'Hms\roomRentController@update','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::delete('roomRent/{id}',['as'=>'roomRent.destroy','uses'=>'Hms\roomRentController@destroy','middleware' => 'roles','roles' => ['Admin','Warden']]);
	//SEARCH
	Route::get('searchRent', ['uses'=>'Hms\roomRentController@search','as'=>'hms.roomRent.search','middleware'=>'roles','roles'=>['Reception','Admin','Warden']
		]);
	//END SEARCH
	//END ROOM RENT

	//MESS FEE
	Route::get('messFee',['as'=>'messFee.index','uses'=>'Hms\messFeeController@index','middleware'=>'roles','roles'=>['Admin','Warden']]);
	Route::get('messFee/create/{id}',['as'=>'messFee.create','uses'=>'Hms\messFeeController@create','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::post('messFee/create',['as'=>'messFee.store','uses'=>'Hms\messFeeController@store','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::get('messFee/{id}',['as'=>'messFee.show','uses'=>'Hms\messFeeController@show','middleware'=>'roles','roles'=>['Admin','Warden']]);
	Route::get('messFee/{id}/edit',['as'=>'messFee.edit','uses'=>'Hms\messFeeController@edit','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::put('messFee/{id}',['as'=>'messFee.update','uses'=>'Hms\messFeeController@update','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::delete('messFee/{id}',['as'=>'messFee.destroy','uses'=>'Hms\messFeeController@destroy','middleware' => 'roles','roles' => ['Admin','Warden']]);
	//SEARCH
	Route::get('searchMess', ['uses'=>'Hms\messFeeController@search','as'=>'hms.messFee.search','middleware'=>'roles','roles'=>['Reception','Admin','Warden']
		]);
	//END SEARCH
	//END MESS FEE

	//ACCOUNT
	Route::get('account',['as'=>'account.index','uses'=>'Hms\AccountController@index','middleware'=>'roles','roles'=>['Admin','Warden']]);
	Route::get('account/create/{id}',['as'=>'account.create','uses'=>'Hms\AccountController@create','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::post('account/create',['as'=>'account.store','uses'=>'Hms\AccountController@store','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::get('account/{id}',['as'=>'account.show','uses'=>'Hms\AccountController@show','middleware'=>'roles','roles'=>['Admin','Warden']]);
	Route::get('account/{id}/edit',['as'=>'account.edit','uses'=>'Hms\AccountController@edit','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::put('account/{id}',['as'=>'account.update','uses'=>'Hms\AccountController@update','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::delete('account/{id}',['as'=>'account.destroy','uses'=>'Hms\AccountController@destroy','middleware' => 'roles','roles' => ['Admin','Warden']]);
	//END ACCOUNT

	//MESS ACCOUNT
	Route::get('messAccount',['as'=>'messAccount.index','uses'=>'Hms\messAccountController@index','middleware'=>'roles','roles'=>['Admin','Warden']]);
	Route::get('messAccount/create/{id}',['as'=>'messAccount.create','uses'=>'Hms\messAccountController@create','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::post('messAccount/create',['as'=>'messAccount.store','uses'=>'Hms\messAccountController@store','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::get('messAccount/{id}',['as'=>'messAccount.show','uses'=>'Hms\messAccountController@show','middleware'=>'roles','roles'=>['Admin','Warden']]);
	Route::get('messAccount/{id}/edit',['as'=>'messAccount.edit','uses'=>'Hms\messAccountController@edit','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::put('messAccount/{id}',['as'=>'messAccount.update','uses'=>'Hms\messAccountController@update','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::delete('messAccount/{id}',['as'=>'messAccount.destroy','uses'=>'Hms\messAccountController@destroy','middleware' => 'roles','roles' => ['Admin','Warden']]);
	//END MESS ACCOUNT

	//DISCHARGE
	Route::get('discharge',['as'=>'discharge.index','uses'=>'Hms\DischargeController@index','middleware'=>'roles','roles'=>['Admin','Warden']]);
	Route::get('discharge/create/{id}',['as'=>'discharge.create','uses'=>'Hms\DischargeController@create','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::post('discharge/create',['as'=>'discharge.store','uses'=>'Hms\DischargeController@store','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::get('discharge/{id}',['as'=>'discharge.show','uses'=>'Hms\DischargeController@show','middleware'=>'roles','roles'=>['Admin','Warden']]);
	Route::get('discharge/{id}/edit',['as'=>'discharge.edit','uses'=>'Hms\DischargeController@edit','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::put('discharge/{id}',['as'=>'discharge.update','uses'=>'Hms\DischargeController@update','middleware' => 'roles','roles' => ['Admin','Warden']]);
	Route::delete('discharge/{id}',['as'=>'discharge.destroy','uses'=>'Hms\DischargeController@destroy','middleware' => 'roles','roles' => ['Admin','Warden']]);
	//END DISCHARGE

	//REPORTS
	Route::get('reports',['as'=>'reports.index','uses'=>'Hms\ReportController@index','middleware'=>'roles','roles'=>['Admin','Warden']]);
	Route::get('reports/custom',['as'=>'reports.custom','uses'=>'Hms\ReportController@custom','middleware'=>'roles','roles'=>['Admin','Warden']]);
	Route::post('reports/custom',['as'=>'reports.custom_export','uses'=>'Hms\ReportController@custom_export','middleware'=>'roles','roles'=>['Admin','Warden']]);
	//END REPORTS

	
	//END HOSTEL MGT SYSTEM
	
});