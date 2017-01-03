<?php

/*
 * Returns $text processed by htmlspecialchars
 */

function html($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}


/**
 * Prints on the screen $text processed by htmlspecialchars
 * @param mixed $text 
 * @return void
 */
function safePrint($text) {
    echo html($text);
}
