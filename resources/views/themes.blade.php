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
            <h3 style="color: #ff4930">Текущие категории</h3>
            <form action="add_theme" method="post">
                <input type="text" name="new_theme" placeholder="Новая категрия вопросов" required>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" name="add_new_theme">
            </form>
            <table style="display: inline-block; text-align: center; vertical-align: top">
                <tr style="background-color: #eeeeee">
                    <td style="background-color: #ffffff"></td>
                    <td>Категория</td>
                </tr>
                @foreach($themes as $theme)
                    <tr>
                        <td><a href="{{ 'del_theme'.$theme->id }}">Удалить категорию полностью</a></td>
                        <td><a href="{{ 'theme'.$theme->id }}">{{ $theme->category }}</a></td>
                    </tr>
                @endforeach
            </table>
            <table style="display: inline-block; text-align: center; vertical-align: top">
                <tr style="background-color: #eeeeee">
                    <td>Количество вопросов</td>
                </tr>
                @foreach($questions as $question)
                    <tr>
                        <td>{{ $question->$count_ques }}</td>
                    </tr>
                @endforeach
            </table>
            <table style="display: inline-block; text-align: center; vertical-align: top">
                <tr style="background-color: #eeeeee">
                    <td>Опубликовано</td>
                </tr>
                @foreach($answers as $answer)
                    <tr>
                        <td>{{ $answer->$count_answer }}</td>
                    </tr>
                @endforeach
            </table>
            <table style="display: inline-block; text-align: center; vertical-align: top">
                <tr style="background-color: #eeeeee">
                    <td>Без ответа</td>
                </tr>
                @foreach($without_answers as $without_answer)
                    <tr>
                        <td>{{ $without_answer->$count_answer }}</td>
                    </tr>
                @endforeach
            </table>

            <h3 style="color: #ff4930">Необработанные вопросы</h3>
            <form action="up_question" method="post">
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

                    @foreach($all_without_answers as $row)
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