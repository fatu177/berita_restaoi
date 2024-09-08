<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\post;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getuser() {
        $post = post::all();
        return PostResource::collection($post);
    }

}
