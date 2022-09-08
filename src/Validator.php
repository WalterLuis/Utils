<?php

namespace WalterLuis\Utils;

/**
 * Validator.
 *
 * - \p{L} or \p{Letter}: any kind of letter from any language.
 * - \p{M} or \p{Mark}: a character intended to be combined with another character (e.g. accents, umlauts, enclosing boxes, etc.).
 * - \p{Z} or \p{Separator}: any kind of whitespace or invisible separator.
 * - \p{N} or \p{Number}: any kind of numeric character in any script.
 * - \p{P} or \p{Punctuation}: any kind of punctuation character.
 * - \p{C} or \p{Other}: invisible control characters and unused code points.
 *
 * @copyright Copyright © 2022 Walter Luis
 * @license   MIT
 * @author    Walter Luis <walterluisglez@gmail.com>
 *
 * @link https://www.regular-expressions.info/unicode.html
 */
class Validator
{
    private const SPECIAL_CHARACTERS = '|@#~€$¬ºª·%&=^*.:,;<>!¡¿?()[]{}-_';

    /**
     * Function verifies if given value.
     *
     * @param string $input
     *
     * @return bool
     */
    public static function string(string $input, string $extraPattern = ''): bool
    {
        /**
         * \p{Cc} or \p{Control}: an ASCII or Latin-1 control character: 0x00–0x1F and 0x7F–0x9F.
         */
        return \preg_match('/^[\p{L}\p{S}\p{P}\p{Z}\p{N}\p{Cc}' . $extraPattern . ']+$/', $input);
    }

    /**
     * Function verifies if given value is only text.
     *
     * @param string $input
     *
     * @return bool
     */
    public static function text(string $input, string $extraPattern = ''): bool
    {
        return \preg_match('/^[\p{L}' . $extraPattern . ']+$/', $input);
    }

    /**
     * Function verifies if given value is only number including dot and comma.
     *
     * @param string $input
     *
     * @return bool
     */
    public static function numeric(string $input): bool
    {
        return \preg_match('/^[\p{N}.,]+$/', $input);
    }

    /**
     * Function verifies if given value is integer type.
     *
     * @param int|string $input
     *
     * @return bool
     */
    public static function integer($input): bool
    {
        return false !== \filter_var($input, \FILTER_VALIDATE_INT);
    }

    /**
     * Function verifies if given value contains only words or digits.
     *
     * @param int|string $input
     *
     * @return bool
     */
    public static function alnum($input, string $extraPattern = ''): bool
    {
        return \preg_match('/^[\p{L}\p{N}' . $extraPattern . ']+$/', $input);
    }

    /**
     * Function verifies if given value can be recognized as bool.
     *
     * @param bool|int|string $input
     *
     * @return bool
     */
    public static function bool($input): bool
    {
        return null !== \filter_var($input, \FILTER_VALIDATE_BOOLEAN, \FILTER_NULL_ON_FAILURE);
    }

    /**
     *  Function checks if given value is email.
     *
     * @param string $email
     *
     * @return bool
     */
    public static function email(string $email): bool
    {
        return false !== \filter_var($email, \FILTER_VALIDATE_EMAIL) && $email === \filter_var($email, \FILTER_SANITIZE_EMAIL);
    }

    /**
     * Function checks if given value is url.
     *
     * @param string $url
     *
     * @return bool
     */
    public static function url(string $url): bool
    {
        return false !== \filter_var($url, \FILTER_VALIDATE_URL);
    }

    /**
     * Function verifies if given value is compatible with default date and time format.
     *
     * @param string $input
     *
     * @return bool
     */
    public static function dateTime(string $input): bool
    {
        return (false === DateTime::toISO($input, true) ? false : true);
    }

    /**
     * Function verifies if given value is compatible with default data format.
     *
     * @param string $input
     *
     * @return bool
     */
    public static function date(string $input): bool
    {
        return static::dateTime($input);
    }

    /**
     * Function verifies if given value is compatible with default time format.
     *
     * @param string $input
     *
     * @return bool
     */
    public static function time(string $input): bool
    {
        if (Mb::mb_strlen($input) <= 5) {
            return \preg_match('/^(2[0-3]|1[\d]|0[\d]):([0-5][\d])$/', $input);
        }
        return \preg_match('/^(2[0-3]|1[\d]|0[\d]):([0-5][\d]):([0-5][\d])$/', $input);
    }

    /**
     * Function verifies if given value is a valid user.
     *
     * @param string $input
     *
     * @return bool
     */
    public static function userName(string $input, string $extraPattern = ''): bool
    {
        return static::text($input, '@-_.' . $extraPattern);
    }

    /**
     * Function verifies if given value is a valid password.
     *
     * @param string $input
     *
     * @return bool
     */
    public static function password(string $input, string $extraPattern = ''): bool
    {
        return static::string($input, static::SPECIAL_CHARACTERS . $extraPattern);
    }
}
