<?php

namespace App\Console\Commands;

use App\Models\JadwalHalangan;
use Carbon\Carbon;
use Illuminate\Console\Command;
use League\Fractal\Resource\Item;

class CheckExpiredData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-expired-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        $expiredItem = JadwalHalangan::where('tanggal', '<=', $now)->where('status', 'ACTIVE')->get();

        foreach($expiredItem as $item){
            $item->status = 'EXPIRED';
            $item->save();
        }
        $this->info('Expired data has been updated.');
    }
}
