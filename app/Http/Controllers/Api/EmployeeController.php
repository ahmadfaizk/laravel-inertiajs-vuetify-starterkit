<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $this->validate($request, [
            'page_size' => 'nullable|integer',
            'page' => 'nullable|integer',
        ]);
        $results = Employee::paginate(request('page_size', 10));
        return response()->json([
            'message' => 'Success get all employees!',
            'properties' => [
                'page' => $results->currentPage(),
                'total' => $results->total(),
                'total_page' => $results->lastPage(),
                'page_size' => $results->perPage(),
                'has_more_pages' => $results->hasMorePages()
            ],
            'data' => $results->items(),
        ]);
    }
}
