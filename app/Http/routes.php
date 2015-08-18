<?php

Route::get('/', ['as'=>'home', function () {
    //return view('welcome');
    return view('admin.layouts.default');
    //return view('errors.503');
}]);

Route::get('test', ['as'=>'test', function () {
    return view('webfront.register');
}]);

//Admin Section
Route::get('admin/login', ['as' => 'admin.login', 'uses' => 'Auth\AdminAuthController@getLogin']);
Route::post('admin/login', ['as' => 'admin.login', 'uses' => 'Auth\AdminAuthController@postLogin']);
Route::get('admin/register', ['as' => 'admin.register', 'uses' => 'AdminHomeController@showRegister']);
Route::post('admin/register', ['as' => 'admin.register', 'uses' => 'AdminHomeController@doRegister']);

Route::group(['prefix'=>'admin'], function() {

    Route::get('/logout', array('as' => 'admin.logout', 'uses' => 'Auth\AdminAuthController@getLogout'));

    Route::group(['middleware'=>['auth.admin']], function() {

      Route::get('/dashboard', ['as'=>'admin.home', function () {
          return view('admin.layouts.default');
      }]);
    });

});


Route::group(['middleware'=>['auth.admin']], function() {
	//Masterentries
	 Route::group(['prefix'=>'master', 'namespace'=>'Master'], function() {

		   Route::resource('/industrytypes', 'IndustryTypeController', ['except' => ['show']]);
       Route::resource('/departmenttypes', 'DepartmentTypeController', ['except' => ['show']]);
       Route::resource('/exams', 'ExamController', ['except' => ['show']]);
       Route::resource('/boards', 'BoardController', ['except' => ['show']]);
       Route::resource('/subjects', 'SubjectsController', ['except' => ['show']]);
       Route::resource('/languages', 'LanguagesController', ['except' => ['show']]);
       Route::resource('/casts', 'CasteController', ['except' => ['show']]);
       Route::resource('/states', 'StateController', ['except' => ['show']]);
       Route::resource('/districts', 'DistrictController', ['except' => ['show']]);
       Route::resource('/proof_details', 'ProofDetailsController', ['except' => ['show']]);

	 });
});

//Public webfront routes
Route::get('/register', ['as' => 'candidate.register', 'uses' => 'WebfrontController@showRegister']);
Route::post('/register', ['as' => 'candidate.store', 'uses' => 'WebfrontController@doRegister']);

//Candidate Section
Route::get('/login', ['as' => 'candidate.login', 'uses' => 'Auth\CandidateAuthController@getLogin']);
Route::post('/login', ['as' => 'candidate.login', 'uses' => 'Auth\CandidateAuthController@postLogin']);

Route::group(['middleware'=>['auth.candidate'], 'prefix'=>'candidate'], function() {

    Route::get('/logout', array('as' => 'candidate.logout', 'uses' => 'Auth\CandidateAuthController@getLogout'));
    Route::get('/home', ['as' => 'candidate.home', 'uses' => 'CandidateHomeController@showHome']);
    Route::get('/create_resume', ['as' => 'candidate.create.resume', 'uses' => 'CandidateHomeController@createResume']);
    Route::post('/create_resume', ['as' => 'candidate.store.resume', 'uses' => 'CandidateHomeController@storeResume']);
    Route::get('/edit_resume', ['as' => 'candidate.edit.resume', 'uses' => 'CandidateHomeController@editResume']);
    Route::post('/edit_resume', ['as' => 'candidate.update.resume', 'uses' => 'CandidateHomeController@updateResume']);
    Route::get('/create_edu_details', ['as' => 'candidate.create.edu_details', 'uses' => 'CandidateHomeController@createEdu_details']);
    Route::post('/create_edu_details', ['as' => 'candidate.store.edu_details', 'uses' => 'CandidateHomeController@storeEdu_details']);
    Route::get('/create_experience_details', ['as' => 'candidate.create.exp_details', 'uses' => 'CandidateHomeController@createExperience_details']);
    Route::post('/create_experience_details', ['as' => 'candidate.store.exp_details', 'uses' => 'CandidateHomeController@storeExperience_details']);
    Route::get('/create_language_details', ['as' => 'candidate.create.language_details', 'uses' => 'CandidateHomeController@createLanguage_details']);
    Route::post('/create_language_details', ['as' => 'candidate.store.language_details', 'uses' => 'CandidateHomeController@storeLanguage_details']);

    Route::get('/get_identitycard', ['as' => 'candidate.get.i_card', 'uses' => 'CandidateHomeController@get_identitycard']);
});

Route::controllers([
  //Public webfront routes
	//'ww' => 'WebfrontController'
]);
