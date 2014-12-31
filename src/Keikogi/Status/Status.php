<?php

namespace Keikogi\Status;

class Status
{
    const EXEC = "ps -ef | awk '$8==\"/usr/sbin/mysqld\" || $3==1 { print $8 }'";

    public static function get()
    {
        exec(self::EXEC, $res);

        foreach ($res as $resIndex => $resString) {
            $resString = str_replace(':', '', $resString);
            preg_match('/[a-zA-Z0-9\-\.\_]+$/i', $resString, $matches);
            $res[$resIndex] = $matches[0];
        }

        sort($res);
        $res = array_values(array_unique($res));
        $res = implode(',', $res);

        return trim(exec('uptime')).'::'.phpversion().'::'.$_SERVER["SERVER_SOFTWARE"].'::NaN::'.$res;
    }
}
