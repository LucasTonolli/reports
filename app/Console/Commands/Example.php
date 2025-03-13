<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Isolatable;

class Example extends Command implements Isolatable
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'example {--email=} {--secret=}';
    /**
     * {name} → required
     * {name?} → optional
     * {name=foo} → default
     * {name*} → array [Teste teste]
     * {name*?} → optional array
     */
    /**
     * {--email} → flag
     * {--email=*} → array
     * {-e|--email} → optional
     * {-e=} → receber um valor
     */

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A simple example command';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $email = $this->option('email');
        $secret = $this->option('secret');

        // if (!$email) {
        //     $email = $this->ask('What is your email address?');
        // }
        // if (!$secret) {
        //     $secret = $this->secret('What is your password');
        // }

        /**
         * $this->info()
         * $this->comment()
         * $this->question()
         * $this->warn()
         * $this->error()
         * $this->line()
         */

        // $this->info('Email: ' . $email);
        // $this->comment('Secret: ' . $secret);
        // $this->question('Email: ' . $email);
        // $this->warn('Secret: ' . $secret);
        // $this->error('Email: ' . $email);
        // $this->line('Secret: ' . $secret);

        $this->table(
            ['Name', 'Email'],
            User::where('id', '<', 10)->get()->toArray()
        );

        logger("Example command executed  $email / $secret");
        return Command::SUCCESS;
    }
}
