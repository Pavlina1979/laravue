<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // public function index()
    // {
    //   $ukoly = Task::latest()->paginate(3);

    //   return view('ukol.index', [
    //     'ukoly' => $ukoly
    //   ]);
    // }

    public function index()
    {
        $authUser = Auth::id();
        //$ukoly = Task::latest()->paginate(3);
        $ukoly = Task::query()->where('user_id', '=', $authUser)
            ->latest()->get(['id', 'nazev', 'popis', 'dokdy', 'dokonceno']);

        return Inertia::render('ukol/Index', [
            'ukoly' => $ukoly
        ]);
    }

    public function edit(int $id)
    {
        $ukol = Task::findOrFail($id);

        return Inertia::render('ukol/Edit', [
            'ukol' => $ukol
        ]);
    }

    public function create()
    {

        //return view('ukol.create');
        return Inertia::render('ukol/Create');
    }

    public function store(Request $request)
    {
        $ukol = new Task();
        $user = Auth::id();

        $data = $this->validate($request);
        $ukol->nazev = $data['nazev'];
        $ukol->popis = $data['popis'];
        $ukol->dokdy = $data['dokdy'];
        $ukol->user_id = $user;
        // $ukol->dokonceno = (isset($data['dokonceno']) && $data['dokonceno'] === 'on') ? 1 : 0;
        $ukol->dokonceno = (isset($data['dokonceno']) && $data['dokonceno'] === '1') ? 1 : 0;
        $ukol->save();

        return redirect()->route('tasks.index')->with('success', "Úkol '{$ukol->nazev}' byl úspěšně vytvořen");
    }

    public function update(int $id, Request $request)
    {
        $ukol = Task::find($id);

        $data = $this->validate($request);
        $ukol->nazev = $data['nazev'];
        $ukol->popis = $data['popis'];
        $ukol->dokdy = $data['dokdy'];
        // $ukol->dokonceno = isset($data['dokonceno']) ? 1 : 0;
        $ukol->dokonceno = (isset($data['dokonceno']) && $data['dokonceno'] === '1') ? 1 : 0;
        $ukol->save();

        return redirect()->route('tasks.index')->with('success', "Úkol '{$ukol->nazev}' byl úspěšně upraven");
    }

    public function destroy(int $id)
    {
        $ukol = Task::findOrFail($id);
        $jmenoUkolu = $ukol->nazev;
        $ukol->delete();
        return redirect()->route('tasks.index')->with('success', "Úkol '{$jmenoUkolu}' byl úspěšně smazán");
    }

    public function filtrHotove()
    {
        $authUser = Auth::id();
        $ukoly = Task::query()->where('user_id', '=', $authUser)->where('dokonceno', true)->get();

        return Inertia::render('ukol/Index', [
            'ukoly' => $ukoly
        ]);
    }

    public function filtrNehotove()
    {
        $authUser = Auth::id();
        $ukoly = Task::query()->where('user_id', '=', $authUser)->where('dokonceno', false)->get();

        return Inertia::render('ukol/Index', [
            'ukoly' => $ukoly
        ]);
    }

    private function validate(Request $request)
    {
        return $request->validate([
            'nazev' => 'required|max:255',
            'popis' => 'required',
            'dokdy' => 'required',
            'dokonceno' => 'nullable'
        ]);
    }
}
