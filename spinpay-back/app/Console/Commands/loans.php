<?php

namespace App\Console\Commands;

use App\Mail\LoanOverdueMail;
use App\Models\Loan;
use App\Models\Users;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class loans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'loan:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $loanss = Loan::all();
        foreach ($loanss as $l) {
            $dateTimestamp1 = strtotime($l->end_date);
            $dateTimestamp2 = strtotime($l->start_date);
            $dateTimestamp3 = strtotime(\Carbon\Carbon::now());
            if ($l->status == 'ongoing' && $dateTimestamp1 < $dateTimestamp3) {
                $latefee = (\Carbon\Carbon::now()->diffInDays($l->end_date) * 10);
                $this->info($latefee);
                $l->late_fee=$latefee;
                $l->status = 'overdue';
                $l->updated_at = \Carbon\Carbon::now();
                $saved = $l->save();
                if ($saved) {
                    $usermail = Users::where('id', $l->borrower_id)->get()->first()->email;
                    $this->info($l->end_date);
                    $date = $l->end_date;
                    $amount = $l->amount + $l->processing_fee + $l->interest;
                    Mail::to($usermail)->send(new LoanOverdueMail('layouts.overduemail', $amount, $date, $l->id));
                }
            } else if ($l->status == 'overdue') {
                $latefee = (\Carbon\Carbon::now()->diffInDays($l->end_date) * 10);
                $l->late_fee=$latefee;
                $l->status = 'overdue';
                $l->updated_at = \Carbon\Carbon::now();
                $saved = $l->save();
            }
        }

    }
}
