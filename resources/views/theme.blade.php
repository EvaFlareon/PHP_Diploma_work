@extends('master')

@section('title', ' Netology')

@section('content')
    <div class="center">
        <header class="header">
            <div class="log">
                Здравствуйте,<br>
                {{ session('user_name') }}!<br>
                <a href="index.php">Выйти</a>
            </div>
            <h1 class="title">FAQ</h1>
        </header>

        <nav class="nav">
            <h3 class="h3">Действия</h3>
            <ul>
                <li><a href="admins">Работа с другими администраторами</a></li>
                <li><a href="themes">Работа с темами</a></li>
            </ul>
        </nav>

        <div class="content">
            <form action="update_question" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <table style="text-align: center; vertical-align: top">
                    <tr style="background-color: #eeeeee">
                        <td>Категория</td>
                        <td>Вопрос</td>
                        <td>Дата обращения</td>
                        <td>Статус</td>
                        <td>Ответ</td>
                        <td>Имя пользователя</td>
                        <td>E-mail пользователя</td>
                    </tr>

                    @foreach($table as $row)
                        <tr>
                            <td>{{ $row->category }}<br>
                                <select name="category">
                                    <option></option>
                                    @foreach($themes as $theme)
                                        <option>{{ $theme->category }}</option>
                                    @endforeach
                                </select>
                                <input type="submit" name="{{ 'c'.$row->id }}" value="Изменить категорию">
                            </td>
                            <td>{{ $row->question }}<br>
                                <input type="text" name="question"><br>
                                <input type="submit" name="{{ 'q'.$row->id }}" value="Изменить вопрос">
                            </td>
                            <td>{{ $row->date }}</td>
                            <td>{{ $row->status }}<br>
                                <select name="status">
                                    <option></option>
                                    <option>Ожидает ответа</option>
                                    <option>Опубликован</option>
                                    <option>Скрыт</option>
                                </select><br>
                                <input type="submit" name="{{ 's'.$row->id }}" value="Изменить статус">
                            </td>
                            <td>{{ $row->answer }}<br>
                                <input type="text" name="answer"><br>
                                <input type="submit" name="{{ 'a'.$row->id }}" value="Изменить ответ">
                            </td>
                            <td>{{ $row->user_name }}<br>
                                <input type="text" name="user_name"><br>
                                <input type="submit" name="{{ 'n'.$row->id }}" value="Изменить автора">
                            </td>
                            <td>{{ $row->user_email }}</td>
                            <td><a href="{{ $row->category.'del_question'.$row->id }}">Удалить вопрос</a></td>
                        </tr>
                        <input type="hidden" name="current_category" value="{{ $row->category }}">
                    @endforeach
                </table>
            </form>
        </div>
    </div>
@endsection