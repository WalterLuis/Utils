<?php

namespace WalterLuis\Utils;

/**
 * Json enhanced features.
 *
 * @copyright Copyright © 2022 Walter Luis
 * @license   MIT
 * @author    Walter Luis <walterluisglez@gmail.com>
 */
class Json
{
    public const TYPE_ARRAY = 1;
    public const TYPE_OBJECT = 0;

    /**
     * Determine whether a variable is a JSON or not.
     */
    public static function isJson(mixed $json): bool
    {
        return \is_string($json)
            && (
                ('[' === \substr($json, 0, 1) && ']' === \substr($json, -1, 1))
                || ('{' === \substr($json, 0, 1) && '}' === \substr($json, -1, 1))
            );
    }

    /**
     * Determine whether a variable is empty.
     */
    public static function isEmpty(?string $json): bool
    {
        return empty($json) || '[]' === $json || '{}' === $json || '""' === $json;
    }

    /**
     * Determine whether a variable is a converted JSON HTML.
     */
    public static function isConvertedJsonHtml(?string $json): bool
    {
        return \is_string($json)
            && (
                ('[&quot;' === \substr($json, 0, 1) && '&quot;]' === \substr($json, -1, 1))
                || ('{&quot;' === \substr($json, 0, 1) && '&quot;}' === \substr($json, -1, 1))
                || ('[{&quot;' === \substr($json, 0, 2) && '&quot;}]' === \substr($json, -1, 2))
            );
    }

    /**
     * Delete comments in the JSON.
     */
    public static function deleteComments(string $json): string
    {
        $json = \preg_replace(
            [
                // delete inline comments
                '/\/\/[\s]{0,*}("\w|"\w,|{|}|:)(.*)/',
                // remove multi-line comments with opening /* and closing */
                '/\/\*[\s]{0,*}[",{}:][\s\S]*?[\s]{0,*}[",{}:]\*\//',
            ],
            '',
            $json
        );

        return $json;
    }

    /**
     * Decodes the given $encodedValue string which is encoded in the JSON format.
     *
     * @param string $encodedValue     Encoded in JSON format
     * @param int    $objectDecodeType Optional; When TRUE, returned objects will be converted into associative arrays
     *
     * @see https://secure.php.net/manual/en/function.json-decode.php
     *
     * @return array|object
     *
     * @throws \Throwable
     */
    public static function decode(string $encodedValue, $objectDecodeType = self::TYPE_ARRAY, $depth = 768, $options = \JSON_THROW_ON_ERROR)
    {
        if (false === \function_exists('json_decode')) {
            throw new \Throwable('ERR_JSON_DECODE_LIBRARY_IS_NOT_INSTALLED');
        }

        if (self::isConvertedJsonHtml($encodedValue)) {
            $encodedValue = \html_entity_decode($encodedValue, \ENT_QUOTES|\ENT_SUBSTITUTE, 'UTF-8');
        }

        if (false === self::isJson($encodedValue) || true === self::isEmpty($encodedValue)) {
            $encodedValue = '{}';
        }

        try {
            return \json_decode($encodedValue, $objectDecodeType, $depth, $options);
        } catch (\Throwable $th) {
            throw new \Throwable("JSON_DECODE_MESSAGE: {$th->getMessage()}, JSON: '{$encodedValue}'", 500);
        }
    }

    /**
     * Encode the mixed $valueToEncode into the JSON format.
     *
     * @param array|object $valueToEncode
     * @param int          $options       Optional; Bitmask consisting of JSON_HEX_QUOT, JSON_HEX_TAG, JSON_HEX_AMP, JSON_HEX_APOS, JSON_NUMERIC_CHECK, JSON_PRETTY_PRINT, JSON_UNESCAPED_SLASHES, JSON_FORCE_OBJECT, JSON_UNESCAPED_UNICODE. JSON_THROW_ON_ERROR The behaviour of these constants is described on the JSON constants page.
     *
     * @return string|false JSON encoded object
     *
     * @throws \Throwable
     */
    public static function encode($valueToEncode, $options = \JSON_THROW_ON_ERROR, $depth = 768): string
    {
        if (false === \function_exists('json_encode')) {
            throw new \Throwable('ERR_JSON_ENCODE_LIBRARY_IS_NOT_INSTALLED');
        }

        try {
            return \json_encode($valueToEncode, $options, $depth);
        } catch (\Throwable $th) {
            throw new \Throwable("JSON_ENCODE_MESSAGE: '{$th->getMessage()}'.", 500);
        }
    }
}
