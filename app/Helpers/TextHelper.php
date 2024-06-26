<?php

function truncate_text($text, $length = 128): string
{
    return mb_substr($text, 0, $length);
}
