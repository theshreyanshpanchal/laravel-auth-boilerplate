<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ClearExpiredOtps extends Command
{
    protected $signature = 'clear:expired-otps';

    protected $description = 'Command to clear te expired OTPs.';

    public function handle(): void
    {
        $yesterday = Carbon::now()->subDay();

        DB::table('otps')->where('created_at', '<', $yesterday)->delete();

        $this->newLine();

        $this->comment("Expired OTPs removed successfully.");

        $this->newLine();
    }
}
