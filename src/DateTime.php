<?php

namespace WalterLuis\Utils;

/**
 * DateTime enhanced features.
 *
 * @copyright Copyright © 2022 Walter Luis
 * @license   MIT
 * @author    Walter Luis <walterluisglez@gmail.com>
 */
class DateTime
{
    /** @var string Date */
    public const D_ISO8601 = 'Y-m-d';
    /** @var string DateTime */
    public const DT_ISO8601 = 'Y-m-d H:i:s';

    /** @var string Format to days */
    public const FORMAT_TO_DAYS = '%a';
    /** @var string Format to months */
    public const FORMAT_TO_MONTHS = '%m';
    /** @var string Format to years */
    public const FORMAT_TO_YEARS = '%y';

    /**
     * Returns the difference between two date ISO8601 format.
     *
     * @param string $date_start YYYY-MM-DD
     * @param string $date_end   YYYY-MM-DD
     * @param string $format
     */
    public static function diff(
        string $date_start,
        string $date_end,
        string $format = self::FORMAT_TO_DAYS
    ): int {
        return (int) (new \DateTime($date_start))
            ->diff(new \DateTime($date_end))
            ->format($format);
    }

    /**
     * Convert Date or DateTime to ISO8601.
     *
     * @param string $dateTime Date or DateTime format
     *
     * @return string|array|false "$y-$m-$d $time" | [$y, $m, $d, $time]
     */
    public static function toISO(
        string $dateTime,
        bool $arrayReturn = false,
        string $timeZone = '+00:00'
    ) {
        $y = $m = $d = $time = '';
        $date = $dateTime;

        if (false !== Mb::mb_strpos($dateTime, ' ')) {
            [$date, $time] = \explode(' ', $dateTime, 2);
        }

        foreach (['-' => '-', '/' => '\/', '.' => '.'] as $separator => $regExp) {
            if (false !== Mb::mb_strpos($date, $separator)) {
                if (\preg_match(
                    '/^[\d]{4}' . $regExp . '(0[1-9]|1[0-2])' . $regExp . '(0[1-9]|[1-2][\d]|3[0-1])$/',
                    $date
                )) {
                    [$y, $m, $d] = \explode($separator, $date, 3);
                } elseif (\preg_match(
                    '/^(0[1-9]|[1-2][\d]|3[0-1])' . $regExp . '(0[1-9]|1[0-2])' . $regExp . '[\d]{4}$/',
                    $date
                )) {
                    [$d, $m, $y] = \explode($separator, $date, 3);
                } elseif (\preg_match(
                    '/^(0[1-9]|1[0-2])' . $regExp . '(0[1-9]|[1-2][\d]|3[0-1])' . $regExp . '[\d]{4}$/',
                    $date
                )) {
                    [$m, $d, $y] = \explode($separator, $date, 3);
                }
            }
        }

        if (
            (
                false === \is_numeric($y)
                || false === \is_numeric($m)
                || false === \is_numeric($d)
                || false === \checkdate($m, $d, $y)
            )
            || ($time && false === Validator::time($time))
        ) {
            return false;
        }

        if (true === $arrayReturn) {
            return [$y, $m, $d, $time];
        }

        return \trim("{$y}-{$m}-{$d}T{$time}{$timeZone}", ' :-');
    }
}
