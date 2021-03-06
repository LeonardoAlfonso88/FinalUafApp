<?php

// Routes for homeController
Route::get('/home', 'WebControllers\homeController@getHome')->name('home');

//Routes for aboutUsController
Route::get('/aboutUs', 'WebControllers\aboutUsController@getAboutUs')->name('aboutUs');
Route::get('/UAF', 'WebControllers\aboutUsController@getUAF')->name('UAF');
Route::get('/UAFIntregral', 'WebControllers\aboutUsController@getUAFIntegral')->name('IntegralUAF');
Route::get('/UAFUnity', 'WebControllers\aboutUsController@getUnity')->name('Unity');

//Routes for glossaryController
Route::get('/glossary', 'WebControllers\glossaryController@getGlossary')->name('glossary');
Route::get('/glossary/word/{id}', 'WebControllers\glossaryController@searchWords')->name('searchWords');
Route::get('/glossary/definition/{id}', 'WebControllers\glossaryController@searchDefinition')->name('searchDefinition');

//Routes for servicesController
Route::get('/services', 'WebControllers\servicesController@getServices')->name('services');
Route::get('/services/zones/{name}', 'WebControllers\servicesController@getZones')->name('optionsZones');
Route::get('/service/{name}', 'WebControllers\servicesController@getPrevServices')->name('prevDepartament');

//Routes for zoneController
Route::post('/zone', 'WebControllers\zoneController@getZone')->name('zone');
Route::get('/zone/elements/{id}', 'WebControllers\zoneController@getClimaticElements')->name('zoneElements');
Route::get('/zone/characteristics/{id}', 'WebControllers\zoneController@getSocioeconomicCharacteristics')->name('zoneCharacteristics');
Route::get('/zone/prevZone/{name}', 'WebControllers\zoneController@getPrevZone')->name('prevZone');

//Routes for systemController
Route::get('/listSystem/{idZone}', 'WebControllers\systemController@getListSystem')->name('listSystem');
Route::get('/changeSystem/{idSystem}', 'WebControllers\systemController@changeSystem')->name('changeSystem');
Route::get('/System/{idSystem}', 'WebControllers\systemController@getSystem')->name('system');
Route::get('/System/Entry/{idEntry}', 'WebControllers\systemController@getCharacteristicsEntry')->name('entryCharacteristics');
Route::get('/System/Cost/{idSystem}', 'WebControllers\systemController@getCosts')->name('systemCost');
Route::get('/System/Indicators/{idSystem}', 'WebControllers\systemController@getIndicators')->name('systemIndicators');

//Routes for adminController
Route::get('/admin/search/{searchWord?}', 'AppControllers\adminController@getListUsers')->middleware('auth')->name('admin');
Route::get('/admin/newUser/{id}', 'AppControllers\adminController@getUser')->middleware('auth')->name('getUser');
Route::get('/admin/editIndicators', 'AppControllers\adminController@getEditIndicators')->name('editIndicators');
Route::post('/admin/saveUser', 'AppControllers\adminController@saveUser')->name('saveUser');
Route::post('/admin/saveIndicators', 'AppControllers\adminController@saveIndicators')->name('saveIndicators');
Route::get('/admin/deleteUser/{idUser}', 'AppControllers\adminController@deleteUser')->name('userDelete');

//Routes for cartographerController
Route::get('/cartographer', 'AppControllers\cartographerController@cartographerPanel')->middleware('auth')->name('cartographer');
Route::get('/cartographer/{idDepartament}', 'AppControllers\cartographerController@getListZones')->name('listZones');
Route::get('/cartographer/departament/{idDepartament}/zone/{idZone?}/{validations?}', 'AppControllers\cartographerController@getZone')->name('getZone');
Route::post('/cartographer/saveZone', 'AppControllers\cartographerController@saveZone')->name('saveZone');
Route::get('/cartographer/deleteZone/{idZone}/{idDepartament}', 'AppControllers\cartographerController@deleteZone')->name('zoneDelete');
Route::get('/cartographer/Municipality/Config/Admin', 'AppControllers\cartographerController@getMunicipality')->name('municipality');
Route::get('/cartographer/zone/back', 'AppControllers\cartographerController@returnMunicipalityZone')->name('backZone');
  //ajax
  Route::get('/cartographer/saveMunicipality/{nameMunicipality}', 'AppControllers\cartographerController@saveMunicipality')->name('saveMunicipality');
  Route::get('/cartographer/deleteMunicipality/{idMunicipality}', 'AppControllers\cartographerController@deleteMunicipality')->name('deleteMunicipality');
  Route::get('/cartographer/Municipality/showVillages/{idMunicipality}', 'AppControllers\cartographerController@showVillages')->name('showVillages');
  Route::get('/cartographer/Municipality/saveVillage/{nameMunicipality}', 'AppControllers\cartographerController@saveVillage')->name('saveVillage');
  Route::get('/cartographer/Municipality/deleteVillage/{nameMunicipality}', 'AppControllers\cartographerController@deleteVillage')->name('deleteVillage');

  
//Routes for systemController
Route::get('/expert', 'AppControllers\systemController@expertPanel')->middleware('auth')->name('expert');
Route::get('/expert/{nameDepartament}', 'AppControllers\systemController@getZonesList')->name('zonesList');
Route::post('/expert/listSystem/', 'AppControllers\systemController@getSystemList')->name('systemList');
Route::get('/expert/system/{idZone}/{idSystem?}', 'AppControllers\systemController@getSystem')->name('getSystem');
Route::post('/expert/saveSystem', 'AppControllers\systemController@saveSystem')->name('saveSystem');
Route::get('/expert/system/cost/operation/saveCost', 'AppControllers\systemController@storageCost')->name('storageCost');
Route::get('/expert/deleteCost/cost/operation/{idCost}','AppControllers\systemController@deleteCost')->name('costDelete');
Route::get('/expert/subGroup/{group}','AppControllers\systemController@getSubGroup')->name('getSubGroup');
Route::post('/expert/system/entry/saveEntry', 'AppControllers\systemController@storageEntry')->name('storageEntry');
Route::get('/expert/deleteEntry/entry/operation/{idEntry}','AppControllers\systemController@deleteEntry')->name('entryDelete');
Route::get('/expert/calculate/Indicators','AppControllers\systemController@calculateIndicators')->name('calculateIndicators');
Route::get('/expert/deleteSystem/system/operation/{idSystem}','AppControllers\systemController@deleteSystem')->name('systemDelete');
Route::get('/expert/validateExistence/Indicators','AppControllers\systemController@validateIfIndicators')->name('validateIfIndicators');
Route::get('/expert/validateExistence/Calculations','AppControllers\systemController@validateCalculate')->name('validateCalculate');
Route::get('/expert/editCost/cost/operation/{idCost}','AppControllers\systemController@editCost')->name('costEdit');
Route::get('/expert/editEntry/entry/operation/{idEntry}','AppControllers\systemController@editEntry')->name('editEntry');

Route::get('test/modal','AppControllers\systemController@calculateRecomendations')->name('calculateRecomendations');

Auth::routes();
