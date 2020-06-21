<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Noisanxuat;
use GrahamCampbell\Markdown\Facades\Markdown;
use App\Dienthoai;
use App\Danhmuc;

class DienthoaiHomeController extends Controller
{
    public function index()
    {
        # Home page
        $dienthoai_iphones = Dienthoai::with('danhmuc')->whereHas('danhmuc', function($query) {
            $query->where('slug', 'iphone'); })
            ->take(8)
            ->latestFirst()
            ->get();
        $dienthoai_samsungs = Dienthoai::with('danhmuc', 'noisanxuat', 'image')
            ->whereHas('danhmuc', function ($query){
                $query->where('slug', 'samsung'); })
            ->take(4)
            ->latestFirst()
            ->get();
        $discount_phones = Dienthoai::with('danhmuc')
            ->where('discount_rate', '>', 0)
            ->orderBy('discount_rate', 'desc')
            ->take(6)
            ->get();
        return view('public.home', compact('dienthoai_iphones', 'discount_phones', 'dienthoai_samsungs'));
    }

    public function allPhones()
    {
        $dienthoais = Dienthoai::with('noisanxuat', 'image', 'danhmuc')
                    ->orderBy('id', 'DESC')
                    ->search(request('term')) #...Search Query
                    ->paginate(16);
        return view('public.book-page', compact('dienthoais'));
    }

    public function discountPhones()
    {
        # ComposerServiceProvider load here
        $discountTitle = "All discount dienthoais";
        $dienthoais = Dienthoai::with('noisanxuat', 'image', 'danhmuc')
            ->orderBy('discount_rate', 'DESC')
            ->where('discount_rate', '>', 0)
            ->paginate(16);
        return view('public.book-page', compact('dienthoais', 'discountTitle'));
    }

    public function danhmuc(Danhmuc $danhmuc)
    {
        $tendanhmucs = $danhmuc->name;
        $dienthoais = $danhmuc->dienthoai()
            ->with('danhmuc', 'noisanxuat', 'image')
            ->orderBy('id','DESC')
            ->paginate(16);
        return view('public.book-page', compact('dienthoais', 'tendanhmucs'));
    }

    public function noisanxuat(Noisanxuat $noisanxuat)
    {
        $noisanxuat = $noisanxuat->name;
        $dienthoais = $noisanxuat->dienthoai()
            ->with('danhmuc', 'noisanxuat', 'image')
            ->orderBy('id', 'DESC')
            ->paginate(12);
        return view('public.book-page', compact('dienthoais', 'noisanxuat'));
    }

    public function phoneDetails($id)
    {
        $dienthoai = Dienthoai::findOrFail($id);
        $dienthoai_danhgia = $dienthoai->danhgia()->latest()->get();
        return view('public.book-details' , compact('dienthoai', 'dienthoai_danhgia'));
    }
}
