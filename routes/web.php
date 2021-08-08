<?php
Route::get('/', function () {
    return redirect('/home');
});

// Auth::routes();

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');
$this->get('oauth2google', 'Auth\Oauth2Controller@oauth2google')->name('oauth2google');
$this->get('googlecallback', 'Auth\Oauth2Controller@googlecallback')->name('googlecallback');
$this->get('oauth2facebook', 'Auth\Oauth2Controller@oauth2facebook')->name('oauth2facebook');
$this->get('facebookcallback', 'Auth\Oauth2Controller@facebookcallback')->name('facebookcallback');
$this->get('oauth2github', 'Auth\Oauth2Controller@oauth2github')->name('oauth2github');
$this->get('githubcallback', 'Auth\Oauth2Controller@githubcallback')->name('githubcallback');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
$this->post('register', 'Auth\RegisterController@register')->name('auth.register');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('auth.password.email');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');


Route::group(['middleware' => 'auth'], function () {
    // Route::get('ajax',function() {
    //    return view('message');
    // });
    // Route::get('search', 'TopicsController@index')->name('search');
    Route::get('autocomplete', 'TopicsController@autocomplete')->name('autocomplete');
    Route::post('/getmsg','AjaxController@index');
    Route::get('/home', 'HomeController@index');
    // Route::get('tests_class/{topics_id}', 'TestsController@class');
    Route::get('tests_class/{topics_id}', 'TestsController@class');
    Route::post('results/score', 'ResultsController@score')->name('results_score');
    // Route::get('/tests_class', 'TestsController');
    // Route::post('/tests/class', 'TestsController@create')->name('register');
    Route::resource('tests', 'TestsController');
    Route::resource('class', 'ClassController');
    // Route::resource('tests_class', 'TestsController@class');
    Route::resource('roles', 'RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'UsersController');
    Route::post('users_mass_destroy', ['uses' => 'UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('user_actions', 'UserActionsController');
    Route::resource('topics', 'TopicsController');
    Route::post('topics_mass_destroy', ['uses' => 'TopicsController@massDestroy', 'as' => 'topics.mass_destroy']);
    Route::resource('questions', 'QuestionsController');
    Route::post('questions_mass_destroy', ['uses' => 'QuestionsController@massDestroy', 'as' => 'questions.mass_destroy']);
    Route::resource('questions_options', 'QuestionsOptionsController');
    Route::post('questions_options_mass_destroy', ['uses' => 'QuestionsOptionsController@massDestroy', 'as' => 'questions_options.mass_destroy']);
    Route::resource('results', 'ResultsController');
    Route::post('results_mass_destroy', ['uses' => 'ResultsController@massDestroy', 'as' => 'results.mass_destroy']);
    Route::get('/lucky_draw', 'HomeController@luckyDraw')->name('lucky_draw');
    Route::get('/box_page', 'HomeController@boxPage')->name('box_page');
    Route::get('/get-users-by-class/{id}', 'HomeController@getUsersByClass');
    Route::resource('uploads', 'UploadsController');
    Route::post('upload_mass_destroy', ['uses' => 'UploadsController@massDestroy', 'as' => 'upload.mass_destroy']);

});
