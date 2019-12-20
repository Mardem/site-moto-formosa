<?php

if(!function_exists('currentActiveMenu')) {

    function currentActiveMenu($url) {
        if(request()->is($url)) {
            return 'active';
        }
        return '';
    }
}
