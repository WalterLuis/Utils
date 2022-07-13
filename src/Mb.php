<?php

namespace Src;

/**
 * Class created to not depend on the MultiByte library.
 *
 * @link https://www.php.net/manual/en/ref.mbstring.php
 *
 * @copyright Copyright © 2022 Walter Luis
 * @license   MIT
 * @author    Walter Luis <walterluisglez@gmail.com>
 */
class Mb
{
    /**
     * Get a specific character.
     *
     * @param int         $codepoint
     * @param string|null $encoding
     *
     * @return string|false
     *
     * @link https://www.php.net/manual/en/function.mb-chr.php
     * @since 7.2
     */
    public static function mb_chr(int $codepoint, ?string $encoding = null)
    {
        if (true === \function_exists(__FUNCTION__)) {
            if (null === $encoding) {
                $encoding = \mb_internal_encoding();
            }

            return \mb_chr($codepoint, $encoding);
        }

        return \chr($codepoint);
    }

    /**
     * Get code point of character.
     *
     * @param string      $string
     * @param string|null $encoding
     *
     * @return int|false
     *
     * @link https://www.php.net/manual/en/function.mb-ord.php
     * @since 7.2
     */
    public static function mb_ord(string $string, ?string $encoding = null)
    {
        if (true === \function_exists(__FUNCTION__)) {
            if (null === $encoding) {
                $encoding = \mb_internal_encoding();
            }

            return \mb_ord($string, $encoding);
        }

        return \ord($string);
    }

    /**
     * Parse GET/POST/COOKIE data and set global variable.
     *
     * @param string     $encoded_string
     * @param array|null $result
     *
     * @return array
     *
     * @link https://php.net/manual/en/function.mb-parse-str.php
     */
    public static function mb_parse_str(string $encoded_string, ?array $result): array
    {
        if (true === \function_exists(__FUNCTION__)) {
            \mb_parse_str($encoded_string, $result);
        }

        \parse_str($encoded_string, $result);

        return $result;
    }

    /**
     * Send encoded mail.
     *
     * @param string      $to
     * @param string      $subject
     * @param string      $message
     * @param array|null  $additional_headers
     * @param string|null $additional_parameter
     *
     * @return bool
     *
     * @link https://php.net/manual/en/function.mb-send-mail.php
     * @since 7.2
     */
    public static function mb_send_mail(string $to, string $subject, string $message, ?array $additional_headers = null, ?string $additional_parameter = null): bool
    {
        if (true === \function_exists(__FUNCTION__)) {
            return \mb_send_mail($to, $subject, $message, $additional_headers, $additional_parameter);
        }

        return \mail($to, $subject, $message, $additional_headers, $additional_parameter);
    }

    /**
     * Function performs string splitting to an array of defined size chunks.
     *
     * @param string      $string
     * @param int         $split_length
     * @param string|null $encoding
     *
     * @return array|null|false
     *
     * @link https://www.php.net/manual/en/function.mb-str-split.php
     * @since 7.4
     */
    public static function mb_str_split(string $string, $split_length = 1, ?string $encoding = null): array
    {
        if (true === \function_exists(__FUNCTION__)) {
            if (null === $encoding) {
                $encoding = \mb_internal_encoding();
            }

            return \mb_str_split($string, $split_length, $encoding);
        }

        return \str_split($string, $split_length);
    }

    public static function mb_strcut(string $string, int $start, ?int $length = null, ?string $encoding = null)
    {
        static::mb_substr($string, $start, $length, $encoding);
    }

    /**
     * Finds position of first occurrence of a string within another, case insensitive.
     *
     * @param string      $haystack
     * @param string      $needle
     * @param int|null    $offset
     * @param string|null $encoding
     *
     * @return int|false
     *
     * @link https://php.net/manual/en/function.mb-stripos.php
     */
    public static function mb_stripos(string $haystack, string $needle, ?int $offset = null, ?string $encoding = null)
    {
        if (true === \function_exists(__FUNCTION__)) {
            if (null === $encoding) {
                $encoding = \mb_internal_encoding();
            }

            return \mb_stripos($haystack, $needle, $offset, $encoding);
        }

        return \stripos($haystack, $needle, $offset);
    }

