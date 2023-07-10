<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PersonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Person::query()->when($request->get('search'), function ($query, $search) {
            return $query->where('name', 'ILIKE', "%$search%");
        })->when($request->get('sort'), function ($query, $sortBy) {
            return $query->orderBy($sortBy['key'], $sortBy['order']);
        });

        $data = $query->paginate($request->get('limit', 10));

        return Inertia::render('Person/Index', [
            'data' => $data
        ]);
    }

    public function create()
    {
        return Inertia::render('Person/Create');
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

        Person::create($request->all());

        return redirect()->back()->with('success', 'Person created');
    }

    public function edit(Person $person)
    {
        return Inertia::render('Person/Edit', [
            'person' => $person
        ]);
    }

    public function update(Person $person, Request $request)
    {
        $data = $this->validate($request, [
            'name' => ['required'],
            'gender' => ['required'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable'],
            'address' => ['nullable'],
        ]);
        $person->update($data);

        return redirect()->back()->with('success', 'Person updated');
    }

    public function destroy(Person $person)
    {
        $person->delete();

        return redirect()->back()->with('success', 'Person deleted');
    }
}
