<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;

class TestController extends Controller
{
	function __construct(\Foo $foo){
        $this->foo = $foo;
    }

    public function index()
    {
        $foo = $this->foo;
        $foo->executeBar();
    }
	
	public function index2()
	{
/*		$items = Test::all();
		return view('test.index2',['items' => $items]);
*/
		$hasItems = Test::has('boards')->get();
		$noItems = Test::doesntHave('boards')->get();
		$param = ['hasItems' => $hasItems, 'noItems' => $noItems];
		return view('test.index2',$param);
		
	}
	
	public function find(Request $request)
	{
		return view('test.find',['input' => '']);
	}
	
	public function search(Request $request)
	{
//		$item = Test::where('name', $request->input)->first();
		$min = $request->input * 1;
		$max = $min + 10;
		$item = Test::ageGreaterThan($min)->ageLessThan($max)->first();
		$param = ['input' => $request->input, 'item' => $item];
		return view('test.find', $param);
	}
	public function add (Request $request)
	{
		return view('Test.add');
	}
	public function create(Request $request)
	{
		$this->validate($request, Test:: $rules);
		$test = new Test();
		$form = $request->all();
		unset($form['_token']);
		$test->fill($form)->save();
		return redirect('/test/index');
	}
	public function edit(Request $request)
	{
		$test = Test::find($request->id);
		return view('test.edit', ['form' => $test]);
	}
	public function update(Request $request)
	{
		$this->validate($request, Test::$rules);
		$test = Test::find($request->id);
		$form = $request->all();
		unset($form['_token']);
		$test->fill($form)->save();
		return redirect('/test/index');
	}
	public function delete(Request $request)
	{
		$test = Test::find($request->id);
		return view('test.delete', ['form' => $test]);
	}
		
	public function remove(Request $request)
	{
		Test::find($request->id)->delete();
		return redirect('/test/index');
	}
}