<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use App\Models\Slugs;
use Illuminate\Http\Request;

class PagesController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        $this->slugs = new Slugs;
        $this->pages = new Pages;
    }

    public function all(Request $request) {

        $request->user()->authorizeRoles(['Administrator']);

        $all = $this->pages->all();

        return view('admin/pages/all', [
            "all" => $all
        ]);
    }

    public function add(Request $request) {

        $request->user()->authorizeRoles(['Administrator']);
        

        return view('admin/pages/add', [
           
        ]);
    }

    public function edit(Request $request) {

        $request->user()->authorizeRoles(['Administrator']);

        $params = request()->route()->parameters();
        $get_object = $this->pages->where('id', $params["object_id"])->first();

        return view('admin/pages/edit', [
            "object" => $get_object
        ]);
    }

    public function delete(Request $request) {

        $request->user()->authorizeRoles(['Administrator']);

        $params = request()->route()->parameters();
        $get_page = $this->pages->find($params["object_id"]);
        $slug = $this->slugs->where('slug', $get_page->slug)->first();

        $get_page->delete();
        $slug->delete();

        \Session::flash('message', ' <div class="alert alert-success">Deleted Successfully</div>');
        
        return redirect('admin/pages/all');
    }

    //posts

    public function create(Request $request) {

        $request->user()->authorizeRoles(['Administrator']);

        $input = $request->input();

        if (isset($input['_token'])) {
            unset($input['_token']);
        }

        foreach ($input as $key => $value) {
            $this->pages->$key = $value;
        }

        $this->slugs->slug = $input['slug'];
        $this->slugs->type = 'page';
        $this->slugs->save();

        $this->pages->save();
        
        \Session::flash('message', ' <div class="alert alert-success">Saved Successfully</div>');

        return redirect('admin/pages/all');
    }

    public function save(Request $request) {

        $request->user()->authorizeRoles(['Administrator']);

        $input = $request->input();
        $params = request()->route()->parameters();
        
         if (isset($input['_token'])) {
            unset($input['_token']);
        }
        
        $object = $this->pages->find($params["object_id"]);
        
        $slug = $this->slugs->where('slug', $object->slug)->first();
        $slug->slug = $input['slug'];
        $slug->save();
        
        foreach ($input as $key => $value) {
                $object->$key = $value;
            }
        $object->save();
        
        
        
        \Session::flash('message', ' <div class="alert alert-success">Saved Successfully</div>');

        return redirect('admin/pages/all');
    }

}
