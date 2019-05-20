<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Http\Requests\HelloRequest;
use Validator;
use DB;
class HelloController extends Controller
{
	public function index(Request $request) {
		//middlewareから変数を受け取った後にViewで表示する時の書き方
        return view('hello.index', 
				['message' => 'message',
					'data' => $request->data]);
    }
	public function middleware_test (Request $request){
		//Controller処理が終わった後にMiddlewareの起動をする時の書き方
		return view('hello.middleware_test');
	}
	public function validate_test_Get(Request $request){
		$validator = Validator::make($request->query() ,[
			'id' => 'required',
			'pass' => 'required',
		]);
		if($validator->fails()) {
			$msg = 'クエリーに問題があります。';
		} else {
			$msg = 'ID/PASSを受け付けました。フォームを入力下さい。';
		}
		return view('hello.validation_test',['msg'=>$msg]);
	}
	public function validate_test_Post(Request $request){
		$rules = [
			'name' => 'required',
			'mail' => 'email',
			'age' => 'numeric|between:0,150',
		];
		
		$message = [
			'name.required' => '名前は必ず入力して下さい。',
			'mail.email' => 'メールアドレスが必要です。',
			'age.numeric' => '年齢を整数で記入下さい。',
			'age.between' => '年齢は0~150の間で入力下さい。',
		];
		
		$validator = Validator::make($request->all(), $rules, $message);
		
		if($validator->fails()) {
			return redirect('/validate_test')->withErrors($validator)->withInput();
		}
		return view('hello.validation_test', ['msg'=>'正しく入力されました！']);
	}
	public function index2(Request $request){
		$data = [
			['name'=>'山田たろう', 'mail'=>'taro@yamada'],
			['name'=>'田中はなこ', 'mail'=>'hanako@flower'],
			['name'=>'鈴木さちこ', 'mail'=>'sachico@happy'],
		];
		return view('hello.index2', ['data'=>$data]);
	}
	public function db_5_2 (Request $request){
		$items = DB::select('select * from users');
		return view('hello.db_5_2', ['items' => $items]);
	}
	public function db_5_3(Request $request){
		$id = $request->id;
		$items = DB::table('articles')->where('id', '<=', $id)->get();
		return view('hello.db_5_3',['items' => $items]);
	}
}
