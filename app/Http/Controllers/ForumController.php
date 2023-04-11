<?php

namespace App\Http\Controllers;
use App\Models\Forum;
use App\Models\Komentar;
use Illuminate\Http\Request;


class ForumController extends Controller
{
    
    public function index(){
       $forum = Forum::orderBy('created_at','desc')->paginate(10);
        return view('forum.index', compact(['forum']));
    }
    public function create(Request $request){
      
      $request->request->add(['user_id'=>auth()->user()->id]);
      $forum = Forum::create($request->all());
      return redirect()->back()->with('sukses', 'Forum Berhasil ditambahkan');
     }

     public function view(Forum $forum){
           return view('forum.view', compact(['forum']));
     }
     public function postkomentar(Request $request){
        $request->request->add(['user_id'=>auth()->user()->id]);
        $komentar =Komentar::create($request->all());
        return redirect()->back()->with('success','Komentar berhasil ditambahkan');
     }
}
