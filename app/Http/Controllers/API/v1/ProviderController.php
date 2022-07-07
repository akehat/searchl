<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use App\Http\Resources\v1\ProviderResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        $providers = Provider::all();
        return response(['property' => ProviderResource::collection($providers), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'profession_type' => 'required|max:255',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'base_location' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'search_fields' => 'required|max:255',
            'standard_work_hours' => 'required|min:3',
            'emergency_availability' => 'required',
            'share_exact_location' => 'required',
            // 'property_name' => 'required|unique:properties|max:255',
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $provider = Provider::create($data);
        return response(['provider' => new ProviderResource($provider), 'message' => 'Provider Created Successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        return response(['provider' => new ProviderResource($provider), 'message' => 'Retrieved Successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provider $provider)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'standard_work_hours' => 'min:3',
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $provider->update($request->all());
        return response(['provider' => new ProviderResource($provider), 'message' => 'Provider Updated Successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        $provider->delete();
        return response(['message' => 'Provider Deleted Successfully']);
    }
}