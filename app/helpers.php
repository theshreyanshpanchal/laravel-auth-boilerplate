<?php

if (! function_exists('generateOtp')) {

    function generateOtp() {

        return random_int(100000, 999999);

    }

}
