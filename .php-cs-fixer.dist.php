<?php

$finder = PhpCsFixer\Finder::create()
    ->in('src')
    ->in('tests')
    ->notName('bootstrap.php');

$config = new PhpCsFixer\Config();
return $config->setRules(array(
    '@Symfony' => true,
    'array_indentation' => true,
    'array_syntax' => array('syntax' => 'short'),
    'method_chaining_indentation' => true,
    'concat_space' => array('spacing' => 'one'),
    'phpdoc_add_missing_param_annotation' => true,
    'phpdoc_line_span' => true,
    'yoda_style' => ['equal' => false, 'identical' => false, 'less_and_greater' => false],
    'ordered_class_elements' => true,
    'header_comment' => [
        'header' => "This file is part of YNAB Tools.\n" .
        "\n" .
        "YNAB Tools is free software: you can redistribute it and/or modify\n" .
        "it under the terms of the GNU General Public License as published by\n" .
        "the Free Software Foundation, either version 3 of the License, or\n" .
        "(at your option) any later version.\n" .
        "\n" .
        "YNAB Tools is distributed in the hope that it will be useful,\n" .
        "but WITHOUT ANY WARRANTY; without even the implied warranty of\n" .
        "MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the\n" .
        "GNU General Public License for more details.\n" .
        "\n" .
        "You should have received a copy of the GNU General Public License\n" .
        "along with YNAB Tools.  If not, see <https://www.gnu.org/licenses/>.\n" .
        "\n" .
        "@author Brandon Olivares <programmer2188@gmail.com>\n" .
        "@copyright (C) 2021 Brandon Olivares <programmer2188@gmail.com>\n" .
        "@license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later",
        'comment_type' => 'PHPDoc',
        'location' => 'after_declare_strict',
        'separate' => 'both',
    ],
    // Risky
    '@Symfony:risky' => true,
    'psr_autoloading' => false,
    'php_unit_construct' => true,
    'php_unit_dedicate_assert' => true,
    'php_unit_dedicate_assert_internal_type' => true,
    'php_unit_strict' => true,
    'php_unit_test_case_static_method_calls' => ['call_type' => 'self'],
    'php_unit_no_expectation_annotation' => true,
    'php_unit_expectation' => true,
    'declare_strict_types' => true,
    'strict_comparison' => true,
    'strict_param' => true,
))
->setLineEnding("\n")
->setRiskyAllowed(true)
->setFinder($finder)
;
