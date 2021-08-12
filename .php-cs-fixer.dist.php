<?php

$finder = PhpCsFixer\Finder::create()
    ->in('src')
    ->in('tests')
    ->notName('bootstrap.php');

$config = new PhpCsFixer\Config();

return $config->setRules([
    '@PHP80Migration' => true,
    '@Symfony' => true,
    'array_indentation' => true,
    'method_chaining_indentation' => true,
    'concat_space' => ['spacing' => 'one'],
    'align_multiline_comment' => ['comment_type' => 'all_multiline'],
    'phpdoc_line_span' => true,
    'yoda_style' => ['equal' => false, 'identical' => false, 'less_and_greater' => false],
    'ordered_class_elements' => true,
    'explicit_indirect_variable' => true,
    'heredoc_to_nowdoc' => true,
    'escape_implicit_backslashes' => [
        'single_quoted' => true,
        'double_quoted' => true,
        'heredoc_syntax' => true,
    ],
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
        '@license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later',
        'comment_type' => 'PHPDoc',
        'location' => 'after_declare_strict',
        'separate' => 'both',
    ],
    // Risky
    '@PHP80Migration:risky' => true,
    '@Symfony:risky' => true,
    '@PHPUnit84Migration:risky' => true,
    'php_unit_strict' => true,
    'php_unit_test_case_static_method_calls' => ['call_type' => 'self'],
    'strict_comparison' => true,
    'strict_param' => true,
    'final_class' => true,
    'final_public_method_for_abstract_class' => true,
    'date_time_immutable' => true,
])
    ->setLineEnding("\n")
    ->setRiskyAllowed(true)
    ->setFinder($finder)
;
