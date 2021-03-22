<?php

namespace App\Http\Controllers;

use App\Models\Social;
use Illuminate\Http\Request;
use App\Models\Menu;

class BaseController extends Controller
{
    protected $data;
    public function __construct()
    {
        $this->data['menu'] = Menu::with(['party', 'party.menuItems', 'party.categories'])
            ->join('parties', 'party_id', '=', 'parties.id')
            ->leftJoin('menu_items', 'parties.id', '=', 'menu_items.party_id')
            ->leftJoin('categories', 'parties.id', '=', 'categories.party_id')
            ->select('categories.name', 'menu_items.text', 'route', 'categories.id AS cat_id')->orderBy('order')
            ->get();


        $this->data['social'] = Social::all();
    }
}
