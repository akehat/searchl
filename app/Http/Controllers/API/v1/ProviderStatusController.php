<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\ProviderStatus;
use App\Http\Resources\v1\ProviderStatusResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProviderStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allProviderStatus = ProviderStatus::all();
        return response(['property' => ProviderStatusResource::collection($allProviderStatus), 'message' => 'Retrieved successfully'], 200);

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
            'provider_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $providerStatus = ProviderStatus::create($data);
        return response(['providerStatus' => new ProviderStatusResource($providerStatus), 'message' => 'Provider Status Created Successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProviderStatus  $providerStatus
     * @return \Illuminate\Http\Response
     */
    public function show(ProviderStatus $providerStatus)
    {
        return response(['providerStatus' => new ProviderStatusResource($providerStatus), 'message' => 'Retrieved Successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProviderStatus  $providerStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProviderStatus $providerStatus)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            // 'standard_work_hours' => 'min:3',
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $providerStatus->update($request->all());
        return response(['providerStatus' => new ProviderStatusResource($providerStatus), 'message' => 'Provider Updated Successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProviderStatus  $providerStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProviderStatus $providerStatus)
    {
        $providerStatus->delete();
        return response(['message' => 'ProviderStatus Deleted Successfully']);
    }
}
