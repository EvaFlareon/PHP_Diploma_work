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
            <h2>Начните работу прямо сейчас</h2>
            <h3>Добавить нового администратора</h3>
            <form action="result" method="post">
                <table>
                    <tr>
                        <td>Логин</td>
                        <td><input type="text" name="name"></td>
                    </tr>
                    <tr>
                        <td>Почта</td>
                        <td><input type="text" name="email"></td>
                    </tr>
                    <tr>
                        <td>Пароль</td>
                        <td><input type="text" name="password"></td>
                    </tr>
                </table>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" name="add_admin">
            </form>
            <h3>Список администраторов</h3>
            <form action="update" method="post">
                <table style="margin: 10px auto">
                    <tr style="background-color: #eeeeee">
                        <td>Имя</td>
                        <td>E-mail</td>
                        <td>Пароль</td>
                    </tr>

                    @foreach($adminList as $admin)
                        <tr>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->password }}</td>
                            <td><input type="text" name="newPass"><button type="submit" name="password" value="{{ $admin->id }}">Изменить пароль</button></td>
                            <td><a href="{{ 'd'.$admin->id }}">Удалить администратора</a></td>
                        </tr>
                    @endforeach
                </table>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        </div>
    </div>
@endsection