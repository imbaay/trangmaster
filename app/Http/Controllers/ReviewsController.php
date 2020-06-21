<?php

namespace App\Http\Controllers;

use App\Dienthoai;
use App\Danhgia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewsController extends Controller
{
    public function store(Dienthoai $dienthoai , Request $request)
    {
        $rules = [
            'body'          => 'required'
        ];
        $message = [
            'body.required' => "Comment body can't be empty"
        ];
        $this->validate($request, $rules, $message);

        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $input['dienthoai_id'] = $dienthoai->id;

        $review = Review::create($input);

        return redirect()->back()->with('success_message', 'Your review added');
    }

}
