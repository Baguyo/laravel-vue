<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth')->except(['index', 'show']);
        $this->authorizeResource(Listing::class, 'listing');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // dd($request->user()->unreadNotifications()->count());
        $filters = $request->only([
            'priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo'
        ]);

        // dd($filters['priceFrom']);

      

        return inertia(
            'Listing/Index',
            [
                'filters' => $filters,
                'listings' => Listing::mostRecent()
                    ->filter($filters)
                    ->withoutSold()
                    ->paginate(10)
                    ->withQueryString(),
            ]
        );
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Listing $listing)
    {
        // if(Auth::user()->cannot('view', $listing)){
        //     abort(403);
        // } // MANUAL POLICY CHECKING RETURN TRUE OR FALSE

        // $this->authorize('view', $listing); // POLICY CHECKING

        $listing->load(['images']);
        $offer = !Auth::user() ? null : $listing->offers()->byMe()->first();

        return inertia(
            'Listing/Show',
            [
                'listing' => $listing,
                'offerMade'=> $offer
            ]
        );
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Listing $listing)
    // {
    //     $listing->delete();

    //     return redirect()->back()->with("success", 'Listing was successfully deleted!');
    // }
}