    /**
     * Finds first occurrence of a string within another.
     *
     * @param string      $haystack
     * @param string      $needle
     * @param bool        $before_needle
     * @param string|null $encoding
     *
     * @return string|false
     *
     * @link https://php.net/manual/en/function.mb-strstr.php
     */
    public static function mb_strstr(string $haystack, string $needle, bool $before_needle = false, ?string $encoding = null)
    {
        if (true === \function_exists(__FUNCTION__)) {
            if (null === $encoding) {
                $encoding = \mb_internal_encoding();
            }

            return \mb_strstr($haystack, $needle, $before_needle, $encoding);
        }

        return \strstr($haystack, $needle, $before_needle);
    }

    /**
     * Finds first occurrence of a string within another, case insensitive.
     *
     * @param string      $haystack
     * @param string      $needle
     * @param bool        $before_needle
     * @param string|null $encoding
     *
     * @return string|false
     *
     * @link https://php.net/manual/en/function.mb-stristr.php
     */
    public static function mb_stristr(string $haystack, string $needle, bool $before_needle = false, ?string $encoding = null)
    {
        if (true === \function_exists(__FUNCTION__)) {
            if (null === $encoding) {
                $encoding = \mb_internal_encoding();
            }

            return \mb_stristr($haystack, $needle, $before_needle, $encoding);
        }

        return \stristr($haystack, $needle, $before_needle);
    }

    /**
     * Make a string lowercase.
     *
     * @param string      $string
     * @param string|null $encoding
     *
     * @return string
     *
     * @link https://php.net/manual/en/function.mb-strtolower.php
     */
    public static function mb_strtolower(string $string, ?string $encoding = null)
    {
        if (true === \function_exists(__FUNCTION__)) {
            if (null === $encoding) {
                $encoding = \mb_internal_encoding();
            }

            return \mb_strtolower($string, $encoding);
        }

        return \strtolower($string);
    }

    /**
     * Make a string uppercase.
     *
     * @param string      $string
     * @param string|null $encoding
     *
     * @return string
     */
    public static function mb_strtoupper(string $string, ?string $encoding = null): string
    {
        if (true === \function_exists(__FUNCTION__)) {
            if (null === $encoding) {
                $encoding = \mb_internal_encoding();
            }

            return \mb_strtoupper($string, $encoding);
        }

        return \strtoupper($string);
    }

    /**
     * Count the number of substring occurrences.
     *
     * @param string      $haystack
     * @param mixed       $needle
     * @param int|null    $offset
     * @param int|null    $length
     * @param string|null $encoding
     *
     * @return int
     *
     * @link https://php.net/manual/en/function.mb-substr-count.php
     */
    public static function mb_substr_count(string $haystack, mixed $needle, ?int $offset = null, ?int $length = null, ?string $encoding = null): int
    {
        if (true === \function_exists(__FUNCTION__)) {
            if (null === $encoding) {
                $encoding = \mb_internal_encoding();
            }

            return \mb_substr_count($haystack, $needle, $encoding);
        }

        return \substr_count($haystack, $needle, $offset, $length);
    }

    /**
     * Get part of string.
     *
     * @param string      $string
     * @param int         $start
     * @param int|null    $length
     * @param string|null $encoding
     *
     * @return string|false
     *
     * @link https://php.net/manual/en/function.mb-substr.php
     */
    public static function mb_substr(string $string, int $start, ?int $length = null, ?string $encoding = null)
    {
        if (true === \function_exists(__FUNCTION__)) {
            if (null === $encoding) {
                $encoding = \mb_internal_encoding();
            }

            return \mb_substr($string, $start, $length, $encoding);
        }

        return \substr($string, $start, $length);
    }

    /**
     * Find position of first occurrence of string in a string.
     *
     * @param string      $haystack
     * @param string      $needle
     * @param int|null    $offset
     * @param string|null $encoding
     *
     * @return int|false
     *
     * @link https://php.net/manual/en/function.mb-strpos.php
     */
    public static function mb_strpos(string $haystack, string $needle, ?int $offset = null, ?string $encoding = null)
    {
        if (true === \function_exists(__FUNCTION__)) {
            if (null === $encoding) {
                $encoding = \mb_internal_encoding();
            }

            return \mb_strpos($haystack, $needle, $offset, $encoding);
        }

        return \strpos($haystack, $needle, $offset);
    }

    /**
     * Get string length.
     *
     * @param string      $string
     * @param string|null $encoding
     *
     * @return int|false
     *
     * @link https://php.net/manual/en/function.mb-strlen.php
     */
    public static function mb_strlen(string $string, ?string $encoding = null)
    {
        if (true === \function_exists(__FUNCTION__)) {
            if (null === $encoding) {
                $encoding = \mb_internal_encoding();
            }

            return \mb_strlen($string, $encoding);
        }

        return \strlen($string);
    }
}
