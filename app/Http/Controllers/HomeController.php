<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Guide;
use App\Models\Contact;

class HomeController extends Controller
{
    public function index()
    {
        $news = News::orderBy('published_at', 'desc')->limit(5)->get();
        return view('pages.home', compact('news'));
    }

    public function news_page()
    {
        $news = News::orderBy('published_at', 'desc')->get();
        return view('pages.news', compact('news'));
    }

    public function news_detail($slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();

        return view('pages.news-detail', compact('news'));
    }

    public function instruction_page()
    {
        $guide = Guide::get()->first();
        return view('pages.panduan', compact('guide'));
    }

    public function contact_page()
    {
        $contact = Contact::get()->first();
        return view('pages.contact', compact('contact'));
    }
}
