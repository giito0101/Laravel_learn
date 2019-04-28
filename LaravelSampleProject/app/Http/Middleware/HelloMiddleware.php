<?php

namespace App\Http\Middleware;

use Closure;

class HelloMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		//Middlewareが実行された後にControllerが実行され帰ってきたレスポンスを加工する時の書き方
		$response = $next($request);
		$content = $response->content();
		
		$pattern = '/<middleware>(.*)<\/middleware>/i';
		$replace = '<a href="http://$1">$1</a>';
		$content = preg_replace($pattern, $replace, $content);
		
		$response->setContent($content);
		return $response;

		//MiddlewareからControllerｗに値を渡す時の書き方
/*		$data = [
			['name' => 'taro', 'mail' =>'taro@yamada'],
			['name' => 'hnako', 'mail' =>'hanako@flower'],
			['name' => 'sachiko', 'mail' =>'sachico@happy'],
		];
		$request->merge(['data' => $data]);
        return $next($request);
 */   }
}
