<?php

/**
 * get array value and format
 *
 * @param $value
 * @param string $key
 * @return mixed
 */
function value_format($value, string $key)
{
    if (ends_with($key, ['_memory', '_consumption'])) {
        return size_format($value);
    }

    if (ends_with($key, ['_time'])) {
        return time_format($value);
    }

    return is_bool($value) ? bool_to_string($value) : $value;
}

/**
 * bool to string
 *
 * @param bool $value
 * @return string
 */
function bool_to_string(bool $value)
{
    return $value ? 'true' : 'false';
}

/**
 * time format
 *
 * @param int $time
 * @return false|string
 */
function time_format(int $time)
{
    return $time == 0 ? 'never' : date('Y-m-d H:i:s', $time);
}

/**
 * size format
 *
 * @param int $bytes
 * @return string
 */
function size_format(int $bytes)
{
    if ($bytes > 1048576) {
        return sprintf('%.2f MB', $bytes / 1048576);
    }

    if ($bytes > 1024) {
        return sprintf('%.2f kB', $bytes / 1024);
    }

    return sprintf('%d bytes', $bytes);
}
