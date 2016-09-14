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

Route::get('/', function ()
{
    return redirect()->route('login');
});

Route::get('/home', function()
{
    return redirect()->action('DashboardController@index');
});

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->middleware('auth');

Route::get('/ideas/index', 'IdeasController@index')->middleware('auth');
Route::post('/ideas/index', 'IdeasController@postIdeaSearch')->middleware('auth');

Route::get('/ideas/notes/{idea}', 'IdeasController@updateNotes')->where('idea', '^[1-9][0-9]*$')->name('idea.notes')->middleware('auth');
Route::post('/ideas/notes', 'IdeasController@postUpdateIdea')->middleware('auth');

Route::get('/settings/categories/index', 'IdeasCategoryController@showEntries')->middleware('auth');
Route::get('/settings/partnerprograms/index', 'PartnerProgramController@showEntries')->middleware('auth');
Route::get('/settings/projects/index', 'ProjectController@showEntries')->middleware('auth');
Route::get('/settings/apis/index', 'ApisController@showEntries')->middleware('auth');
Route::get('/settings/users/index', 'UserController@showUserlist')->middleware('auth');
Route::get('/settings/apis/index', 'OptionsController@updateOptions')->middleware('auth');
Route::post('/settings/apis/index', 'OptionsController@postUpdateOptions')->middleware('auth');

Route::get('/user/profile', 'UserController@updateProfile')->middleware('auth');
Route::post('/user/profile', 'UserController@postUpdateProfile')->middleware('auth');
Route::get('/user/autologin/{user}', 'UserController@loginWithID')->middleware('auth');

Route::get('/project/dashboard', 'ProjectController@dashboard')->middleware('auth');
Route::get('/project/notes', 'ProjectController@notes')->middleware('auth');
Route::get('/project/content', 'ProjectController@content')->middleware('auth');
Route::get('/project/competition', 'ProjectController@competition')->middleware('auth');
Route::get('/project/keywords', 'ProjectController@keywords')->middleware('auth');
Route::get('/project/rankings', 'ProjectController@rankings')->middleware('auth');
Route::get('/project/backlinks', 'ProjectController@backlinks')->middleware('auth');


Route::get('/project/choose/{project}', 'ProjectController@chooseProject')->where('project', '^[1-9][0-9]*$')->middleware('auth');
Route::get('/project/notes/showarchived', 'ProjectController@showArchivedNotes')->middleware('auth');
Route::get('/project/notes/hidearchived', 'ProjectController@hideArchivedNotes')->middleware('auth');
Route::get('/project/content/showarchived', 'ProjectController@showArchivedContent')->middleware('auth');
Route::get('/project/content/hidearchived', 'ProjectController@hideArchivedContent')->middleware('auth');

// x-editable
Route::post('/api/v1/idea/insert', 'Api\IdeasApiController@insertEntry')->middleware('auth');
Route::post('/api/v1/idea/update/topic', 'Api\IdeasApiController@updateName')->middleware('auth');
Route::post('/api/v1/idea/update/sv', 'Api\IdeasApiController@updateSearchVolume')->middleware('auth');
Route::post('/api/v1/idea/update/cpc', 'Api\IdeasApiController@updateCPC')->middleware('auth');
Route::post('/api/v1/idea/update/provision', 'Api\IdeasApiController@updateProvision')->middleware('auth');
Route::post('/api/v1/idea/update/ppp', 'Api\IdeasApiController@updatePPP')->middleware('auth');
Route::post('/api/v1/idea/update/buyconversion', 'Api\IdeasApiController@updateBuyConversion')->middleware('auth');
Route::post('/api/v1/idea/update/category', 'Api\IdeasApiController@updateCategory')->middleware('auth');
Route::post('/api/v1/idea/update/seasonal', 'Api\IdeasApiController@updateSeasonal')->middleware('auth');
Route::post('/api/v1/idea/update/keywords', 'Api\IdeasApiController@updateKeywords')->middleware('auth');
Route::post('/api/v1/idea/update/partnerprogram', 'Api\IdeasApiController@updatePartnerProgram')->middleware('auth');
Route::post('/api/v1/idea/update/domains', 'Api\IdeasApiController@updateDomains')->middleware('auth');
Route::post('/api/v1/idea/update/competition', 'Api\IdeasApiController@updateCompetition');
Route::post('/api/v1/idea/update/competitionpower', 'Api\IdeasApiController@updateCompetitionPower')->middleware('auth');
Route::post('/api/v1/idea/update/ranking', 'Api\IdeasApiController@updateRanking')->middleware('auth');
Route::post('/api/v1/idea/delete', 'Api\IdeasApiController@deleteIdea')->middleware('auth');
Route::post('/api/v1/idea/check/keyword', 'Api\IdeasApiController@checkKeyword')->middleware('auth');

