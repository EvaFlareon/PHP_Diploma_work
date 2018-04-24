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
                        <td>{{ $question->$countQuest }}</td>
                    </tr>
                @endforeach
            </table>
            <table style="display: inline-block; text-align: center; vertical-align: top">
                <tr style="background-color: #eeeeee">
                    <td>Опубликовано</td>
                </tr>
                @foreach($answers as $answer)
                    <tr>
                        <td>{{ $answer->$countAnswer }}</td>
                    </tr>
                @endforeach
            </table>
            <table style="display: inline-block; text-align: center; vertical-align: top">
                <tr style="background-color: #eeeeee">
                    <td>Без ответа</td>
                </tr>
                @foreach($withoutAnswers as $withoutAnswer)
                    <tr>
                        <td>{{ $withoutAnswer->$countAnswer }}</td>
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

                    @foreach($allWithoutAnswers as $row)
                        <tr>
                            <td>{{ $row->category }}<br>
                                <select name="category[{{$row->id}}]">
                                    <option></option>
                                    @foreach($themes as $theme)
                                        <option value="{{ $theme->id }}">{{ $theme->category }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" name="isNewCategory" value="{{ $row->id }}">Изменить категорию</button>
                            </td>
                            <td>{{ $row->question }}<br>
                                <input type="text" name="question[{{$row->id}}]"><br>
                                <button type="submit" name="isNewQuestion" value="{{ $row->id }}">Изменить вопрос</button>
                            </td>
                            <td>{{ $row->date }}</td>
                            <td>{{ $row->status }}<br>
                                <select name="status[{{$row->id}}]">
                                    <option></option>
                                    @foreach($statuses as $status)
                                        <option value="{{ $status->id }}">{{ $status->status }}</option>
                                    @endforeach
                                </select><br>
                                <button type="submit" name="isNewStatus" value="{{ $row->id }}">Изменить статус</button>
                            </td>
                            <td>{{ $row->answer }}<br>
                                <input type="text" name="answer[{{$row->id}}]"><br>
                                <button type="submit" name="isNewAnswer" value="{{ $row->id }}">Изменить ответ</button>
                            </td>
                            <td>{{ $row->user_name }}<br>
                                <input type="text" name="user_name[{{$row->id}}]"><br>
                                <button type="submit" name="isNewAuthor" value="{{ $row->id }}">Изменить автора</button>
                            </td>
                            <td>{{ $row->user_email }}</td>
                            <td><a href="{{ 'delete_quest'.$row->id }}">Удалить вопрос</a></td>
                        </tr>
                    @endforeach
                </table>
            </form>
        </div>
    </div>
@endsection