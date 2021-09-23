<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $data = Employee::when($request->sort_by, function ($query, $value) {
                $query->orderBy($value, request('order_by', 'asc'));
            })
            ->when(!isset($request->sort_by), function ($query) {
                $query->latest();
            })
            ->when($request->search, function ($query, $value) {
                $query->where('name', 'LIKE', '%'.$value.'%');
            })
            ->paginate($request->page_size ?? 10);
        return Inertia::render('employee/index', [
            'items' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|string',
            'job_title' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
        ]);
        Employee::create($data);
        return redirect()->back()->with('message', [
            'type' => 'success',
            'text' => 'Success create employee!',
        ]);
    }

    public function update(Employee $employee, Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|string',
            'job_title' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string'
        ]);
        $employee->update($data);
        return redirect()->back()->with('message', [
            'type' => 'success',
            'text' => 'Success edit employee!',
        ]);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->back()->with('message', [
            'type' => 'success',
            'text' => 'Success delete employee!',
        ]);
    }
}
