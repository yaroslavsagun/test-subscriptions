<?php

use App\Console\Commands\ProcessPaymentsCommand;
use Illuminate\Support\Facades\Schedule;

Schedule::command(ProcessPaymentsCommand::class)->daily();
