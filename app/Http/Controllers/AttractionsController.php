<?php

namespace App\Http\Controllers;

use App\Attraction;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttractionsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /******************************************************************************************************************/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all approved attractions.
        $attractions = Attraction::all()->sortBy('name');

        // Load view from the resource "resources\views\attractions\index.blade.php"
        return view('attractions.index', compact('attractions'));
    }

    /******************************************************************************************************************/


    public function topRated()
    {
        // Get all approved attractions.
        $attractions = Attraction::select('attractions.*', DB::raw('AVG(reviews.rating) AS rate'))
            ->leftJoin('reviews', 'attractions.id', '=', 'reviews.attraction_id')
            ->groupBy('id')
            ->orderByDesc('rate')
            ->limit(5)
            ->get();

        // Load view from the resource "resources\views\attractions\index.blade.php"
        return view('attractions.topRated', compact('attractions'));
    }

    /******************************************************************************************************************/

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

        // Get possible rates for review.
        $rates = Review::getRates();

        // Get all visible reviews.
        $reviews = Review::where(['attraction_id' => $id, 'visible' => '1'])->orderByDesc('created_at')->get();

        // Get users review.
        $userReview = $attraction->reviews()->whereUserId(Auth::user()->id)->first();

        // Load view from the resource "resources\views\attractions\show.blade.php"
        return view('attractions.show', compact('attraction', 'rates', 'reviews', 'userReview'));
    }
}
