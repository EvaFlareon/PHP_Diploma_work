<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Page;
use App\User;
class PageController extends Controller
{
    public function welcome()
    {
        $categories = DB::table('posts')->groupBy('category')->get();
        return view('welcome', compact('categories'));
    }

    public function auth(Request $request)
    {
        $auth = $request->post();
        if (isset($auth['login']) && isset($auth['password'])) {
            $admin = DB::table('admins')->where('name', $auth['login'])->where('password', $auth['password'])->first();
            if ($admin) {
                session(['user_name' => $auth['login']]);
                $admin_list = DB::table('admins')->get();
                return view('admin', compact("session('user_name')", 'admin_list'));
            }
        }
        $categories = DB::table('posts')->groupBy('category')->get();
        return view('welcome', compact('categories'));
    }

     public function admins()
    {
        $admin_list = DB::table('admins')->get();
        return view('admin', compact('admin_list'));
    }

    public function add_admin(Request $request)
    {
        $add = $request->post();
        if (isset($add['name']) && isset($add['email']) && isset($add['password'])) {
            DB::table('admins')->insert(['name' => $add['name'], 'email' => $add['email'], 'password' => $add['password']]);
        }
        $admin_list = DB::table('admins')->get();
        return view('admin', compact('admin_list'));
    }

    public function new_pass(Request $request)
    {
        $update = $request->post();
        foreach ($update as $key => $value) {
            if ($key[0] === 'u' && $value != '' && $update['up_pass'] != '') {
                $i = substr($key, 1);
                DB::table('admins')->where('id', $i)->update(['password' => $update['up_pass']]);
            }
        }
        $admin_list = DB::table('admins')->get();
        return view('admin', compact('admin_list'));
    }

    public function del_admin($id)
    {
        DB::table('admins')->where('id', $id)->delete();
        $admin_list = DB::table('admins')->get();
        return view('admin', compact('admin_list'));
    }

    public function themes()
    {
        $themes = DB::table('posts')->groupBy('category')->get();
        $questions = DB::table('posts')
            ->select(DB::raw('count(question)'))
            ->groupBy('category')
            ->get();
        $answers = DB::table('posts')
            ->where('answer', '<>', null)
            ->select(DB::raw('count(answer)'))
            ->groupBy('category')
            ->get();
        $without_answers = DB::table('posts')
            ->where('answer', null)
            ->select(DB::raw('count(answer)'))
            ->groupBy('category')
            ->get();
        $count_ques = 'count(question)';
        $count_answer = 'count(answer)';
        return view('themes', compact('themes', 'questions', 'count_ques', 'answers', 'without_answers', 'count_answer'));
    }

    public function add_theme(Request $request)
    {
        $new_theme = $request->post();
        DB::table('themes')->insert(['category' => $new_theme['new_theme']]);
        return $this->themes();
    }

    public function del_theme($cat)
    {
        DB::table('posts')->where('category', $cat)->delete();
        DB::table('themes')->where('id', $cat)->delete();
        return $this->themes();
    }

    public function theme($id)
    {
        $table = DB::table('posts')->where('category', $id)->get();
        $themes = DB::table('themes')->groupBy('category')->get();
        return view('theme', compact('table', 'themes'));
    }

    public function update_question(Request $request)
    {
        $update = $request->post();
        foreach ($update as $key => $value) {
            if ($key[0] === 'q' && count($key) < 3 && $value != '' && $update['question'] != '') {
                $i = substr($key, 1);
                DB::table('posts')->where('id', $i)->update(['question' => $update['question']]);
            }
            if ($key[0] === 's' && count($key) < 3 && $value != '' && $update['status'] != '') {
                $i = substr($key, 1);
                DB::table('posts')->where('id', $i)->update(['status' => $update['status']]);
            }
            if ($key[0] === 'a' && count($key) < 3 && $value != '' && $update['answer'] != '') {
                $i = substr($key, 1);
                DB::table('posts')->where('id', $i)->update(['answer' => $update['answer']]);
            }
            if ($key[0] === 'n' && count($key) < 3 && $value != '' && $update['user_name'] != '') {
                $i = substr($key, 1);
                DB::table('posts')->where('id', $i)->update(['user_name' => $update['user_name']]);
            }
            if ($key[0] === 'c' && count($key) < 3 && $value != '' && $update['category'] != '') {
                $i = substr($key, 1);
                DB::table('posts')->where('id', $i)->update(['category' => substr($update['category'], -1)]);
            }
        }
        return $this->theme($i);
    }

    public function del_question($id_theme, $id_question)
    {
        DB::table('posts')->where('id', $id_question)->delete();
        return $this->theme($id_theme);
    }

    public function form_question()
    {
        $result = false;
        $categories = DB::table('posts')->groupBy('category')->get();
        $themes = DB::table('themes')->groupBy('category')->get();
        return view('question', compact('result', 'categories', 'themes'));
    }

    public function user_question(Request $request)
    {
        $question = $request->post();
        DB::table('posts')->insert(['status' => 'Ожидает ответа', 'category' => substr($question['category'], -1), 'question' => $question['question'], 'user_name' => $question['user_name'], 'user_email' => $question['user_email']]);
        $result = true;
        $categories = DB::table('posts')->groupBy('category')->get();
        $themes = DB::table('themes')->groupBy('category')->get();
        return view('question', compact('result', 'categories', 'themes'));
    }

    public function category($num)
    {
        $categories = DB::table('posts')->groupBy('category')->get();
        $cat_ques = DB::table('posts')->where('category', $num)->where('status', 'Опубликован')->get();
        return view('category', compact('cat_ques', 'categories'));
    }
}
