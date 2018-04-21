@extends('master')

@section('title', ' Netology')

@section('content')
    <div class="center">
        <header class="header">
            <form class="auth" action="auth" method="post">
                <input type="text" name="login" placeholder="Логин" style="margin: 5px"><br>
                <input type="text" name="password" placeholder="Пароль" style="margin: 5px"><br>
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
            <p>Вы можете выбрать категорию вопроса или задать нам вопрос в <a href="form_question">данной форме</a></p>
            <ul>
                @foreach($categories as $category)
                    <li><a href="{{ 'category'.$category->id }}">{{ $category->category }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection