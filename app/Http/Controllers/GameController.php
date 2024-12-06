<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\GameService;
use App\Services\LinkService;

class GameController extends Controller
{
    public function __construct(
        private readonly GameService $gameService,
        private readonly LinkService $linkService,
    ){}

    public function play(User $user)
    {
        $result = $this->gameService->playGame($user);

        $link = $this->linkService->checkLink($user);

        return view('link', [
            'number' => $result['number'],
            'result' => $result['result'],
            'amount' => $result['amount'],
            'link' => $link,
        ]);
    }

    public function history(User $user)
    {
        $link = $this->linkService->checkLink($user);

        $history = $user->games()->latest()->take(3)->get();

        return view('link', [
            'history' => $history,
            'link' => $link,
        ]);
    }

}
