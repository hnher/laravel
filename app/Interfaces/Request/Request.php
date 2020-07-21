<?php
/**
 * Request.php
 * Created On 2020/7/6 11:40 上午
 * Create by Retr0
 */

namespace App\Interfaces\Request;

use Illuminate\Http\Request as HttpRequest;

interface Request
{
    public function validator(HttpRequest $request, array $rules, array $messages);

    public function rules() : array ;

    public function messages() : array ;
}

