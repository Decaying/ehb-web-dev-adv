<?php
if (function_exists('apache_get_modules') &&
    in_array('mod_rewrite', apache_get_modules())) {

    defined("REWRITE_MODULE_ON")
        or define("REWRITE_MODULE_ON", true);

    echo "
<script lang='javascript'>
    REWRITE_MODULE_ON = true;
</script>";
} else {

    defined("REWRITE_MODULE_ON")
        or define("REWRITE_MODULE_ON", false);

    echo "
<script lang='javascript'>
    REWRITE_MODULE_ON = false;
</script>";
}

//this algorithm is the same logic as in js/index.js, keep this aligned.
function rewrite_url($prefix, $url) {
    if (REWRITE_MODULE_ON === true)
        return $prefix . $url;
    else {
        $pattern = '/([^\/]+)/';
        preg_match($pattern, $url, $matches);
        $output = $prefix;

        foreach ($matches as $key => $value) {
            switch ($key) {
                case 1:
                    $output = $output . "/?p=" . $value;
                    break;
                case 2:
                    $output = $output . "&a=" . $value;
                    break;
                case 3:
                    $output = $output . "&id=" . $value;
                    break;
            }
        }

        return $output;
    }
}