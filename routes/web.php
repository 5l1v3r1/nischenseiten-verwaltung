<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | This file is where you may define all of the routes that are handled
  | by your application. Just tell Laravel the URIs it should respond
  | to using a Closure or controller method. Build something great!
  |
 */

Route::get('/', 'HomeController@redirectToDashboard');

Route::get('/home', 'HomeController@redirectToDashboard');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->middleware('auth');

Route::group(['middleware' => 'auth', 'prefix' => 'ideas'], function () {
    Route::get('index', 'IdeasController@index');
    Route::post('index', 'IdeasController@postIdeaSearch');
    Route::get('notes/{idea}', 'IdeasController@updateNotes')->where('idea', '^[1-9][0-9]*$')->name('idea.notes');
    Route::post('notes', 'IdeasController@postUpdateIdea');
});

Route::group(['middleware' => 'auth', 'prefix' => 'settings'], function () {
    Route::get('categories/index', 'IdeasCategoryController@showEntries');
    Route::get('partnerprograms/index', 'PartnerProgramController@showEntries');
    Route::get('projects/index', 'ProjectController@showEntries');
    Route::get('users/index', 'UserController@showUserlist');
    Route::get('apis/index', 'OptionsController@updateOptions');
    Route::post('apis/index', 'OptionsController@postUpdateOptions');
});

Route::group(['middleware' => 'auth', 'prefix' => 'user'], function () {
    Route::get('profile', 'UserController@updateProfile');
    Route::post('profile', 'UserController@postUpdateProfile');
    Route::get('autologin/{user}', 'UserController@loginWithID')->where('user', '^[1-9][0-9]*$');
});

Route::group(['middleware' => 'auth', 'prefix' => 'project'], function () {
    Route::get('dashboard', 'ProjectController@dashboard');
    Route::get('notes', 'ProjectController@notes');
    Route::get('content', 'ProjectController@content');
    Route::get('competition', 'ProjectController@competition');
    Route::get('keywords', 'ProjectController@keywords');
    Route::get('rankings', 'ProjectController@rankings');
    Route::get('backlinks', 'ProjectController@backlinks');
    Route::get('choose/{project}', 'ProjectController@chooseProject')->where('project', '^[1-9][0-9]*$');
    Route::get('notes/showarchived', 'ProjectController@showArchivedNotes');
    Route::get('notes/hidearchived', 'ProjectController@hideArchivedNotes');
    Route::get('content/showarchived', 'ProjectController@showArchivedContent');
    Route::get('content/hidearchived', 'ProjectController@hideArchivedContent');
});

Route::group(['middleware' => 'auth', 'prefix' => 'api/v1'], function () {
    Route::group(['prefix' => 'idea'], function () {
        Route::post('insert', 'Api\IdeasApiController@insertEntry');
        Route::post('update/topic', 'Api\IdeasApiController@updateName');
        Route::post('update/sv', 'Api\IdeasApiController@updateSearchVolume');
        Route::post('update/cpc', 'Api\IdeasApiController@updateCPC');
        Route::post('update/provision', 'Api\IdeasApiController@updateProvision');
        Route::post('update/ppp', 'Api\IdeasApiController@updatePPP');
        Route::post('update/buyconversion', 'Api\IdeasApiController@updateBuyConversion');
        Route::post('update/category', 'Api\IdeasApiController@updateCategory');
        Route::post('update/seasonal', 'Api\IdeasApiController@updateSeasonal');
        Route::post('update/keywords', 'Api\IdeasApiController@updateKeywords');
        Route::post('update/partnerprogram', 'Api\IdeasApiController@updatePartnerProgram');
        Route::post('update/domains', 'Api\IdeasApiController@updateDomains');
        Route::post('update/competition', 'Api\IdeasApiController@updateCompetition');
        Route::post('update/competitionpower', 'Api\IdeasApiController@updateCompetitionPower');
        Route::post('update/ranking', 'Api\IdeasApiController@updateRanking');
        Route::post('delete', 'Api\IdeasApiController@deleteIdea');
        Route::post('check/keyword', 'Api\IdeasApiController@checkKeyword');
    });
});

Route::group(['middleware' => 'auth', 'prefix' => 'api/v1'], function () {
    Route::group(['prefix' => 'category'], function () {
        Route::get('get', 'Api\IdeasCategoryApiController@getCategories');
        Route::post('insert', 'Api\IdeasCategoryApiController@insertEntry');
        Route::post('update/name', 'Api\IdeasCategoryApiController@updateName');
        Route::post('update/notes', 'Api\IdeasCategoryApiController@updateNotes');
        Route::post('delete', 'Api\IdeasCategoryApiController@deleteCategory');
    });
});

Route::group(['middleware' => 'auth', 'prefix' => 'api/v1'], function () {
    Route::group(['prefix' => 'partnerprogram'], function () {
        Route::get('get', 'Api\PartnerProgramApiController@getPartnerPrograms');
        Route::post('insert', 'Api\PartnerProgramApiController@insertEntry');
        Route::post('update/name', 'Api\PartnerProgramApiController@updateName');
        Route::post('update/notes', 'Api\PartnerProgramApiController@updateNotes');
        Route::post('delete', 'Api\PartnerProgramApiController@deletePartnerProgram');
    });
});

