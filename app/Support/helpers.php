<?php

if (! function_exists('user')) {
    /**
     * [user description]
     * @method user
     * @param  [type]   $driver [description]
     * @return [type]           [description]
     * @auth   simontuo
     */
    function user($driver = null) {
        if ($driver) {
            return app('auth')->guard('api')->user();
        }

        return app('auth')->user();
    }
}
