<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Slugs;
use Illuminate\Http\Request;
use App\Models\Media;

class PostsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        $this->slugs = new Slugs;
        $this->posts = new Posts;
        $this->media = new Media();
    }

    public function all(Request $request) {

        $request->user()->authorizeRoles(['Administrator']);

        $all = $this->posts->all();

        return view('admin/posts/all', [
            "all" => $all
        ]);
    }

    public function add(Request $request) {

        $request->user()->authorizeRoles(['Administrator']);
        
        $all = $this->media->all();
        
        return view('admin/posts/add', [
             "all" => $all
        ]);
    }

    public function edit(Request $request) {

        $request->user()->authorizeRoles(['Administrator']);
        
        $all = $this->media->all();

        $params = request()->route()->parameters();
        $get_object = $this->posts->where('id', $params["object_id"])->first();

        return view('admin/posts/edit', [
            "object" => $get_object,
            "all" => $all
        ]);
    }

    public function delete(Request $request) {

        $request->user()->authorizeRoles(['Administrator']);

        $params = request()->route()->parameters();
        $get_post = $this->posts->find($params["object_id"]);
        $slug = $this->slugs->where('slug', $get_post->slug)->first();
        
        
        $get_post->delete();
        $slug->delete();
        
         \Session::flash('message', ' <div class="alert alert-success">Deleted Successfully</div>');

        return redirect('admin/posts/all');
    }

    //posts

    public function create(Request $request) {

        $request->user()->authorizeRoles(['Administrator']);

        $input = $request->input();

        if (isset($input['_token'])) {
            unset($input['_token']);
        }

        foreach ($input as $key => $value) {
            $this->posts->$key = $value;
        }

        $this->slugs->slug = $input['slug'];
        $this->slugs->type = 'post';
        $this->slugs->save();

        $this->posts->save();
        
        \Session::flash('message', ' <div class="alert alert-success">Saved Successfully</div>');

        return redirect('admin/posts/all');
    }

    public function save(Request $request) {

        $request->user()->authorizeRoles(['Administrator']);

        $input = $request->input();
        $params = request()->route()->parameters();
        
         if (isset($input['_token'])) {
            unset($input['_token']);
        }
        
        $object = $this->posts->find($params["object_id"]);
        
        $slug = $this->slugs->where('slug', $object->slug)->first();
        $slug->slug = $input['slug'];
        $slug->save();
        
        foreach ($input as $key => $value) {
                $object->$key = $value;
            }
        $object->save();
        
         \Session::flash('message', ' <div class="alert alert-success">Saved Successfully</div>');

        return redirect('admin/posts/all');
    }

}
