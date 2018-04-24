@extends('master')

@section('title', ' Netology')

@section('content')
    <div class="center">
        <header class="header">
            <form class="auth" action="auth" method="post">
                <input type="text" name="login" placeholder="Логин" style="margin: 5px" required><br>
                <input type="text" name="password" placeholder="Пароль" style="margin: 5px" required><br>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" name="enter" value="Войти">
            </form>
            <h1 class="title">FAQ</h1>
        </header>

        <nav class="nav">
            <h3 class="h3">Категории</h3>
            <ul>
                <li><a href="index.php">Главная</a></li>
                @foreach($categories as $category)
                    <li><a href="{{ 'category'.$category->id }}">{{ $category->category }}</a></li>
                @endforeach
                <li><a href="form_question">Задать вопрос</a></li>
            </ul>
        </nav>

        <div class="content">
            @if($result)
                <span style="font-size: 24px; color: green">Вопрос успешно отправлен</span>
            @endif
            <form action="question" method="post">
                <input type="text" name="user_name" placeholder="Введите Ваше имя" style="margin: 5px" required><br>
                <input type="email" name="user_email" placeholder="Введите Вашу почту" style="margin: 5px" required><br>
                <span style="margin: 5px">Выберите категорию:</span><br>
                <label>
                    <select name="category" style="margin: 5px" required>
                        @foreach($themes as $theme)
                            <option value="{{ $theme->id }}">{{ $theme->category }}</option>
                        @endforeach
                    </select>
                </label><br>
                <input type="text" name="question" placeholder="Введите ваш вопрос" style="margin: 5px" required><br>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" name="quest_but" value="Отправить" style="margin: 5px">
            </form>
        </div>
    </div>
@endsection