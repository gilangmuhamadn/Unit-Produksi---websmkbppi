<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Storage;


class ArticleController extends Controller
{
    // public function index()
    // {
    //     $articles = Article::latest()->take(5)->get();
    //     return view('home', compact('articles'));
    // }
    public function index(Request $request)
    {

    
        $articles = Article::latest()->paginate(10); // Atur pagination jika banyak artikel
        
        return view('articles.index', compact('articles'));
    }

    // Menampilkan detail artikel
    public function show($id)
    {
        $article = Article::findOrFail($id);
        $latestArticles = Article::latest()->take(8)->get();
        $latestNews = News::latest()->take(8)->get(); // asumsi kamu punya model News
        $randomArticles = Article::inRandomOrder()->take(3)->get();
    
        return view('articles.show', compact('article', 'latestArticles', 'latestNews', 'randomArticles'));
        
    }
    
    public function uploadImage(Request $request)
{
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $path = $file->store('uploads', 'public');
        $url = asset('storage/' . $path);
        return response()->json(['location' => $url]);
    }

    return response()->json(['error' => 'No file uploaded.'], 400);
}


    
    public function create()
{
    return view('admin.articles.create');
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required',
        'image' => 'nullable|image|',
        
    ]);

    $data = $request->all();
    if ($request->hasFile('image')) {
    $filename = time() . '_' . $request->file('image')->getClientOriginalName();
    $request->file('image')->move(public_path('storage/articles'), $filename);
    $data['image'] = 'articles/' . $filename; 
}
    Article::create($data);

    return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil ditambahkan.');
}



public function edit($id)
{
    $article = Article::findOrFail($id);
    return view('admin.articles.edit', compact('article'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'title'   => 'required|string|max:255',
        'content' => 'required',
        'image'   => 'nullable|image',
    ]);

    $article = Article::findOrFail($id);

    $imagePath = $article->image; 

    if ($request->hasFile('image')) {
        // Hapus file lama kalau ada
        if ($imagePath && file_exists(public_path('storage/' . $imagePath))) {
            unlink(public_path('storage/' . $imagePath));
        }

        // Upload file baru
        $filename = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('storage/articles'), $filename);

        $imagePath = 'articles/' . $filename;
    }

    // Update data
    $article->update([
        'title'   => $request->title,
        'content' => $request->content,
        'image'   => $imagePath, // kalau tidak upload, pakai path lama
    ]);

    return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui.');
}



public function destroy($id)
{
    $article = Article::findOrFail($id);

    if ($article->image) {
        Storage::delete('public/' . $article->image);
    }

    $article->delete();

    return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus.');
}

}
