<?php

Route::any('/','UserController@index')->name('index');
Route::any('/addUser','UserController@addUser')->name('addUser');
Route::any('/viewUsers','UserController@viewUsers')->name('viewUsers');
Route::any('/deleteUser/{uid?}','UserController@deleteUser')->name('deleteUser');
Route::any('/editUser/{uid?}','UserController@editUser')->name('editUser');
Route::any('/editUserAction','UserController@editUserAction')->name('editUserAction');



