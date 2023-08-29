<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RealtorListingController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }

    public function index(Request $request)
    {
        $filters = [
            'deleted' => $request->boolean('deleted'),
            ...$request->only(['by', 'order'])
        ];

        return inertia(
            'Realtor/Index',
            [
                'filters' => $filters,
                'listings' => Auth::user()
                    ->listings()->withCount('images')
                    ->withCount('offers')
                    // ->mostRecent()
                    ->filter($filters)
                    ->paginate(4)
                    ->withQueryString()
            ]
        );
    }

    public function show(Listing $listing)
    {
        return inertia('Realtor/Show',
         ['listing' => $listing->load('offers', 'offers.bidder')]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('Realtor/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->user()->listings()->create(
            $request->validate(
                [
                    'beds' => 'required|integer|min:1',
                    'baths' => 'required|integer|min:1|max:20',
                    'area' => 'required|integer|min:40|max:1000',
                    'city' => 'required',
                    'code' => 'required',
                    'street' => 'required',
                    'street_number' => 'required|integer',
                    'price' => 'required|integer|min:1|max:20000000',
                ]
            )
        );




        return redirect()->route('realtor.listing.index')->with('success', 'Listing was successfully added');
    }

    public function destroy(Listing $listing)
    {

        $listing->deleteOrFail();

        return redirect()->back()->with("success", 'Listing was successfully deleted!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Listing $listing)
    {
        return inertia(
            'Realtor/Edit',
            [
                'listing' => $listing,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Listing $listing)
    {
        $listing->update(
            $request->validate([
                'beds' => 'required|integer|min:1',
                'baths' => 'required|integer|min:1|max:20',
                'area' => 'required|integer|min:40|max:1000',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_number' => 'required|integer',
                'price' => 'required|integer|min:1|max:20000000',
            ])
        );
        return redirect()->route('realtor.listing.index')->with('success', 'Listing was successfully updated');
    }

    public function restore(Listing $listing)
    {
        $listing->restore();
        return redirect()->back()->with('success', 'Listing was successfully restored');
    }
}
