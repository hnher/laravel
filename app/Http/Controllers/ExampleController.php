<?php
/**
 * ExampleController.php
 * Created On 2020/6/19 10:39 上午
 * Create by Retr0
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

class ExampleController extends Controller
{
    public function index()
    {
        Log::info('测试日志', ['channel' => 'test']);

        return view('welcome');
    }
}
