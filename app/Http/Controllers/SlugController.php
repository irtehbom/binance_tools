<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use App\Models\Posts;
use App\Models\Slugs;
use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;

class SlugController extends Controller {

    public function __construct() {
        $this->slugs = new Slugs;
        $this->posts = new Posts;
        $this->pages = new Pages;
    }

    public function get($slug = null, $result = null) {

        $object = $this->slugs->where('slug', basename($slug))->firstOrFail();
        
        switch ($object->type) {

            case 'page':
                
                $result = $this->pages->where('slug', $slug)->firstOrFail();

                if ($object->slug == 'blog') {
                    
                    $posts = $this->posts->all();
                    
                    return view('front_templates/blog', [
                        "result" => $result,
                        "posts" => $posts
                    ]);
                }

                return view('front_templates/pages', [
                    "result" => $result
                ]);

                break;

            case 'post':

                $result = $this->posts->where('slug', basename($slug))->firstOrFail();

                return view('front_templates/posts', [
                    "result" => $result
                ]);

                break;
        }
    }

    public function getHomepage() {

        $result = $this->pages->where('slug', '/')->firstOrFail();
        $user_count = DB::table('users')->count();
        $user_goal = $user_count / 1000 * 100;
		$current_users_online = $user_count / 6.2;
		
		$online = rand (17, $current_users_online - 7);

        return view('front_templates/home', [
            'user_count' => $user_count,
            'user_goal' => $user_goal,
            'result' => $result,
			'current_users_online' => round($online)
        ]);
    }

}
