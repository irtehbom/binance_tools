<?php

use Illuminate\Database\Seeder;
use App\Models\Slugs;

class SlugsTableSeeder extends Seeder {

    public function run() {
        $slugs = new Slugs();
        $slugs->slug = '/';
        $slugs->type = 'page';
        $slugs->save();
    }

}
