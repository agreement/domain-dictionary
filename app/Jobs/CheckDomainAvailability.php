<?php

namespace App\Jobs;

use App\Domain;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Privateer\Domainr\Domainr;

class CheckDomainAvailability implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var Domain
     */
    private $domain;

    /**
     * Create a new job instance.
     *
     * @param Domain $domain
     */
    public function __construct(Domain $domain)
    {
        $this->domain = $domain;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        echo "Checking {$this->domain->domain}... ";

        $status = (new Domainr(config('services.domainr.mashape_key')))->status($this->domain->domain);

        $this->domain->available = $status->get('available');
        $this->domain->status = $status->get('summary');
        $this->domain->last_checked_at = new Carbon;

        $this->domain->save();

        echo "{$status->get('summary')}\n";

        return;
    }
}
