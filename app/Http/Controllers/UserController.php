<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    public function welcome()
    {
        session()->forget('user_name');
        $categories = DB::table('themes')
            ->where('status', 2)
            ->join('posts', 'themes.id', '=', 'posts.category')
            ->select('themes.id', 'themes.category')
            ->groupBy('category')
            ->get();
        return view('welcome', compact('categories'));
    }

    public function formQuestion()
    {
        $result = false;
        $categories = DB::table('themes')
            ->where('status', 2)
            ->join('posts', 'themes.id', '=', 'posts.category')
            ->select('themes.id', 'themes.category')
            ->groupBy('category')
            ->get();
        $themes = DB::table('themes')->get();
        return view('question', compact('result', 'categories', 'themes'));
    }

    public function userQuestion(Request $request)
    {
        $validator = $this->validate($request, [
            'category' => 'required|integer',
            'question' => 'required|string|max:750',
            'userName' => 'required|string|max:255',
            'userEmail' => 'required|string|email|max:255',
        ]);
        if ($validator) {
            $question = $request->post();
            DB::table('posts')
                ->insert(['status' => 1,
                    'category' => $question['category'],
                    'question' => $question['question'],
                    'user_name' => $question['userName'],
                    'user_email' => $question['userEmail']]);
            $result = true;
        }
        $categories = DB::table('themes')
            ->where('status', 2)
            ->join('posts', 'themes.id', '=', 'posts.category')
            ->select('themes.id', 'themes.category')
            ->groupBy('category')
            ->get();
        $themes = DB::table('themes')->get();
        return view('question', compact('result', 'categories', 'themes'));
    }

    public function category($num)
    {
        $categories = DB::table('themes')
            ->where('status', 2)
            ->join('posts', 'themes.id', '=', 'posts.category')
            ->select('themes.id', 'themes.category')
            ->groupBy('category')
            ->get();
        $categoryQuest = DB::table('posts')
            ->where('category', $num)
            ->where('status', 2)
            ->get();
        return view('category', compact('categoryQuest', 'categories'));
    }
}
