<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\REWARD;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $rewards = REWARD::select(['id', 'name', 'image'])
          ->where('is_active', true)
          ->paginate(12);

        $rewards = $rewards->toArray();

        foreach ($rewards['data'] as $key => $value) {
            $rewards['data'][$key]['image'] = asset('storage/'.$rewards['data'][$key]['image']);
        }

        return response()->json($rewards);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        //
    }
}
