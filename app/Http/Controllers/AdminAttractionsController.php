<?php

namespace App\Http\Controllers;

use App\Attraction;
use App\Http\Requests\AttractionsRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AdminAttractionsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /******************************************************************************************************************/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all attractions.
        $attractions = Attraction::all()->sortBy('name');

        // Load view from the resource "resources\views\admin\attractions\index.blade.php"
        return view('admin.attractions.index', compact('attractions'));
    }

    /******************************************************************************************************************/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Load view from the resource "resources\views\admin\attractions\create.blade.php"
        return view('admin.attractions.create');
    }

    /******************************************************************************************************************/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttractionsRequest $request)
    {
        // Create new attraction and assign to the current user.
        $attraction = Auth::user()->attractions()->create($request->input());

        // Check all uploaded files.
        foreach ($request->file('photo') as $file) {
            // Move uploaded file into the storage.
            $path = Storage::disk('public')->putFile('photos', $file);

            // Create new record in database for the photo and assign that specific row with attraction.
            Auth::user()->photos()->create([
                'attraction_id' => $attraction->id,
                'path' => $path
            ]);
        }

        // Redirect to the list of the attractions.
        return redirect()->route('admin.attractions.index');
    }

    /******************************************************************************************************************/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Get attraction with the specific ID.
        $attraction = Attraction::findOrFail($id);

        // Load view from the resource "resources\views\admin\attractions\edit.blade.php"
        return view('admin.attractions.edit', compact('attraction'));
    }

    /******************************************************************************************************************/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttractionsRequest $request, $id)
    {
        // Get attraction with specific ID.
        $attraction = Attraction::findOrFail($id);

        // Update attraction.
        $attraction->update($request->all());

        // Redirect to the list of the attractions.
        return redirect()->route('admin.attractions.index');
    }

    /******************************************************************************************************************/

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get attraction with the specific ID.
        $attraction = Attraction::findOrFail($id);

        // Remove all files from the storage.
        Storage::delete($attraction->photos);

        // Make a toast message for this deletion.
        Session::flash('toastMessage', 'Attraction "' . $attraction->name . '" has been removed.');

        // Delete attraction and related photos from the database.
        $attraction->delete();

        // Redirect to the list of the attractions.
        return redirect()->route('admin.attractions.index');
    }
}
