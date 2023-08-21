<?php

namespace App\Http\Controllers;

use App\Models\BaseObject;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ObjectController extends Controller
{
    public function index(): Response
    {
        $categories = Category::all();
        $objects = BaseObject::all();
        return Inertia::render('Dashboard', compact('categories', 'objects'));
    }

    public function getCategory($id)
    {
        return Category::where('id', $id)->first();
    }

    public function search(Request $request)
    {
        $free_filter = $request->free_filter;
        $paid_filter = $request->paid_filter;
        $android_filter = $request->android_filter;
        $ios_filter = $request->ios_filter;

        return json_encode($request);
    }
}
