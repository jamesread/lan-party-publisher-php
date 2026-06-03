<?php

use Rector\Config\RectorConfig;
use Rector\Php83\Rector\ClassMethod\AddOverrideAttributeToOverriddenMethodsRector;
use Rector\ValueObject\PhpVersion;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/lib',
        __DIR__ . '/tests',
    ])
    ->withPhpSets(php83: true)
    ->withPhpVersion(PhpVersion::PHP_83)
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        codingStyle: true,
        typeDeclarations: true,
        privatization: true,
        instanceOf: true,
        earlyReturn: true,
        carbon: true,
    )
    ->withImportNames(importDocBlockNames: false)
    ->withSkip([
        AddOverrideAttributeToOverriddenMethodsRector::class,
    ]);
