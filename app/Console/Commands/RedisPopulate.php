<?php

namespace App\Console\Commands;

use App\Services\RedisDataProviderService;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class RedisPopulate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:redis:populate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate Redis with data from MySQL database';

    public function __construct(readonly private RedisDataProviderService $dataProviderService)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try {
            $casinoData = $this->dataProviderService->getCasinoData();
            $gameData = $this->dataProviderService->getGameData();

            Redis::set('casinos', $casinoData);
            Redis::set('games', $gameData);

            $this->info('Redis populated successfully.');
        } catch (Exception $e) {
            $this->error('Failed to populate Redis: ' . $e->getMessage());
        }
    }
}
