<?php

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

Route::get('/', 'UserController@welcome'); // Главная страница

Route::post('auth', ['uses' => 'AdminController@auth']); // Авторизация администратора

Route::get('exit', 'UserController@welcome'); // Выход

Route::get('admins', 'AdminController@admins'); // Отображение панели администратора для работы с другими администраторами

Route::post('result', ['uses' => 'AdminController@addAdmin']); // Добавление нового администратора

Route::post('update', ['uses' => 'AdminController@newPass']); // Изменение пароля администратора

Route::get('del_admin{id}', ['uses' => 'AdminController@delAdmin']); // Удаление администратора

Route::get('themes', 'AdminController@themes'); // Отображение панели администратора для работы с категориями вопросов

Route::post('add_theme', ['uses' => 'AdminController@addTheme']); // Добавление категории вопросов

Route::get('del_theme{id}', ['uses' => 'AdminController@delTheme']); // Удаление категории вопросов

Route::post('up_question', ['uses' => 'AdminController@questionWithoutAnswer']); // Управление вопросами без ответов из всех категорий

Route::get('del_quest{id}', 'AdminController@delQuestionWithoutAnswer'); //Удаление вопроса без ответов (вне категорий)

Route::get('theme{id}', 'AdminController@theme'); // Отображение информации по выбранной категории (для администратора)

Route::post('update_question', ['uses' => 'AdminController@updateQuestion']); // Изменение вопроса

Route::get('{id_theme}del_question{id_question}', 'AdminController@delQuestion'); // Удаление вопроса внутри категории

Route::get('form_question', 'UserController@formQuestion'); // Форма вопроса для пользователя

Route::post('question', ['uses' => 'UserController@userQuestion']); // Форма вопроса для пользователя (с результатом отрпавки вопроса)

Route::get('category{num}', 'UserController@category'); //Отображение вопросов и ответов по выбранной категории (для пользователя)

