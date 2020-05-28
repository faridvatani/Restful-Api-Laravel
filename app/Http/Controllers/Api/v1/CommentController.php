<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validata = $this->validate($request, [
            'body' => 'required',
        ]);
        auth()->user()->comments()->create($validata);
        return response([
            'data' => [
                'message' => 'نظر شما با موفقیت ثبت شد'
            ],
            'status' => 'success'
        ],200);
    }
}
