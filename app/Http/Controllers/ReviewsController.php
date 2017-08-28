<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewsRequest;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ReviewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param $attractionId
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewsRequest $request, $attractionId)
    {
        // Get all request.
        $input = $request->all();
        // Assign review to the specific attraction.
        $input['attraction_id'] = $attractionId;

        // Add review.
        Auth::user()->reviews()->create($input);

        // Create the toast message.
        Session::flash('toastMessage', 'Review has been added.');

        // Redirect back to the attraction.
        return redirect()->route('attractions.show', $attractionId);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $reviewId
     * @return \Illuminate\Http\Response
     */
    public function update(ReviewsRequest $request, $attractionId, $reviewId)
    {
        // Find review with specific ID and check if belongs to the logged user.
        $review = Review::whereUserId(Auth::id())->findOrFail($reviewId);
        // Update review.
        $review->update($request->all());

        // Create the toast message.
        Session::flash('toastMessage', 'Review has been updated.');

        // Redirect back to the attraction.
        return redirect()->route('attractions.show', $attractionId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
