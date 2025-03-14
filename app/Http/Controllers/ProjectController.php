<?php

namespace App\Http\Controllers;

use App\Models\Gambar;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // Set bahasa default jika session belum ada
        if (!session()->has('app_locale')) {
            session(['app_locale' => 'en']);
        }
        // Mendapatkan bahasa dari session atau default 'en'
        $language = session('app_locale', 'en');
        App::setLocale($language);

        // Mendapatkan proyek sesuai bahasa yang dipilih
        $projects = Project::all();
        return view('index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id_project, Request $request)
    {

        // Set bahasa default jika session belum ada
        if (!session()->has('app_locale')) {
            session(['app_locale' => 'en']);
        }
        // Mendapatkan bahasa dari session atau default 'en'
        $language = session('app_locale', 'en');
        App::setLocale($language);

        // Ambil proyek berdasarkan id
        $project = Project::find($id_project);
        $gambarProject = Gambar::where('id_project', $id_project)->get();
        return view('detail', compact('project', 'gambarProject'));
    }

    // Fungsi untuk mengubah bahasa
    public function changeLanguage($language)
    {
        session(['app_locale' => $language]);
        return redirect()->back();  // Kembali ke halaman sebelumnya
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }

    // Fungsi untuk menampilkan proyek berdasarkan kategori
    public function hospitality()
    {
        $projects = Project::where('category_en', 'hospitality')->get();
        return view('index', compact('projects'));
    }

    public function residential()
    {
        $projects = Project::where('category_en', 'residential')->get();
        return view('index', compact('projects'));
    }

    public function interior()
    {
        $projects = Project::where('category_en', 'interior')->get();
        return view('index', compact('projects'));
    }

    public function commercial()
    {
        $projects = Project::where('category_en', 'commercial')->get();
        return view('index', compact('projects'));
    }

    public function cultural()
    {
        $projects = Project::where('category_en', 'cultural')->get();
        return view('index', compact('projects'));
    }

    public function recreational()
    {
        $projects = Project::where('category_en', 'recreational')->get();
        return view('index', compact('projects'));
    }

}
