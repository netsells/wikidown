<?php

function wiki_path($path = '')
{
    return base_path('wiki') . ($path ? '/'.$path : $path);
}