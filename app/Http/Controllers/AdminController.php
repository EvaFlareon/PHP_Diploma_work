<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class AdminController extends Controller
{
    public function auth(Request $request)
    {
        $auth = $request->post();
        if (isset($auth['login']) && isset($auth['password'])) {
            $admin = DB::table('admins')
                ->where('name', $auth['login'])
                ->where('password', $auth['password'])
                ->first();
            if ($admin) {
                session(['user_name' => $auth['login']]);
                $adminList = DB::table('admins')->get();
                return view('admin', compact("session('user_name')", 'adminList'));
            }
        }
        $categories = DB::table('posts')
            ->groupBy('category')
            ->get();
        return view('welcome', compact('categories'));
    }

    public function admins()
    {
        $adminList = DB::table('admins')->get();
        return view('admin', compact('adminList'));
    }

    public function addAdmin(Request $request)
    {
        $add = $request->post();
        if (isset($add['name']) && isset($add['email']) && isset($add['password'])) {
            DB::table('admins')
                ->insert(['name' => $add['name'],
                    'email' => $add['email'],
                    'password' => $add['password']]);
        }
        return $this->admins();
    }

    public function newPass(Request $request)
    {
        $update = $request->post();
        if (isset($update['password']) && is_numeric($update['password'])) {
            DB::table('admins')
                ->where('id', $update['password'])
                ->update(['password' => $update['newPass']]);
        }
        return $this->admins();
    }

    public function delAdmin($id)
    {
        DB::table('admins')
            ->where('id', $id)
            ->delete();
        return $this->admins();
    }

    public function themes()
    {
        $themes = DB::table('themes')->get();
        $statuses = DB::table('status')->get();
        $questions = DB::table('posts')
            ->select(DB::raw('count(question)'))
            ->groupBy('category')
            ->get();
        $answers = DB::table('posts')
            ->where('status', 2)
            ->select(DB::raw('count(answer)'))
            ->groupBy('category')
            ->get();
        $withoutAnswers = DB::table('posts')
            ->whereNull('answer')
            ->select(DB::raw('count(answer)'))
            ->groupBy('category')
            ->get();
        $countQuest = 'count(question)';
        $countAnswer = 'count(answer)';
        $allWithoutAnswers = DB::table('posts')
            ->whereNull('answer')
            ->join('themes', 'posts.category', '=', 'themes.id')
            ->join('status', 'posts.status', '=', 'status.id')
            ->select('themes.category', 'posts.question', 'posts.date', 'status.status', 'posts.answer', 'posts.user_name', 'posts.user_email', 'posts.id')
            ->orderBy('date', 'asc')
            ->get();
        return view('themes', compact('themes', 'questions', 'countQuest', 'answers', 'withoutAnswers', 'countAnswer', 'allWithoutAnswers', 'statuses'));
    }

    public function addTheme(Request $request)
    {
        $new_theme = $request->post();
        DB::table('themes')->insert(['category' => $new_theme['new_theme']]);
        return $this->themes();
    }

    public function delTheme($cat)
    {
        DB::table('posts')
            ->where('category', $cat)
            ->delete();
        DB::table('themes')
            ->where('id', $cat)
            ->delete();
        return $this->themes();
    }

    public function editingQuestion($update)
    {
        if (isset($update['isNewCategory']) && is_numeric($update['isNewCategory']) && isset($update['category'][$update['isNewCategory']])) {
            DB::table('posts')
                ->where('id', $update['isNewCategory'])
                ->update(['category' => $update['category'][$update['isNewCategory']]]);
        }
        if (isset($update['isNewQuestion']) && is_numeric($update['isNewQuestion']) && isset($update['question'][$update['isNewQuestion']])) {
            DB::table('posts')
                ->where('id', $update['isNewQuestion'])
                ->update(['question' => $update['question'][$update['isNewQuestion']]]);
        }
        if (isset($update['isNewStatus']) && is_numeric($update['isNewStatus']) && isset($update['status'][$update['isNewStatus']])) {
            DB::table('posts')
                ->where('id', $update['isNewStatus'])
                ->update(['status' => $update['status'][$update['isNewStatus']]]);
        }
        if (isset($update['isNewAnswer']) && is_numeric($update['isNewAnswer']) && isset($update['answer'][$update['isNewAnswer']])) {
            DB::table('posts')
                ->where('id', $update['isNewAnswer'])
                ->update(['answer' => $update['answer'][$update['isNewAnswer']]]);
        }
        if (isset($update['isNewAuthor']) && is_numeric($update['isNewAuthor']) && isset($update['user_name'][$update['isNewAuthor']])) {
            DB::table('posts')
                ->where('id', $update['isNewAuthor'])
                ->update(['user_name' => $update['user_name'][$update['isNewAuthor']]]);
        }
    }

    public function questionWithoutAnswer(Request $request)
    {
        $update = $request->post();
        $this->editingQuestion($update);
        return $this->themes();
    }

    public function updateQuestion(Request $request)
    {
        $update = $request->post();
        $this->editingQuestion($update);
        return $this->theme($update['currentCategory']);
    }

    public function delQuestionWithoutAnswer($id) {
        DB::table('posts')
            ->where('id', $id)
            ->delete();
        return $this->themes();
    }

    public function theme($id)
    {
        $table = DB::table('posts')
            ->where('posts.category', $id)
            ->join('themes', 'posts.category', '=', 'themes.id')
            ->join('status', 'posts.status', '=', 'status.id')
            ->select('themes.category', 'posts.question', 'posts.date', 'status.status', 'posts.answer', 'posts.user_name', 'posts.user_email', 'posts.id', 'themes.id as themesId')
            ->get();
        $themes = DB::table('themes')->get();
        $statuses = DB::table('status')->get();
        return view('theme', compact('table', 'themes', 'statuses'));
    }

    public function delQuestion($id_theme, $id_question)
    {
        DB::table('posts')
            ->where('id', $id_question)
            ->delete();
        return $this->theme($id_theme);
    }
}
