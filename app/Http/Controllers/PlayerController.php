<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Models\Player;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PlayerController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('pages.players.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePlayerRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StorePlayerRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        $file = $request->file('photo');

        $validatedData['photo'] = $file->storePubliclyAs('players', $file->hashName(), 'public');

        Player::create($validatedData);

        toast('Le joueur a bien été créer !', 'success');

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Player $player
     *
     * @return View
     */
    public function edit(Player $player): View
    {
        return view('pages.players.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePlayerRequest $request
     * @param Player              $player
     *
     * @return RedirectResponse
     */
    public function update(UpdatePlayerRequest $request, Player $player): RedirectResponse
    {
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Player $player
     *
     * @return RedirectResponse
     */
    public function destroy(Player $player): RedirectResponse
    {
        return redirect()->back();
    }
}
