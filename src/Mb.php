<?php

namespace WalterLuis\Utils;

/**
 * Class created to not depend on the MultiByte library.
 *
 * @see https://www.php.net/manual/en/ref.mbstring.php
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
     * @return string|false
     *
     * @see https://www.php.net/manual/en/function.mb-chr.php
     * @since 7.2
     */
    public static function mb_chr(int $codepoint, ?string $encoding = null)
    {
        if (true === \function_exists(__FUNCTION__)) {
            if (null === $encoding) {
                $encoding = \mb_internal_encoding();
            }

            return \mb_chr(
                $codepoint,
                $encoding
            );
        }

        return \chr(
            $codepoint
        );
    }

    /**
     * Get code point of character.
     *
     * @return int|false
     *
     * @see https://www.php.net/manual/en/function.mb-ord.php
     * @since 7.2
     */
    public static function mb_ord(
        string $string,
        ?string $encoding = null
    ) {
        if (true === \function_exists(__FUNCTION__)) {
            if (null === $encoding) {
                $encoding = \mb_internal_encoding();
            }

            return \mb_ord(
                $string,
                $encoding
            );
        }

        return \ord(
            $string
        );
    }

    /**
     * Parse GET/POST/COOKIE data and set global variable.
     *
     * @see https://php.net/manual/en/function.mb-parse-str.php
     */
    public static function mb_parse_str(
        string $encoded_string,
        ?array $result
    ): array {
        if (true === \function_exists(__FUNCTION__)) {
            \mb_parse_str(
                $encoded_string,
                $result
            );
        }

        \parse_str(
            $encoded_string,
            $result
        );

        return $result;
    }

    /**
     * Send encoded mail.
     *
     * @see https://php.net/manual/en/function.mb-send-mail.php
     * @since 7.2
     */
    public static function mb_send_mail(
        string $to,
        string $subject,
        string $message,
        ?array $additional_headers = null,
        ?string $additional_parameter = null
    ): bool {
        if (true === \function_exists(__FUNCTION__)) {
            return \mb_send_mail(
                $to,
                $subject,
                $message,
                $additional_headers,
                $additional_parameter
            );
        }

        return \mail(
            $to,
            $subject,
            $message,
            $additional_headers,
            $additional_parameter
        );
    }

    /**
     * Function performs string splitting to an array of defined size chunks.
     *
     * @param int $split_length
     *
     * @return array|false|null
     *
     * @see https://www.php.net/manual/en/function.mb-str-split.php
     * @since 7.4
     */
    public static function mb_str_split(
        string $string,
        $split_length = 1,
        ?string $encoding = null
    ): array {
        if (true === \function_exists(__FUNCTION__)) {
            if (null === $encoding) {
                $encoding = \mb_internal_encoding();
            }

            return \mb_str_split(
                $string,
                $split_length,
                $encoding
            );
        }

        return \str_split(
            $string,
            $split_length
        );
    }

    public static function mb_strcut(
        string $string,
        int $start,
        ?int $length = null,
        ?string $encoding = null
    ) {
        static::mb_substr(
            $string,
            $start,
            $length,
            $encoding
        );
    }

    /**
     * Finds position of first occurrence of a string within another, case insensitive.
     *
     * @return int|false
     *
     * @see https://php.net/manual/en/function.mb-stripos.php
     */
    public static function mb_stripos(
        string $haystack,
        string $needle,
        ?int $offset = null,
        ?string $encoding = null
    ) {
        if (true === \function_exists(__FUNCTION__)) {
            if (null === $encoding) {
                $encoding = \mb_internal_encoding();
            }

            return \mb_stripos(
                $haystack,
                $needle,
                $offset,
                $encoding
            );
        }

        return \stripos(
            $haystack,
            $needle,
            $offset
        );
    }

    /**
     * Finds first occurrence of a string within another.
     *
     * @return string|false
     *
     * @see https://php.net/manual/en/function.mb-strstr.php
     */
    public static function mb_strstr(
        string $haystack,
        string $needle,
        bool $before_needle = false,
        ?string $encoding = null
    ) {
        if (true === \function_exists(__FUNCTION__)) {
            if (null === $encoding) {
                $encoding = \mb_internal_encoding();
            }

            return \mb_strstr(
                $haystack,
                $needle,
                $before_needle,
                $encoding
            );
        }

        return \strstr(
            $haystack,
            $needle,
            $before_needle
        );
    }

    /**
     * Finds first occurrence of a string within another, case insensitive.
     *
     * @return string|false
     *
     * @see https://php.net/manual/en/function.mb-stristr.php
     */
    public static function mb_stristr(
        string $haystack,
        string $needle,
        bool $before_needle = false,
        ?string $encoding = null
    ) {
        if (true === \function_exists(__FUNCTION__)) {
            if (null === $encoding) {
                $encoding = \mb_internal_encoding();
            }

            return \mb_stristr(
                $haystack,
                $needle,
                $before_needle,
                $encoding
            );
        }

        return \stristr(
            $haystack,
            $needle,
            $before_needle
        );
    }

    /**
     * Make a string lowercase.
     *
     * @return string
     *
     * @see https://php.net/manual/en/function.mb-strtolower.php
     */
    public static function mb_strtolower(
        string $string,
        ?string $encoding = null
    ) {
        if (true === \function_exists(__FUNCTION__)) {
            if (null === $encoding) {
                $encoding = \mb_internal_encoding();
            }

            return \mb_strtolower(
                $string,
                $encoding
            );
        }

        return \strtolower(
            $string
        );
    }

    /**
     * Make a string uppercase.
     */
    public static function mb_strtoupper(
        string $string,
        ?string $encoding = null
    ): string {
        if (true === \function_exists(__FUNCTION__)) {
            if (null === $encoding) {
                $encoding = \mb_internal_encoding();
            }

            return \mb_strtoupper(
                $string,
                $encoding
            );
        }

        return \strtoupper(
            $string
        );
    }

    /**
     * Count the number of substring occurrences.
     *
     * @see https://php.net/manual/en/function.mb-substr-count.php
     */
    public static function mb_substr_count(
        string $haystack,
        string $needle,
        ?int $offset = null,
        ?int $length = null,
        ?string $encoding = null
    ): int {
        if (true === \function_exists(__FUNCTION__)) {
            if (null === $encoding) {
                $encoding = \mb_internal_encoding();
            }

            return \mb_substr_count(
                $haystack,
                $needle,
                $encoding
            );
        }

        return \substr_count(
            $haystack,
            $needle,
            $offset,
            $length
        );
    }

    /**
     * Get part of string.
     *
     * @return string|false
     *
     * @see https://php.net/manual/en/function.mb-substr.php
     */
    public static function mb_substr(
        string $string,
        int $start,
        ?int $length = null,
        ?string $encoding = null
    ) {
        if (true === \function_exists(__FUNCTION__)) {
            if (null === $encoding) {
                $encoding = \mb_internal_encoding();
            }

            return \mb_substr(
                $string,
                $start,
                $length,
                $encoding
            );
        }

        return \substr(
            $string,
            $start,
            $length
        );
    }

    /**
     * Find position of first occurrence of string in a string.
     *
     * @return int|false
     *
     * @see https://php.net/manual/en/function.mb-strpos.php
     */
    public static function mb_strpos(
        string $haystack,
        string $needle,
        int $offset = 0,
        ?string $encoding = null
    ) {
        if (true === \function_exists(__FUNCTION__)) {
            if (null === $encoding) {
                $encoding = \mb_internal_encoding();
            }

            return \mb_strpos(
                $haystack,
                $needle,
                $offset,
                $encoding
            );
        }

        return \strpos(
            $haystack,
            $needle,
            $offset
        );
    }

    /**
     * Get string length.
     *
     * @return int|false
     *
     * @see https://php.net/manual/en/function.mb-strlen.php
     */
    public static function mb_strlen(
        string $string,
        ?string $encoding = null
    ) {
        if (true === \function_exists(__FUNCTION__)) {
            if (null === $encoding) {
                $encoding = \mb_internal_encoding();
            }

            return \mb_strlen(
                $string,
                $encoding
            );
        }

        return \strlen(
            $string
        );
    }
}
