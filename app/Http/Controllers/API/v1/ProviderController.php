<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use App\Http\Resources\v1\ProviderResource;

// use App\Models\ProviderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Provider::all();
        return response(['providers' => ProviderResource::collection($providers), 'message' => 'Retrieved successfully'], 200);
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

    public function getprovidersByProfession($profession_type)
    {
        if (!$profession_type) {
            return response(['message' => 'not found'], 404);
        }

        $providers = Provider::all()->where('profession_type', $profession_type);
        return response(['property' => ProviderResource::collection($providers), 'message' => 'Retrieved successfully'], 200);
    }


    //TODO abs() is a temporary hack

    /**
     * This function returns providers that:
     * 1. confirm to the profession type
     * 2. are available (green. also orange for emergency)
     * 3. in the selected range
     *
     * Save in the DB according to KM. if searching according to MI - convert to KM.
     * emergency: 0 or 1
     *
     * too many params. change to POST ?
     * suggestion: create search object. POST to store (with statistics) and search, and return available providers
     */
    public function getAvailableProviders($profession_type=null,  $longitude=null, $latitude=null, $emergency=false, $range = 10, $range_type = 'KM')
    {
        if (!$profession_type || !$longitude || !$latitude) {
            return response(['message' => 'not found'], 404);
        }

        if ($range_type == 'MI') $range.=1.60934; // convert to KM
        // TODO check this:
        $coordRadius = $range / 69;

        $availableMode = $emergency ? ['green','orange'] : ["green"];

        $allProviders = DB::table('providers')
            ->Join('provider_statuses', 'providers.id', '=', 'provider_statuses.provider_id')
            ->select('providers.id as providers_id','providers.*', 'provider_statuses.*')
            ->where('profession_type', $profession_type)
            ->where(DB::raw('ABS(latitude)'), '>=', abs($latitude) - $coordRadius)
            ->where(DB::raw('ABS(latitude)'), '<=', abs($latitude) + $coordRadius)
            ->where(DB::raw('ABS(longitude)'), '>=', abs($longitude) - $coordRadius)
            ->where(DB::Raw('ABS(longitude)'), '<=', abs($longitude) + $coordRadius)
            ->whereIn('is_available', $availableMode)
            ->get();

        return response(['avilableProviders' => json_decode($allProviders), 'message' => 'Retrieved successfully'], 200);
        // return response(['property' => ProviderResource::collection($allProviders), 'message' => 'Retrieved successfully'], 200);
    }

}
