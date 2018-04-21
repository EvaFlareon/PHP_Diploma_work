<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use function PHPSTORM_META\type;

class UserController extends Controller
{
    public function welcome()
    {
        $categories = DB::table('themes')
            ->where('status', 'Опубликован')
            ->join('posts', 'themes.id', '=', 'posts.category')
            ->select('themes.*')
            ->groupBy('category')
            ->get();
        return view('welcome', compact('categories'));
    }

    public function form_question()
    {
        $result = false;
        $categories = DB::table('themes')
            ->where('status', 'Опубликован')
            ->join('posts', 'themes.id', '=', 'posts.category')
            ->select('themes.*')
            ->groupBy('category')
            ->get();
        $themes = DB::table('themes')->get();
        return view('question', compact('result', 'categories', 'themes'));
    }

    public function user_question(Request $request)
    {
        $question = $request->post();
        DB::table('posts')
            ->insert(['status' => 'Ожидает ответа',
                'category' => $question['category'],
                'question' => $question['question'],
                'user_name' => $question['user_name'],
                'user_email' => $question['user_email']]);
        $result = true;
        $categories = DB::table('themes')
            ->where('status', 'Опубликован')
            ->join('posts', 'themes.id', '=', 'posts.category')
            ->select('themes.*')
            ->groupBy('category')
            ->get();
        $themes = DB::table('themes')->get();
        return view('question', compact('result', 'categories', 'themes'));
    }

    public function category($num)
    {
        $categories = DB::table('themes')
            ->where('status', 'Опубликован')
            ->join('posts', 'themes.id', '=', 'posts.category')
            ->select('themes.*')
            ->groupBy('category')
            ->get();
        $cat_ques = DB::table('posts')
            ->where('category', $num)
            ->where('status', 'Опубликован')
            ->get();
        return view('category', compact('cat_ques', 'categories'));
    }
}
