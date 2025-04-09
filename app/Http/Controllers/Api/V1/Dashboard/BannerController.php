<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Api\BannerResource;
use App\Models\Banner;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->take(5)->get();
        return BannerResource::collection($banners);
    }
}
