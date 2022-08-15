<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Services\MockupService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class MockupController extends Controller
{
    /**
     * @var MockupService
     */
    private MockupService $service;

    /**
     * @param MockupService $service
     */
    public function __construct(MockupService $service)
    {
        $this->service = $service;
    }

    /**
     * @return View
     */
    public function make(): View
    {
        $players = Player::all();

        $grid = [
            [1, 2, 3],
            [4, 5],
            [6, 8, 7],
            [9, 10],
            [12, 13],
            [11, 15, 14],
        ];

        return view('pages.make', compact('players', 'grid'));
    }

    /**
     * @return RedirectResponse
     */
    public function generate(): RedirectResponse
    {
        $this->service->makeAllFiles();

        toast('Le kit a bien été créer !', 'success');

        return redirect()->back();
    }
}
