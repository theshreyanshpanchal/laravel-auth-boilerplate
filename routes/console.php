<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('clear:expired-otps')->weekly();
