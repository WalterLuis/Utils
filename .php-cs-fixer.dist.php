<?php

use PhpCsFixer\Config;
use PhpCsFixer\ConfigurationException\InvalidConfigurationException;
use PhpCsFixer\Finder;

require_once __DIR__ . '/vendor/autoload.php';

try {
    $finder = Finder::create()
        ->in(__DIR__);

    $coreConfig = new PhpCsFixer\Runner\Parallel\ParallelConfig(
        4,
        8,
        300
    );

    return (new Config())
        ->setFinder($finder)
        ->setIndent('    ')
        ->setLineEnding("\n")
        ->setParallelConfig($coreConfig)
        ->setRiskyAllowed(false)
        ->setUsingCache(false)
        ->setRules([
            '@PHP82Migration'        => true,
            '@Symfony'               => true,
            'binary_operator_spaces' => [
                'default' => 'single_space',
                // =, *, /, %, <, >, |, ^, +, -, &, &=, &&, ||, .=, /=, =>, ==, >=, ===, !=, <>, !==, <=, and, or, xor, -=, %=, *=, |=, +=, <<, <<=, >>, >>=, ^=, **, **=, <=>, ?? and ??=
                'operators' => [
                    '|'  => 'no_space',
                    '='  => 'align_single_space_minimal',
                    '=>' => 'align_single_space_minimal',
                ],
            ],
            'blank_line_before_statement' => [
                'statements' => [
                    'case',
                    'continue',
                    'declare',
                    'default',
                    'do',
                    'exit',
                    'for',
                    'foreach',
                    'goto',
                    'if',
                    'include_once',
                    'include',
                    'phpdoc',
                    'require_once',
                    'require',
                    'return',
                    'switch',
                    'throw',
                    'try',
                    'while',
                    'yield_from',
                    'yield',
                ],
            ],
            'concat_space' => [
                'spacing' => 'one',
            ],
            'method_argument_space' => [
                'after_heredoc'                    => true,
                'attribute_placement'              => 'same_line',
                'keep_multiple_spaces_after_comma' => false,
                'on_multiline'                     => 'ensure_fully_multiline',
            ],
            'multiline_whitespace_before_semicolons' => [
                'strategy' => 'no_multi_line',
            ],
            'no_extra_blank_lines' => [
                'tokens' => [
                    'attribute',
                    'break',
                    'case',
                    'continue',
                    'curly_brace_block',
                    'default',
                    'extra',
                    'parenthesis_brace_block',
                    'return',
                    'square_brace_block',
                    'switch',
                    'throw',
                    'use_trait',
                    'use',
                ],
            ],
            'no_whitespace_before_comma_in_array' => true,
            'single_line_throw'                   => false,
            'single_quote'                        => true,
            'space_after_semicolon'               => true,
            'ternary_to_null_coalescing'          => true,
            'unary_operator_spaces'               => true,
            'whitespace_after_comma_in_array'     => true,
        ]);
} catch (InvalidConfigurationException $e) {
    throw new InvalidConfigurationException(
        sprintf('Invalid configuration: %s', $e->getMessage()),
        $e->getCode(),
        $e
    );
} catch (UnexpectedValueException $e) {
    throw new UnexpectedValueException(
        sprintf('Invalid configuration: %s', $e->getMessage()),
        $e->getCode(),
        $e
    );
} catch (InvalidArgumentException $e) {
    throw new InvalidArgumentException(
        sprintf('Invalid configuration: %s', $e->getMessage()),
        $e->getCode(),
        $e
    );
}
