<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Settings;
use App\Models\User;
use App\Models\Items;
use App\Models\Categories;
use App\Models\Pages;

class CategoriesController extends Controller
{
    
    public function __construct()
    {
        $this->categories = Categories::where('status', 1)->get();
        $this->pages = Pages::where('status', 1)->get();
    }
    
    // ***
    // get Category
    // ***
    public function categories($slug)
    {
        
        $getCategory = Categories::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();
        
        // get items list
        $items = Items::whereHas('category', function ($query) {
            $query->where('status', 1); 
        })->where('status', 1)
            ->where('category_id', $getCategory->id)
            ->orderByDesc('id')
            ->paginate(15);
        
        return view('layouts.categories.index')->with([
            'site_name' => Settings::find('site_name')->value,
            'site_description' => Settings::find('site_description')->value,
            'page_name' => $getCategory->name,
            'categories' => $this->categories,
            'pages' => $this->pages,
            'status_write' => Settings::find('active_upload')->value,
            'getCategory' => $getCategory,
            'items' => $items
        ]);
        
    }
    
}