Route::group(['middleware' => 'auth', 'prefix' => 'api/v1'], function () {
    Route::group(['prefix' => 'project'], function () {
        Route::post('insert', 'Api\ProjectApiController@insertEntry');
        Route::post('update/name', 'Api\ProjectApiController@updateName');
        Route::post('update/notes', 'Api\ProjectApiController@updateNotes');
        Route::post('update/gaviewid', 'Api\ProjectApiController@updateGaViewID');
        Route::post('delete', 'Api\ProjectApiController@deleteProject');
        Route::post('create/si', 'Api\ProjectApiController@createSI');
    });
});

Route::group(['middleware' => 'auth', 'prefix' => 'api/v1'], function () {
    Route::group(['prefix' => 'project'], function () {
        Route::post('insert/note', 'Api\NoteApiController@insertEntry');
        Route::post('update/note/name', 'Api\NoteApiController@updateName');
        Route::post('update/note/content', 'Api\NoteApiController@updateContent');
        Route::post('update/note/priority', 'Api\NoteApiController@updatePriority');
        Route::post('update/note/deadline', 'Api\NoteApiController@updateDeadline');
        Route::post('delete/note', 'Api\NoteApiController@deleteNote');
        Route::post('archive/note', 'Api\NoteApiController@archiveNote');
    });
});

Route::group(['middleware' => 'auth', 'prefix' => 'api/v1'], function () {
    Route::group(['prefix' => 'project'], function () {
        Route::post('insert/content', 'Api\ContentApiController@insertEntry');
        Route::post('update/content/name', 'Api\ContentApiController@updateName');
        Route::post('update/content/note', 'Api\ContentApiController@updateNote');
        Route::post('update/content/priority', 'Api\ContentApiController@updatePriority');
        Route::post('update/content/keyword', 'Api\ContentApiController@updateKeyword');
        Route::post('delete/content', 'Api\ContentApiController@deleteContent');
        Route::post('archive/content', 'Api\ContentApiController@archiveContent');
    });
});

Route::group(['middleware' => 'auth', 'prefix' => 'api/v1'], function () {
    Route::group(['prefix' => 'project'], function () {
        Route::post('insert/competition', 'Api\CompetitionApiController@insertEntry');
        Route::post('update/competition/url', 'Api\CompetitionApiController@updateUrl');
        Route::post('update/competition/note', 'Api\CompetitionApiController@updateNote');
        Route::post('update/competition/power', 'Api\CompetitionApiController@updatePower');
        Route::post('delete/competition', 'Api\CompetitionApiController@deleteCompetition');
    });
});

Route::group(['middleware' => 'auth', 'prefix' => 'api/v1'], function () {
    Route::group(['prefix' => 'project'], function () {
        Route::post('insert/keyword', 'Api\KeywordApiController@insertEntry');
        Route::post('update/keyword/name', 'Api\KeywordApiController@updateName');
        Route::post('update/keyword/sv', 'Api\KeywordApiController@updateSV');
        Route::post('update/keyword/cpc', 'Api\KeywordApiController@updateCPC');
        Route::post('update/keyword/content', 'Api\KeywordApiController@updateContent');
        Route::post('update/keyword/competition', 'Api\KeywordApiController@updateCompetition');
        Route::post('update/keyword/note', 'Api\KeywordApiController@updateNote');
        Route::post('delete/keyword', 'Api\KeywordApiController@deleteKeyword');
        Route::post('check/keyword', 'Api\KeywordApiController@checkKeyword');
    });
});

Route::group(['middleware' => 'auth', 'prefix' => 'api/v1'], function () {
    Route::group(['prefix' => 'project'], function () {
        Route::post('update/rankings', 'Api\ProjectApiController@updateRankings');
    });
});

Route::group(['middleware' => 'auth', 'prefix' => 'api/v1'], function () {
    Route::group(['prefix' => 'project'], function () {
        Route::post('insert/backlink', 'Api\BacklinkApiController@insertEntry');
        Route::post('update/backlink/linksource', 'Api\BacklinkApiController@updateSource');
        Route::post('update/backlink/linktarget', 'Api\BacklinkApiController@updateTarget');
        Route::post('update/backlink/linktext', 'Api\BacklinkApiController@updateText');
        Route::post('update/backlink/linkrelation', 'Api\BacklinkApiController@updateRelation');
        Route::post('update/backlink/note', 'Api\BacklinkApiController@updateNote');
        Route::post('delete/backlink', 'Api\BacklinkApiController@deleteBacklink');
        Route::post('check/backlink', 'Api\BacklinkApiController@checkBacklink');
    });
});

Route::group(['middleware' => 'auth', 'prefix' => 'api/v1'], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::post('insert', 'Api\UserApiController@insertEntry');
        Route::post('update/name', 'Api\UserApiController@updateName');
        Route::post('update/email', 'Api\UserApiController@updateEmail');
        Route::post('update/role', 'Api\UserApiController@updateRole');
        Route::post('update/note', 'Api\UserApiController@updateNote');
        Route::post('delete', 'Api\UserApiController@deleteUser');
    });
});

Route::group(['middleware' => 'auth', 'prefix' => 'api/v1'], function () {
    Route::get('roles/get', 'Api\RoleApiController@getRoles');
});

Route::group(['prefix' => 'cronjob'], function () {
    Route::get('backlinks', 'CronjobController@backlinks');
    Route::get('rankings', 'CronjobController@rankings');
    Route::get('searchindex', 'CronjobController@searchindex');
    Route::get('keywords', 'CronjobController@keywords');
    Route::get('ideas', 'CronjobController@ideas');
});
