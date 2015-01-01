<?php

namespace Keikogi\Status;

class Status
{
    const EXEC = "ps -ef | awk '$8==\"/usr/sbin/mysqld\" || $3==1 { print $8 }'";

    public static function get()
    {
        exec(self::EXEC, $res);

        foreach ($res as $resIndex => $resString) {
            preg_match(
                '/[a-zA-Z0-9\-\.\_]+$/i',
                str_replace(':', '', $resString),
                $matches
            );
            $res[$resIndex] = $matches[0];
        }

        sort($res);
        $res = array_values(array_unique($res));
        $res = implode(',', $res);

        $serverSoftware = 'Not detected';

        if (isset($_SERVER["SERVER_SOFTWARE"])) {
            $serverSoftware = $_SERVER["SERVER_SOFTWARE"];
        }

        return trim(exec('uptime')).'::'.phpversion().'::'.$serverSoftware.'::NaN::'.$res;
    }
}
