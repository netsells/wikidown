<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::pattern('slug', '.*');

Route::get('{slug?}/password', function($slug = 'index')
{
    return View::make('page.password');
});

Route::post('{slug?}/password', function($slug = 'index')
{
    if (Config::get('wikidown.password') !== Input::get('password')) {
        return 'access denied';
    } else {
        Session::put('wikidown-authed', true);
    }

    return Redirect::to($slug . '/edit');
});

Route::get('{slug?}/edit', function($slug = 'index')
{
    if (!Session::get('wikidown-authed')) {
        return Redirect::to($slug . '/password');
    }

    $parsedown = new Parsedown;
    $markdownFile = wiki_path($slug . '.md');

    if (File::exists($markdownFile)) {
        $markdown = File::get($markdownFile);
    } else {
        $markdownFile = wiki_path($slug . '/index.md');
        
        if (File::exists($markdownFile)) {
            $markdown = File::get($markdownFile);
        } else {
            $markdown = '';
        }
    }

    return View::make('page.edit', ['markdown' => $markdown]);
});

Route::post('{slug?}/edit', function($slug = 'index')
{
    if (!Session::get('wikidown-authed')) {
        return Redirect::to($slug . '/password');
    }

    if (file_exists(dirname(wiki_path($slug)) . '.md')) {
        File::makeDirectory(dirname(wiki_path($slug)), 0777, true, true);
        File::move(dirname(wiki_path($slug)) . '.md', dirname(wiki_path($slug)) . '/index.md');
    }

    if (is_dir(wiki_path($slug))) {
        $markdownFile = wiki_path($slug . '/index.md');
    } else {
        File::makeDirectory(dirname(wiki_path($slug)), 0777, true, true);
        $markdownFile = wiki_path($slug . '.md');
    }

    $content = Input::get('markdown');

    File::put($markdownFile, $content);

    return Redirect::to($slug);
    
});

Route::get('{slug}', function($slug = 'index')
{
    $parsedown = new Parsedown;
    $markdownFile = wiki_path($slug . '.md');

    if (File::exists($markdownFile)) {
        $markdown = File::get($markdownFile);
    } else {
        $markdownFile = wiki_path($slug . '/index.md');
        
        if (File::exists($markdownFile)) {
            $markdown = File::get($markdownFile);
        } else {
            $markdown = "## This page does not exist. \nYou can create it by clicking edit.";
        }
    }

    return View::make('page.view', ['page' => $parsedown->text($markdown), 'slug' => $slug]);
});

View::composer('page.view', function($view) {

    $menu = buildTreeForDirectory(wiki_path());

    $view->with('menu', $menu);
});

function buildTreeForDirectory($path) {
    $items = File::glob($path . '/*');
    $return = '';

    if ($path !== wiki_path()) {
        $return .= "<strong>" . formatPageName($path) . "</strong>";
    }
    $return .= "<ul>";

    if ($path == wiki_path()) {
        $return .= "<strong>" . formatPageName(wiki_path('index.md')) . "</strong>";
    }

    foreach($items as $item) {
        $return .= "<li>";

        if (File::isDirectory($item)) {
            $return .= buildTreeForDirectory($item);
        } else {
            $return .= formatPageName($item);
        }

        $return .= "</li>";
    }
    $return .= "</ul>";

    return $return;
}

function formatPageName($page) {
    $path = str_replace(wiki_path(), '', str_replace('.md', '', $page));
    $title = ucwords(str_replace('.md', '', basename($page)));
    return "<a href='{$path}'>{$title}</a>";
}
