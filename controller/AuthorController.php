<?php

namespace App\Http\Controllers;

use \http\Env\Response;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Hash;

class AuthorController extends Controller
{
    /**
     * @param  Request  $request
     * @return Response
     */
    public function view(Request $request){
        $validation = $this->validate($request, [
            'id' => 'bail|required|integer'
        ]);

        $id = $request->input('id');

        $comment = DB::table('authors')
            ->where('id','=',$id);

        $count = $comment->count();

        if($count === 1){
            $this->addResult('author',$comment->first());
            $this->addMessage('success','Your Author.');
        }
        else{
            $this->addMessage('success','Author doesnt exists.');
        }

        return $this->getResponse();
    }
}
