<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use RuntimeException;

class RedisDataProviderService
{
    /**
     * @return mixed
     */
    public function getCasinoData(): mixed
    {
        $casinos = DB::table('casinos')->orderBy('market')->orderByDesc('rank')->get();

        if ($casinos->isEmpty()) {
            throw new RuntimeException('No casino data found.');
        }

        return $casinos->map(function ($casino) {
            $uniqueKey = $this->generateUniqueKey();

            return [$uniqueKey => $casino];
        })->toJson();
    }

    /**
     * Generate a unique key.
     *
     * @return string
     */
    private function generateUniqueKey(): string
    {
        return Uuid::uuid4()->toString();
    }

    /**
     * @return mixed
     */
    public function getGameData(): mixed
    {
        $games = DB::table('games')->orderBy('market')->orderByDesc('numberOfPlays')->get();

        if ($games->isEmpty()) {
            throw new RuntimeException('No game data found.');
        }

        return $games->map(function ($game) {
            $uniqueKey = $this->generateUniqueKey();

            return [$uniqueKey => $game];
        })->toJson();
    }
}
