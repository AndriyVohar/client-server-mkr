<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Http\Requests\StoreMedicineRequest;
use Illuminate\Http\Request;

class MedicineApiController extends Controller
{
    public function index()
    {
        // Return paginated list as JSON
        return response()->json(Medicine::orderBy('id', 'desc')->paginate(15));
    }

    public function store(StoreMedicineRequest $request)
    {
        $medicine = Medicine::create($request->validated());
        return response()->json($medicine, 201);
    }

    public function show(Medicine $medicine)
    {
        return response()->json($medicine);
    }

    public function update(StoreMedicineRequest $request, Medicine $medicine)
    {
        $medicine->update($request->validated());
        return response()->json($medicine);
    }

    public function destroy(Medicine $medicine)
    {
        $medicine->delete();
        return response()->noContent();
    }
}

