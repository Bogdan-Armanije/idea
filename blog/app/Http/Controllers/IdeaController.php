<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Http\Requests\StoreIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $ideas_ = Auth::user()
            ->ideas()
            ->when($request->status, fn($query, $status) => $query->where('status', $status))
            ->get();

        $realCount = Idea::statusCount(Auth::user());

        return view('idea.index', ['ideas_' => $ideas_, 'realCount' => $realCount]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIdeaRequest $request): void
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Idea $idea): View
    {
        return view('idea.show',compact('idea'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Idea $idea): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIdeaRequest $request, Idea $idea): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idea $idea)
    {
        $idea->delete();
        return redirect('/ideas')->with('success', 'Idea deleted!');
    }
}
