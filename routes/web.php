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

Route::post('result', ['uses' => 'AdminController@add_admin']); // Добавление нового администратора

Route::post('update', ['uses' => 'AdminController@new_pass']); // Изменение пароля администратора

Route::get('d{id}', ['uses' => 'AdminController@del_admin']); // Удаление администратора

Route::get('themes', 'AdminController@themes'); // Отображение панели администратора для работы с категориями вопросов

Route::post('add_theme', ['uses' => 'AdminController@add_theme']); // Добавление категории вопросов

Route::get('del_theme{cat}', 'AdminController@del_theme'); // Удаление категории вопросов

Route::post('up_question', ['uses' => 'AdminController@up_question__all']); // Управление вопросами без ответов из всех категорий

Route::get('theme{id}', 'AdminController@theme'); // Отображение информации по выбранной категории (для администратора)

Route::post('update_question', ['uses' => 'AdminController@update_question']); // Изменение вопроса

Route::get('{id_theme}del_question{id_question}', 'AdminController@del_question'); // Удаление вопроса

Route::get('form_question', 'UserController@form_question'); // Форма вопроса для пользователя

Route::post('question', ['uses' => 'UserController@user_question']); // Форма вопроса для пользователя (с результатом отрпавки вопроса)

Route::get('category{num}', 'UserController@category'); //Отображение вопросов и ответов по выбранной категории (для пользователя)

