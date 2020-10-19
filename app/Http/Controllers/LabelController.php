<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLabelRequest;
use App\Http\Resources\LabelResource;
use App\Models\Labels;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function create(CreateLabelRequest $request)
    {
        if ($label = Labels::create($request->only('title', 'color'))) {
            return response()->json(LabelResource::make($label), 200);
        }

        return response()->json(['success' => false, 'message' => 'Can not create label. Server error!'], 400);
    }

    public function getLabels()
    {
        if ($labels = Labels::get()) {
            return response()->json(LabelResource::collection($labels), 200);
        }

        return response()->json(['success' => false, 'message' => 'Can not get labels. Server error!'], 400);
    }

    public function delete(Labels $label)
    {
        if ($label->delete()) {
            return response()->json(['success' => true, 'message' => 'Label was deleted successfully'], 200);
        }

        return response()->json(['success' => false, 'message' => 'Can not delete task. Server error!'], 400);
    }
}
