<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewsRequest;
use App\Review;
use Illuminate\Support\Facades\Session;

class AdminReviewsController extends Controller
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
        // Get all reviews.
        $reviews = Review::all()->sortByDesc('updated_at');

        // Load view from the resource "resources\views\admin\reviews\index.blade.php"
        return view('admin.reviews.index', compact('reviews'));
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
        // Get review with specific ID.
        $review = Review::findOrFail($id);

        // Get possible rates for review.
        $rates = Review::getRates();

        // Load view from the resource "resources\views\admin\reviews\edit.blade.php"
        return view('admin.reviews.edit', compact('review', 'rates'));
    }

    /******************************************************************************************************************/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReviewsRequest $request, $id)
    {
        // Find and update review with specific ID.
        Review::findOrFail($id)->update($request->all());

        // Make the toast message for the edition.
        Session::flash('toastMessage', 'Review has been updated.');

        // Redirect to the list of reviews.
        return redirect()->route('admin.reviews.index');
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
        // Find and delete review with specific ID.
        Review::findOrFail($id)->delete();

        // Make the toast message for the deletion.
        Session::flash('toastMessage', 'Review has been deleted.');

        // Redirect to the list of reviews.
        return redirect()->route('admin.reviews.index');
    }

    /******************************************************************************************************************/

    /**
     * Changes state of the review to "visible".
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function visible(int $id)
    {
        // Find review with specific ID and change state.
        Review::findOrFail($id)->update(['visible' => '1']);

        // Redirect to the previous page.
        return back();
    }

    /******************************************************************************************************************/

    /**
     * Changes state of the review to "hidden".
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function hidden(int $id)
    {
        // Find review with specific ID and change state.
        Review::findOrFail($id)->update(['visible' => '0']);

        // Redirect to the previous page.
        return back();
    }
}
