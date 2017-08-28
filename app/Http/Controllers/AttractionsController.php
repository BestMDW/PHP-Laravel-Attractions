<?php

namespace App\Http\Controllers;

use App\Attraction;
use Illuminate\Http\Request;

class AttractionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all approved attractions.
        $attractions = Attraction::all();

        // Load view from the resource "resources\views\attractions\index.blade.php"
        return view('attractions.index', compact('attractions'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get attraction with specific ID.
        $attraction = Attraction::findOrFail($id);

        // Load view from the resource "resources\views\attractions\show.blade.php"
        return view('attractions.show', compact('attraction'));
    }
}
