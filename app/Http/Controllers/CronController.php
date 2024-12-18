<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Game;
use App\Models\Result;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CronController extends Controller
{
    public function processGames()
    {
        $this->processHourlyGames();
        $this->processEvery2HoursGames();
        $this->processEvery4HoursGames();
        $this->processEvery8HoursGames();
        $this->processEvery12HoursGames();
        $this->processDailyGames();
        $this->processTwiceAWeekGames();
        $this->processWeeklyGames();
        $this->processBiWeeklyGames();
        $this->processMonthlyGames();
        $this->processEvery2MonthsGames();
        $this->processEvery3MonthsGames();
        $this->processEvery6MonthsGames();
        $this->processYearlyGames();

        $this->processWinners();
    }

    public function processHourlyGames()
    {
        $games = Game::where('recurrence', 'hourly')->where('is_active', true)->get();

        foreach ($games as $game) {
            DB::beginTransaction();

            try {
                // Calculate next draw time
                $nextDrawTime = Carbon::parse($game->start_date . ' ' . $game->start_time)
                    ->addHours($game->current_round - 1);

                if ($nextDrawTime->isBefore(Carbon::now()) || $nextDrawTime->equalTo(Carbon::now())) {
                    // Retrieve winning numbers from the game table
                    $winningNumbers = json_decode($game->winning_numbers, true);

                    // Create a result for the current round
                    Result::create([
                        'game_id' => $game->id,
                        'current_round' => $game->current_round,
                        'winning_numbers' => json_encode($winningNumbers),
                    ]);

                    // Generate new winning numbers for the next round
                    $newWinningNumbers = helpers()->generateLuckyNumbers(5);

                    // Update game with new round data
                    $game->update([
                        'current_round' => $game->current_round + 1,
                        'winning_numbers' => json_encode($newWinningNumbers),
                        'last_processed_time' => Carbon::now(),
                    ]);
                }

                DB::commit();  // Commit transaction if all is good

            } catch (\Exception $e) {
                DB::rollBack();  // Rollback if there's an error
                // Optionally, log the error for debugging
                Log::error("Failed to process game ID {$game->id}: " . $e->getMessage());
            }
        }
    }
}
