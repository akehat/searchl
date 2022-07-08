<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\SearchLog;
use Illuminate\Http\Request;

use App\Http\Resources\v1\SearchLogResource;
use Illuminate\Support\Facades\Validator;


class SearchLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searchLogs = SearchLog::all();
        return response(['property' => SearchLogResource::collection($searchLogs), 'message' => 'Retrieved successfully'], 200);
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

        // $validator = Validator::make($data, [
        //     'profession_type' => 'required|max:255',
        //     'first_name' => 'required|max:255',
        //     'last_name' => 'required|max:255',
        //     'base_location' => 'required|max:255',
        //     'phone_number' => 'required|max:255',
        //     'search_fields' => 'required|max:255',
        //     'standard_work_hours' => 'required|min:3',
        //     'emergency_availability' => 'required',
        //     'share_exact_location' => 'required',
        //     // 'property_name' => 'required|unique:properties|max:255',
        // ]);

        // if ($validator->fails()) {
        //     return response(['error' => $validator->errors(), 'Validation Error']);
        // }

        $searchLog = SearchLog::create($data);
        return response(['searchLog' => new SearchLogResource($searchLog), 'message' => 'SearchLog Created Successfully'], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SearchLog  $searchLog
     * @return \Illuminate\Http\Response
     */
    public function show(SearchLog $searchLog)
    {
        return response(['searchLog' => new SearchLogResource($searchLog), 'message' => 'Retrieved Successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SearchLog  $searchLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SearchLog $searchLog)
    {
        // $data = $request->all();

        // $validator = Validator::make($data, [
        //     // 'standard_work_hours' => 'min:3',
        // ]);

        // if ($validator->fails()) {
        //     return response(['error' => $validator->errors(), 'Validation Error']);
        // }

        $searchLog->update($request->all());
        return response(['searchLog' => new SearchLogResource($searchLog), 'message' => 'searchLog Updated Successfully'], 200);    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SearchLog  $searchLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(SearchLog $searchLog)
    {
        $searchLog->delete();
        return response(['message' => 'searchLog Deleted Successfully']);    }
}
