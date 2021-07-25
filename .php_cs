<?php
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
    // Risky
    '@Symfony:risky' => true,
    'psr_autoloading' => false,
))
->setLineEnding("\n")
->setRiskyAllowed(true)
;