Route::get('/api/v1/category/get', 'Api\IdeasCategoryApiController@getCategories')->middleware('auth');
Route::post('/api/v1/category/insert', 'Api\IdeasCategoryApiController@insertEntry')->middleware('auth');
Route::post('/api/v1/category/update/name', 'Api\IdeasCategoryApiController@updateName')->middleware('auth');
Route::post('/api/v1/category/update/notes', 'Api\IdeasCategoryApiController@updateNotes')->middleware('auth');
Route::post('/api/v1/category/delete', 'Api\IdeasCategoryApiController@deleteCategory')->middleware('auth');

Route::get('/api/v1/partnerprogram/get', 'Api\PartnerProgramApiController@getPartnerPrograms')->middleware('auth');
Route::post('/api/v1/partnerprogram/insert', 'Api\PartnerProgramApiController@insertEntry')->middleware('auth');
Route::post('/api/v1/partnerprogram/update/name', 'Api\PartnerProgramApiController@updateName')->middleware('auth');
Route::post('/api/v1/partnerprogram/update/notes', 'Api\PartnerProgramApiController@updateNotes')->middleware('auth');
Route::post('/api/v1/partnerprogram/delete', 'Api\PartnerProgramApiController@deletePartnerProgram')->middleware('auth');

Route::post('/api/v1/project/insert', 'Api\ProjectApiController@insertEntry')->middleware('auth');
Route::post('/api/v1/project/update/name', 'Api\ProjectApiController@updateName')->middleware('auth');
Route::post('/api/v1/project/update/notes', 'Api\ProjectApiController@updateNotes')->middleware('auth');
Route::post('/api/v1/project/update/gaviewid', 'Api\ProjectApiController@updateGaViewID')->middleware('auth');
Route::post('/api/v1/project/delete', 'Api\ProjectApiController@deleteProject')->middleware('auth');
Route::post('/api/v1/project/create/si', 'Api\ProjectApiController@createSI')->middleware('auth');

Route::post('/api/v1/project/insert/note', 'Api\NoteApiController@insertEntry')->middleware('auth');
Route::post('/api/v1/project/update/note/name', 'Api\NoteApiController@updateName')->middleware('auth');
Route::post('/api/v1/project/update/note/content', 'Api\NoteApiController@updateContent')->middleware('auth');
Route::post('/api/v1/project/update/note/priority', 'Api\NoteApiController@updatePriority')->middleware('auth');
Route::post('/api/v1/project/update/note/deadline', 'Api\NoteApiController@updateDeadline')->middleware('auth');
Route::post('/api/v1/project/delete/note', 'Api\NoteApiController@deleteNote')->middleware('auth');
Route::post('/api/v1/project/archive/note', 'Api\NoteApiController@archiveNote')->middleware('auth');

Route::post('/api/v1/project/insert/content', 'Api\ContentApiController@insertEntry')->middleware('auth');
Route::post('/api/v1/project/update/content/name', 'Api\ContentApiController@updateName')->middleware('auth');
Route::post('/api/v1/project/update/content/note', 'Api\ContentApiController@updateNote')->middleware('auth');
Route::post('/api/v1/project/update/content/priority', 'Api\ContentApiController@updatePriority')->middleware('auth');
Route::post('/api/v1/project/update/content/keyword', 'Api\ContentApiController@updateKeyword')->middleware('auth');
Route::post('/api/v1/project/delete/content', 'Api\ContentApiController@deleteContent')->middleware('auth');
Route::post('/api/v1/project/archive/content', 'Api\ContentApiController@archiveContent')->middleware('auth');

