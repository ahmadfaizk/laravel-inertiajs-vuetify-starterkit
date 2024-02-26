<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PeopleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = People::query()->when($request->get('search'), function ($query, $search) {
            $search = strtolower(trim($search));
            return $query->whereRaw('LOWER(name) LIKE ?', ["%$search%"]);
        })->when($request->get('sort'), function ($query, $sortBy) {
            return $query->orderBy($sortBy['key'], $sortBy['order']);
        });

        $data = $query->paginate($request->get('limit', 10));

        return Inertia::render('People/Index', [
            'data' => $data
        ]);
    }

    public function create()
    {
        return Inertia::render('People/Create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'gender' => ['required'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable'],
            'address' => ['nullable'],
        ]);

        $people = People::create($request->all());
        $message = sprintf('Successfully created %s', $people->name);

        return redirect()->back()->with('success', $message);
    }

    public function edit(People $person)
    {
        return Inertia::render('People/Edit', [
            'person' => $person
        ]);
    }

    public function update(People $person, Request $request)
    {
        $data = $this->validate($request, [
            'name' => ['required'],
            'gender' => ['required'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable'],
            'address' => ['nullable'],
        ]);
        $person->update($data);
        $message = sprintf('Successfully updated %s', $person->name);

        return redirect()->back()->with('success', $message);
    }

    public function destroy(People $person)
    {
        $person->delete();
        $message = sprintf('Successfully deleted %s', $person->name);

        return redirect()->back()->with('success', $message);
    }
}
