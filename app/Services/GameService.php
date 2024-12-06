<?php

namespace App\Services;

use App\Models\Game;
use App\Models\User;

class GameService
{
    public function playGame(User $user): array
    {
        $randomNumber = $this->generateRandomNumber();
        $isWin = $this->checkWin($randomNumber);
        $winAmount = $this->calculateWinAmount($randomNumber, $isWin);

        $game = $this->recordGame($user, $randomNumber, $isWin, $winAmount);

        return $this->formatResponse($randomNumber, $game->result, $winAmount);
    }

    private function generateRandomNumber(): int
    {
        return rand(1, 1000);
    }

    private function checkWin(int $number): bool
    {
        return $number % 2 === 0;
    }

    private function calculateWinAmount(int $number, bool $isWin): float
    {
        if (!$isWin) {
            return 0;
        }

        return match (true) {
            $number > 900 => $number * 0.7,
            $number > 600 => $number * 0.5,
            $number > 300 => $number * 0.3,
            default => $number * 0.1,
        };
    }

    private function recordGame(User $user, int $number, bool $isWin, float $winAmount): Game
    {
        return Game::create([
            'user_id' => $user->id,
            'random_number' => $number,
            'result' => $isWin ? 'Win' : 'Lose',
            'win_amount' => $winAmount,
        ]);
    }

    private function formatResponse(int $number, string $result, float $winAmount): array
    {
        return [
            'number' => $number,
            'result' => $result,
            'amount' => $winAmount,
        ];
    }
}
