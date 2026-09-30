<?php

function valid_price($str) {
    return (bool) preg_match('/^\d{1,10}(\.\d{1,2})?$/', $str);
}