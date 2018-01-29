<?php

use Illuminate\Database\Seeder;
use App\Models\Pages;

class PagesTableSeeder extends Seeder {

    public function run() {
        $page = new Pages();
        $page->title = 'Home';
        $page->content = '';
        $page->meta_title = 'Binance Tools - Crypto Trading Tools';
        $page->meta_description = 'Home';
        $page->slug = '/';
        $page->save();
    }

}
