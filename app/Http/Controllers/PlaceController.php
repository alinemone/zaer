<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Place;
use App\Http\Requests\Places\editPlaceRequest;
use App\Http\Requests\Places\createPlaceRequest;
use App\Repositories\Places\PlacesRepositoryInterface;


class PlaceController extends Controller
{

    /**
     *
     */
    public function list()
    {
        /** @var PlacesRepositoryInterface $repository */
        $repository = app(PlacesRepositoryInterface::class);
        $places = $repository->allPlaces();

        return view('admin.places.list', compact('places'));
    }

    public function create()
    {
        return view('admin.places.create-place');
    }

    /**
     * @param \App\Http\Requests\Places\createPlaceRequest $request
     */
    public function store(createPlaceRequest $request)
    {
        /** @var PlacesRepositoryInterface $repository */
        $repository = app(PlacesRepositoryInterface::class);
        $repository->createPlaces($request->all());

        return redirect(route('admin.place.list'));
    }

    /**
     * @param $id
     */
    public function edit($id)
    {
        /** @var PlacesRepositoryInterface $repository */
        $repository = app(PlacesRepositoryInterface::class);
        $place = $repository->getPlace($id);

        return view('admin.places.edit', compact('place'));
    }

    /**
     * @param \App\Http\Requests\Places\editPlaceRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(editPlaceRequest $request, $id)
    {
        /** @var PlacesRepositoryInterface $repository */
        $repository = app(PlacesRepositoryInterface::class);
        $repository->updatePlace($request->all(), $id);

//        alert()->success('با موفقیت به روزرسانی شد!');

        return redirect(route('admin.place.list'))->with('success', 'Profile updated!');
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        Place::where(Place::ID, $id)
            ->withoutGlobalScope('isActive')
            ->delete();
        alert()->success('اقامتگاه باموفقیت حذف شد');
        return back();
    }

    public function rooms($id)
    {
        return Room::where(Room::PLACE_ID, $id)
            ->withoutGlobalScope('isActive')
            ->get();
    }
}