Route::post('/api/v1/project/insert/competition', 'Api\CompetitionApiController@insertEntry')->middleware('auth');
Route::post('/api/v1/project/update/competition/url', 'Api\CompetitionApiController@updateUrl')->middleware('auth');
Route::post('/api/v1/project/update/competition/note', 'Api\CompetitionApiController@updateNote')->middleware('auth');
Route::post('/api/v1/project/update/competition/power', 'Api\CompetitionApiController@updatePower')->middleware('auth');
Route::post('/api/v1/project/delete/competition', 'Api\CompetitionApiController@deleteCompetition')->middleware('auth');

Route::post('/api/v1/project/insert/keyword', 'Api\KeywordApiController@insertEntry')->middleware('auth');
Route::post('/api/v1/project/update/keyword/name', 'Api\KeywordApiController@updateName')->middleware('auth');
Route::post('/api/v1/project/update/keyword/sv', 'Api\KeywordApiController@updateSV')->middleware('auth');
Route::post('/api/v1/project/update/keyword/cpc', 'Api\KeywordApiController@updateCPC')->middleware('auth');
Route::post('/api/v1/project/update/keyword/content', 'Api\KeywordApiController@updateContent')->middleware('auth');
Route::post('/api/v1/project/update/keyword/competition', 'Api\KeywordApiController@updateCompetition')->middleware('auth');
Route::post('/api/v1/project/update/keyword/note', 'Api\KeywordApiController@updateNote')->middleware('auth');
Route::post('/api/v1/project/delete/keyword', 'Api\KeywordApiController@deleteKeyword')->middleware('auth');
Route::post('/api/v1/project/check/keyword', 'Api\KeywordApiController@checkKeyword')->middleware('auth');

Route::post('/api/v1/project/update/rankings', 'Api\ProjectApiController@updateRankings')->middleware('auth');

Route::post('/api/v1/project/insert/backlink', 'Api\BacklinkApiController@insertEntry')->middleware('auth');
Route::post('/api/v1/project/update/backlink/linksource', 'Api\BacklinkApiController@updateSource')->middleware('auth');
Route::post('/api/v1/project/update/backlink/linktarget', 'Api\BacklinkApiController@updateTarget')->middleware('auth');
Route::post('/api/v1/project/update/backlink/linktext', 'Api\BacklinkApiController@updateText')->middleware('auth');
Route::post('/api/v1/project/update/backlink/linkrelation', 'Api\BacklinkApiController@updateRelation')->middleware('auth');
Route::post('/api/v1/project/update/backlink/note', 'Api\BacklinkApiController@updateNote')->middleware('auth');
Route::post('/api/v1/project/delete/backlink', 'Api\BacklinkApiController@deleteBacklink')->middleware('auth');
Route::post('/api/v1/project/check/backlink', 'Api\BacklinkApiController@checkBacklink')->middleware('auth');

Route::post('/api/v1/user/insert', 'Api\UserApiController@insertEntry')->middleware('auth');
Route::post('/api/v1/user/update/name', 'Api\UserApiController@updateName')->middleware('auth');
Route::post('/api/v1/user/update/email', 'Api\UserApiController@updateEmail')->middleware('auth');
Route::post('/api/v1/user/update/role', 'Api\UserApiController@updateRole')->middleware('auth');
Route::post('/api/v1/user/update/note', 'Api\UserApiController@updateNote')->middleware('auth');
Route::post('/api/v1/user/delete', 'Api\UserApiController@deleteUser')->middleware('auth');

Route::get('/api/v1/roles/get', 'Api\RoleApiController@getRoles')->middleware('auth');

Route::get('/cronjob/backlinks', 'CronjobController@backlinks');
Route::get('/cronjob/rankings', 'CronjobController@rankings');
Route::get('/cronjob/searchindex', 'CronjobController@searchindex');
Route::get('/cronjob/keywords', 'CronjobController@keywords');
Route::get('/cronjob/ideas', 'CronjobController@ideas');

