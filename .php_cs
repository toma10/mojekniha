<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude('vendor')
    ->exclude('storage')
    ->exclude('bootstrap/cache')
    ->exclude('nova')
    ->in(__DIR__)
;

return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2' => true,
        'array_syntax' => ['syntax' => 'short'],
        'array_indentation' => true,
        'blank_line_after_namespace' => true,
        'blank_line_after_opening_tag' => true,
        'blank_line_before_statement' => [
            'statements' => [
                'break',
                'continue',
                'declare',
                'return',
                'throw',
                'try',
            ],
        ],
        'cast_spaces' => ['space' => 'single'],
        'class_attributes_separation' => [
            'elements' => [
                'const',
                'method',
                'property',
            ],
        ],
        'class_definition' => ['single_line' => true],
        'combine_consecutive_issets' => true,
        'combine_consecutive_unsets' => true,
        'compact_nullable_typehint' => true,
        'concat_space' => ['spacing' => 'none'],
        'declare_equal_normalize' => ['space' => 'none'],
        'fully_qualified_strict_types' => true,
        'function_typehint_space' => true,
        'include' => true,
        'list_syntax' => ['syntax' => 'short'],
        'lowercase_constants' => true,
        'lowercase_static_reference' => true,
        'magic_constant_casing' => true,
        'magic_method_casing' => true,
        'multiline_comment_opening_closing' => true,
        'new_with_braces' => true,
        'no_blank_lines_after_class_opening' => true,
        'no_blank_lines_after_phpdoc' => true,
        'no_empty_comment' => true,
        'no_empty_phpdoc' => true,
        'no_empty_statement' => true,
        'no_leading_import_slash' => true,
        'no_leading_namespace_whitespace' => true,
        'no_mixed_echo_print' => ['use' => 'echo'],
        'no_multiline_whitespace_around_double_arrow' => true,
        'no_null_property_initialization' => true,
        'no_singleline_whitespace_before_semicolons' => true,
        'no_spaces_around_offset' => true,
        'no_trailing_comma_in_list_call' => true,
        'no_trailing_comma_in_singleline_array' => true,
        'no_unused_imports' => true,
        'normalize_index_brace' => true,
        'not_operator_with_successor_space' => true,
        'ordered_imports' => ['sortAlgorithm' => 'alpha'],
        'phpdoc_order' => true,
        'phpdoc_separation' => true,
        'phpdoc_var_without_name' => true,
        'semicolon_after_instruction' => true,
        'single_quote' => true,
        'standardize_increment' => true,
        'standardize_not_equals' => true,
        'ternary_to_null_coalescing' => true,
        'trailing_comma_in_multiline_array' => true,
        'trim_array_spaces' => true,
        'unary_operator_spaces' => true,
    ])
    ->setFinder($finder);
