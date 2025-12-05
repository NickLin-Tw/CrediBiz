<?php declare(strict_types = 1);

return [
	'lastFullAnalysisTime' => 1764924965,
	'meta' => array (
  'cacheVersion' => 'v12-linesToIgnore',
  'phpstanVersion' => '2.1.32',
  'metaExtensions' => 
  array (
  ),
  'phpVersion' => 80500,
  'projectConfig' => '{conditionalTags: {Larastan\\Larastan\\Rules\\NoEnvCallsOutsideOfConfigRule: {phpstan.rules.rule: %noEnvCallsOutsideOfConfig%}, Larastan\\Larastan\\Rules\\NoModelMakeRule: {phpstan.rules.rule: %noModelMake%}, Larastan\\Larastan\\Rules\\NoUnnecessaryCollectionCallRule: {phpstan.rules.rule: %noUnnecessaryCollectionCall%}, Larastan\\Larastan\\Rules\\NoUnnecessaryEnumerableToArrayCallsRule: {phpstan.rules.rule: %noUnnecessaryEnumerableToArrayCalls%}, Larastan\\Larastan\\Rules\\OctaneCompatibilityRule: {phpstan.rules.rule: %checkOctaneCompatibility%}, Larastan\\Larastan\\Rules\\UnusedViewsRule: {phpstan.rules.rule: %checkUnusedViews%}, Larastan\\Larastan\\Rules\\NoMissingTranslationsRule: {phpstan.rules.rule: %checkMissingTranslations%}, Larastan\\Larastan\\Rules\\ModelAppendsRule: {phpstan.rules.rule: %checkModelAppends%}, Larastan\\Larastan\\Rules\\NoPublicModelScopeAndAccessorRule: {phpstan.rules.rule: %checkModelMethodVisibility%}, Larastan\\Larastan\\Rules\\NoAuthFacadeInRequestScopeRule: {phpstan.rules.rule: %checkAuthCallsWhenInRequestScope%}, Larastan\\Larastan\\Rules\\NoAuthHelperInRequestScopeRule: {phpstan.rules.rule: %checkAuthCallsWhenInRequestScope%}, Larastan\\Larastan\\ReturnTypes\\Helpers\\EnvFunctionDynamicFunctionReturnTypeExtension: {phpstan.broker.dynamicFunctionReturnTypeExtension: %generalizeEnvReturnType%}, Larastan\\Larastan\\ReturnTypes\\Helpers\\ConfigFunctionDynamicFunctionReturnTypeExtension: {phpstan.broker.dynamicFunctionReturnTypeExtension: %checkConfigTypes%}, Larastan\\Larastan\\ReturnTypes\\ConfigRepositoryDynamicMethodReturnTypeExtension: {phpstan.broker.dynamicMethodReturnTypeExtension: %checkConfigTypes%}, Larastan\\Larastan\\ReturnTypes\\ConfigFacadeCollectionDynamicStaticMethodReturnTypeExtension: {phpstan.broker.dynamicStaticMethodReturnTypeExtension: %checkConfigTypes%}, Larastan\\Larastan\\Rules\\ConfigCollectionRule: {phpstan.rules.rule: %checkConfigTypes%}}, parameters: {universalObjectCratesClasses: [Illuminate\\Http\\Request, Illuminate\\Support\\Optional], earlyTerminatingFunctionCalls: [abort, dd], mixinExcludeClasses: [Eloquent], bootstrapFiles: [bootstrap.php], checkOctaneCompatibility: false, noEnvCallsOutsideOfConfig: true, noModelMake: true, noUnnecessaryCollectionCall: true, noUnnecessaryCollectionCallOnly: [], noUnnecessaryCollectionCallExcept: [], noUnnecessaryEnumerableToArrayCalls: false, squashedMigrationsPath: [], databaseMigrationsPath: [], disableMigrationScan: false, disableSchemaScan: false, configDirectories: [], viewDirectories: [], translationDirectories: [], checkModelProperties: false, checkUnusedViews: false, checkMissingTranslations: false, checkModelAppends: true, checkModelMethodVisibility: false, generalizeEnvReturnType: false, checkConfigTypes: false, checkAuthCallsWhenInRequestScope: false, level: 5, paths: [/Users/junlonglin/Herd/CrediBiz/app, /Users/junlonglin/Herd/CrediBiz/config, /Users/junlonglin/Herd/CrediBiz/database], excludePaths: {analyseAndScan: [vendor, storage, bootstrap/cache], analyse: []}, tmpDir: /Users/junlonglin/Herd/CrediBiz/storage/phpstan}, rules: [Larastan\\Larastan\\Rules\\UselessConstructs\\NoUselessWithFunctionCallsRule, Larastan\\Larastan\\Rules\\UselessConstructs\\NoUselessValueFunctionCallsRule, Larastan\\Larastan\\Rules\\DeferrableServiceProviderMissingProvidesRule, Larastan\\Larastan\\Rules\\ConsoleCommand\\UndefinedArgumentOrOptionRule], services: {{class: Larastan\\Larastan\\Methods\\RelationForwardsCallsExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\ModelForwardsCallsExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\EloquentBuilderForwardsCallsExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\HigherOrderTapProxyExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\HigherOrderCollectionProxyExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\StorageMethodsClassReflectionExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\Extension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\ModelFactoryMethodsClassReflectionExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\RedirectResponseMethodsClassReflectionExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\MacroMethodsClassReflectionExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Methods\\ViewWithMethodsClassReflectionExtension, tags: [phpstan.broker.methodsClassReflectionExtension]}, {class: Larastan\\Larastan\\Properties\\ModelAccessorExtension, tags: [phpstan.broker.propertiesClassReflectionExtension]}, {class: Larastan\\Larastan\\Properties\\ModelPropertyExtension, tags: [phpstan.broker.propertiesClassReflectionExtension]}, {class: Larastan\\Larastan\\Properties\\HigherOrderCollectionProxyPropertyExtension, tags: [phpstan.broker.propertiesClassReflectionExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\HigherOrderTapProxyExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ContainerArrayAccessDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension], arguments: {className: Illuminate\\Contracts\\Container\\Container}}, {class: Larastan\\Larastan\\ReturnTypes\\ContainerArrayAccessDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension], arguments: {className: Illuminate\\Container\\Container}}, {class: Larastan\\Larastan\\ReturnTypes\\ContainerArrayAccessDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension], arguments: {className: Illuminate\\Foundation\\Application}}, {class: Larastan\\Larastan\\ReturnTypes\\ContainerArrayAccessDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension], arguments: {className: Illuminate\\Contracts\\Foundation\\Application}}, {class: Larastan\\Larastan\\Properties\\ModelRelationsExtension, tags: [phpstan.broker.propertiesClassReflectionExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ModelOnlyDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ModelFactoryDynamicStaticMethodReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ModelDynamicStaticMethodReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\AppMakeDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\AuthExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\GuardDynamicStaticMethodReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\AuthManagerExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\DateExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\GuardExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\RequestFileExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\RequestRouteExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\RequestUserExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\EloquentBuilderExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\RelationCollectionExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\TestCaseExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\Support\\CollectionHelper}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\AuthExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\CollectExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\NowAndTodayExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\ResponseExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\ValidatorExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\LiteralExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\CollectionFilterRejectDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\CollectionWhereNotNullDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\NewModelQueryDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\FactoryDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\Types\\AbortIfFunctionTypeSpecifyingExtension, tags: [phpstan.typeSpecifier.functionTypeSpecifyingExtension], arguments: {methodName: abort, negate: false}}, {class: Larastan\\Larastan\\Types\\AbortIfFunctionTypeSpecifyingExtension, tags: [phpstan.typeSpecifier.functionTypeSpecifyingExtension], arguments: {methodName: abort, negate: true}}, {class: Larastan\\Larastan\\Types\\AbortIfFunctionTypeSpecifyingExtension, tags: [phpstan.typeSpecifier.functionTypeSpecifyingExtension], arguments: {methodName: throw, negate: false}}, {class: Larastan\\Larastan\\Types\\AbortIfFunctionTypeSpecifyingExtension, tags: [phpstan.typeSpecifier.functionTypeSpecifyingExtension], arguments: {methodName: throw, negate: true}}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\AppExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\ValueExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\StrExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\TapExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\StorageDynamicStaticMethodReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\Types\\GenericEloquentCollectionTypeNodeResolverExtension, tags: [phpstan.phpDoc.typeNodeResolverExtension]}, {class: Larastan\\Larastan\\Types\\ViewStringTypeNodeResolverExtension, tags: [phpstan.phpDoc.typeNodeResolverExtension]}, {class: Larastan\\Larastan\\Rules\\OctaneCompatibilityRule}, {class: Larastan\\Larastan\\Rules\\NoEnvCallsOutsideOfConfigRule, arguments: {configDirectories: %configDirectories%}}, {class: Larastan\\Larastan\\Rules\\NoModelMakeRule}, {class: Larastan\\Larastan\\Rules\\NoUnnecessaryCollectionCallRule, arguments: {onlyMethods: %noUnnecessaryCollectionCallOnly%, excludeMethods: %noUnnecessaryCollectionCallExcept%}}, {class: Larastan\\Larastan\\Rules\\NoUnnecessaryEnumerableToArrayCallsRule}, {class: Larastan\\Larastan\\Rules\\ModelAppendsRule}, {class: Larastan\\Larastan\\Rules\\NoPublicModelScopeAndAccessorRule}, {class: Larastan\\Larastan\\Types\\GenericEloquentBuilderTypeNodeResolverExtension, tags: [phpstan.phpDoc.typeNodeResolverExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\AppEnvironmentReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension], arguments: {class: Illuminate\\Foundation\\Application}}, {class: Larastan\\Larastan\\ReturnTypes\\AppEnvironmentReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension], arguments: {class: Illuminate\\Contracts\\Foundation\\Application}}, {class: Larastan\\Larastan\\ReturnTypes\\AppFacadeEnvironmentReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\Types\\ModelProperty\\ModelPropertyTypeNodeResolverExtension, tags: [phpstan.phpDoc.typeNodeResolverExtension], arguments: {active: %checkModelProperties%}}, {class: Larastan\\Larastan\\Types\\CollectionOf\\CollectionOfTypeNodeResolverExtension, tags: [phpstan.phpDoc.typeNodeResolverExtension]}, {class: Larastan\\Larastan\\Properties\\MigrationHelper, arguments: {databaseMigrationPath: %databaseMigrationsPath%, disableMigrationScan: %disableMigrationScan%, parser: @migrationsParser, reflectionProvider: @reflectionProvider}}, iamcalSqlParser: {class: Larastan\\Larastan\\SQL\\IamcalSqlParser, autowired: false}, sqlParserFactory: {class: Larastan\\Larastan\\SQL\\SqlParserFactory, arguments: {iamcalSqlParser: @iamcalSqlParser}}, sqlParser: {type: Larastan\\Larastan\\SQL\\SqlParser, factory: [@sqlParserFactory, create]}, {class: Larastan\\Larastan\\Properties\\SquashedMigrationHelper, arguments: {schemaPaths: %squashedMigrationsPath%, disableSchemaScan: %disableSchemaScan%}}, {class: Larastan\\Larastan\\Properties\\ModelCastHelper}, {class: Larastan\\Larastan\\Properties\\ModelPropertyHelper}, {class: Larastan\\Larastan\\Rules\\ModelRuleHelper}, {class: Larastan\\Larastan\\Methods\\BuilderHelper, arguments: {checkProperties: %checkModelProperties%}}, {class: Larastan\\Larastan\\Rules\\RelationExistenceRule, tags: [phpstan.rules.rule]}, {class: Larastan\\Larastan\\Rules\\CheckDispatchArgumentTypesCompatibleWithClassConstructorRule, arguments: {dispatchableClass: Illuminate\\Foundation\\Bus\\Dispatchable}, tags: [phpstan.rules.rule]}, {class: Larastan\\Larastan\\Rules\\CheckDispatchArgumentTypesCompatibleWithClassConstructorRule, arguments: {dispatchableClass: Illuminate\\Foundation\\Events\\Dispatchable}, tags: [phpstan.rules.rule]}, {class: Larastan\\Larastan\\Properties\\Schema\\MySqlDataTypeToPhpTypeConverter}, {class: Larastan\\Larastan\\LarastanStubFilesExtension, tags: [phpstan.stubFilesExtension]}, {class: Larastan\\Larastan\\Rules\\UnusedViewsRule}, {class: Larastan\\Larastan\\Collectors\\UsedViewFunctionCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedEmailViewCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedViewMakeCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedViewFacadeMakeCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedRouteFacadeViewCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedViewInAnotherViewCollector}, {class: Larastan\\Larastan\\Support\\ViewFileHelper, arguments: {viewDirectories: %viewDirectories%}}, {class: Larastan\\Larastan\\Support\\ViewParser, arguments: {parser: @currentPhpVersionSimpleDirectParser}}, {class: Larastan\\Larastan\\Rules\\NoMissingTranslationsRule, arguments: {translationDirectories: %translationDirectories%}}, {class: Larastan\\Larastan\\Collectors\\UsedTranslationFunctionCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedTranslationTranslatorCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedTranslationFacadeCollector, tags: [phpstan.collector]}, {class: Larastan\\Larastan\\Collectors\\UsedTranslationViewCollector}, {class: Larastan\\Larastan\\ReturnTypes\\ApplicationMakeDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ContainerMakeDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ConsoleCommand\\ArgumentDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ConsoleCommand\\HasArgumentDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ConsoleCommand\\OptionDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\ConsoleCommand\\HasOptionDynamicReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\TranslatorGetReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\LangGetReturnTypeExtension, tags: [phpstan.broker.dynamicStaticMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\TransHelperReturnTypeExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\DoubleUnderscoreHelperReturnTypeExtension, tags: [phpstan.broker.dynamicFunctionReturnTypeExtension]}, {class: Larastan\\Larastan\\ReturnTypes\\AppMakeHelper}, {class: Larastan\\Larastan\\Internal\\ConsoleApplicationResolver}, {class: Larastan\\Larastan\\Internal\\ConsoleApplicationHelper}, {class: Larastan\\Larastan\\Support\\HigherOrderCollectionProxyHelper}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\ConfigFunctionDynamicFunctionReturnTypeExtension}, {class: Larastan\\Larastan\\ReturnTypes\\ConfigRepositoryDynamicMethodReturnTypeExtension}, {class: Larastan\\Larastan\\ReturnTypes\\ConfigFacadeCollectionDynamicStaticMethodReturnTypeExtension}, {class: Larastan\\Larastan\\Support\\ConfigParser, arguments: {parser: @currentPhpVersionSimpleDirectParser, configPaths: %configDirectories%}}, {class: Larastan\\Larastan\\Internal\\ConfigHelper}, {class: Larastan\\Larastan\\ReturnTypes\\Helpers\\EnvFunctionDynamicFunctionReturnTypeExtension}, {class: Larastan\\Larastan\\ReturnTypes\\FormRequestSafeDynamicMethodReturnTypeExtension, tags: [phpstan.broker.dynamicMethodReturnTypeExtension]}, {class: Larastan\\Larastan\\Rules\\NoAuthFacadeInRequestScopeRule}, {class: Larastan\\Larastan\\Rules\\NoAuthHelperInRequestScopeRule}, {class: Larastan\\Larastan\\Rules\\ConfigCollectionRule}, {class: Illuminate\\Filesystem\\Filesystem, autowired: self}, migrationsParser: {class: PHPStan\\Parser\\CachedParser, arguments: {originalParser: @currentPhpVersionSimpleDirectParser, cachedNodesByStringCountMax: %cache.nodesByStringCountMax%}, autowired: false}}}',
  'analysedPaths' => 
  array (
    0 => '/Users/junlonglin/Herd/CrediBiz/app',
    1 => '/Users/junlonglin/Herd/CrediBiz/config',
    2 => '/Users/junlonglin/Herd/CrediBiz/database',
  ),
  'scannedFiles' => 
  array (
  ),
  'composerLocks' => 
  array (
    '/Users/junlonglin/Herd/CrediBiz/composer.lock' => '1bc85285439e017ddad61aeb50f377a3f8ed7286',
  ),
  'composerInstalled' => 
  array (
    '/Users/junlonglin/Herd/CrediBiz/vendor/composer/installed.php' => 
    array (
      'versions' => 
      array (
        'archtechx/enums' => 
        array (
          'pretty_version' => 'v1.1.2',
          'version' => '1.1.2.0',
          'reference' => '81375b71c176f680880a95e7448d84258cfb5c72',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../archtechx/enums',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'brianium/paratest' => 
        array (
          'pretty_version' => 'v7.15.0',
          'version' => '7.15.0.0',
          'reference' => '272ff9d59b2ed0bd97c86c3cfe97c9784dabf786',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../brianium/paratest',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'brick/math' => 
        array (
          'pretty_version' => '0.14.1',
          'version' => '0.14.1.0',
          'reference' => 'f05858549e5f9d7bb45875a75583240a38a281d0',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../brick/math',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'carbonphp/carbon-doctrine-types' => 
        array (
          'pretty_version' => '3.2.0',
          'version' => '3.2.0.0',
          'reference' => '18ba5ddfec8976260ead6e866180bd5d2f71aa1d',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../carbonphp/carbon-doctrine-types',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'composer/semver' => 
        array (
          'pretty_version' => '3.4.4',
          'version' => '3.4.4.0',
          'reference' => '198166618906cb2de69b95d7d47e5fa8aa1b2b95',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/./semver',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'cordoval/hamcrest-php' => 
        array (
          'dev_requirement' => true,
          'replaced' => 
          array (
            0 => '*',
          ),
        ),
        'davedevelopment/hamcrest-php' => 
        array (
          'dev_requirement' => true,
          'replaced' => 
          array (
            0 => '*',
          ),
        ),
        'dflydev/dot-access-data' => 
        array (
          'pretty_version' => 'v3.0.3',
          'version' => '3.0.3.0',
          'reference' => 'a23a2bf4f31d3518f3ecb38660c95715dfead60f',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../dflydev/dot-access-data',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'doctrine/deprecations' => 
        array (
          'pretty_version' => '1.1.5',
          'version' => '1.1.5.0',
          'reference' => '459c2f5dd3d6a4633d3b5f46ee2b1c40f57d3f38',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../doctrine/deprecations',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'doctrine/inflector' => 
        array (
          'pretty_version' => '2.1.0',
          'version' => '2.1.0.0',
          'reference' => '6d6c96277ea252fc1304627204c3d5e6e15faa3b',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../doctrine/inflector',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'doctrine/lexer' => 
        array (
          'pretty_version' => '3.0.1',
          'version' => '3.0.1.0',
          'reference' => '31ad66abc0fc9e1a1f2d9bc6a42668d2fbbcd6dd',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../doctrine/lexer',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'dragon-code/contracts' => 
        array (
          'pretty_version' => '2.24.0',
          'version' => '2.24.0.0',
          'reference' => 'c21ea4fc0a399bd803a2805a7f2c989749083896',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../dragon-code/contracts',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'dragon-code/pretty-array' => 
        array (
          'pretty_version' => '4.2.0',
          'version' => '4.2.0.0',
          'reference' => 'b94034d92172a5d14a578822d68b2a8f8b5388e0',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../dragon-code/pretty-array',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'dragon-code/support' => 
        array (
          'pretty_version' => '6.16.0',
          'version' => '6.16.0.0',
          'reference' => 'ab9b657a307e75f6ba5b2b39e1e45207dc1a065a',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../dragon-code/support',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'dragonmantank/cron-expression' => 
        array (
          'pretty_version' => 'v3.6.0',
          'version' => '3.6.0.0',
          'reference' => 'd61a8a9604ec1f8c3d150d09db6ce98b32675013',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../dragonmantank/cron-expression',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'egulias/email-validator' => 
        array (
          'pretty_version' => '4.0.4',
          'version' => '4.0.4.0',
          'reference' => 'd42c8731f0624ad6bdc8d3e5e9a4524f68801cfa',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../egulias/email-validator',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'enlightn/security-checker' => 
        array (
          'pretty_version' => 'v2.0.0',
          'version' => '2.0.0.0',
          'reference' => 'd495ab07639388c7c770c5223aa0d42fee1d2604',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../enlightn/security-checker',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'fakerphp/faker' => 
        array (
          'pretty_version' => 'v1.24.1',
          'version' => '1.24.1.0',
          'reference' => 'e0ee18eb1e6dc3cda3ce9fd97e5a0689a88a64b5',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../fakerphp/faker',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'fidry/cpu-core-counter' => 
        array (
          'pretty_version' => '1.3.0',
          'version' => '1.3.0.0',
          'reference' => 'db9508f7b1474469d9d3c53b86f817e344732678',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../fidry/cpu-core-counter',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'filp/whoops' => 
        array (
          'pretty_version' => '2.18.4',
          'version' => '2.18.4.0',
          'reference' => 'd2102955e48b9fd9ab24280a7ad12ed552752c4d',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../filp/whoops',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'fruitcake/php-cors' => 
        array (
          'pretty_version' => 'v1.4.0',
          'version' => '1.4.0.0',
          'reference' => '38aaa6c3fd4c157ffe2a4d10aa8b9b16ba8de379',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../fruitcake/php-cors',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'graham-campbell/result-type' => 
        array (
          'pretty_version' => 'v1.1.3',
          'version' => '1.1.3.0',
          'reference' => '3ba905c11371512af9d9bdd27d99b782216b6945',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../graham-campbell/result-type',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'guzzlehttp/guzzle' => 
        array (
          'pretty_version' => '7.10.0',
          'version' => '7.10.0.0',
          'reference' => 'b51ac707cfa420b7bfd4e4d5e510ba8008e822b4',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../guzzlehttp/guzzle',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'guzzlehttp/promises' => 
        array (
          'pretty_version' => '2.3.0',
          'version' => '2.3.0.0',
          'reference' => '481557b130ef3790cf82b713667b43030dc9c957',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../guzzlehttp/promises',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'guzzlehttp/psr7' => 
        array (
          'pretty_version' => '2.8.0',
          'version' => '2.8.0.0',
          'reference' => '21dc724a0583619cd1652f673303492272778051',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../guzzlehttp/psr7',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'guzzlehttp/uri-template' => 
        array (
          'pretty_version' => 'v1.0.5',
          'version' => '1.0.5.0',
          'reference' => '4f4bbd4e7172148801e76e3decc1e559bdee34e1',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../guzzlehttp/uri-template',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'hamcrest/hamcrest-php' => 
        array (
          'pretty_version' => 'v2.1.1',
          'version' => '2.1.1.0',
          'reference' => 'f8b1c0173b22fa6ec77a81fe63e5b01eba7e6487',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../hamcrest/hamcrest-php',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'iamcal/sql-parser' => 
        array (
          'pretty_version' => 'v0.6',
          'version' => '0.6.0.0',
          'reference' => '947083e2dca211a6f12fb1beb67a01e387de9b62',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../iamcal/sql-parser',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'illuminate/auth' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/broadcasting' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/bus' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/cache' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/collections' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/concurrency' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/conditionable' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/config' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/console' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/container' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/contracts' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/cookie' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/database' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/encryption' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/events' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/filesystem' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/hashing' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/http' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/json-schema' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/log' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/macroable' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/mail' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/notifications' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/pagination' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/pipeline' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/process' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/queue' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/redis' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/routing' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/session' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/support' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/testing' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/translation' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/validation' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'illuminate/view' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => 'v12.41.1',
          ),
        ),
        'jean85/pretty-package-versions' => 
        array (
          'pretty_version' => '2.1.1',
          'version' => '2.1.1.0',
          'reference' => '4d7aa5dab42e2a76d99559706022885de0e18e1a',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../jean85/pretty-package-versions',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'kodova/hamcrest-php' => 
        array (
          'dev_requirement' => true,
          'replaced' => 
          array (
            0 => '*',
          ),
        ),
        'larastan/larastan' => 
        array (
          'pretty_version' => 'v3.8.0',
          'version' => '3.8.0.0',
          'reference' => 'd13ef96d652d1b2a8f34f1760ba6bf5b9c98112e',
          'type' => 'phpstan-extension',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../larastan/larastan',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel-lang/attributes' => 
        array (
          'pretty_version' => '2.14.0',
          'version' => '2.14.0.0',
          'reference' => '81fd36309dfe0e9f38545b58a8a35763c1f88d48',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../laravel-lang/attributes',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel-lang/config' => 
        array (
          'pretty_version' => '1.15.0',
          'version' => '1.15.0.0',
          'reference' => '080b7cf77eeebdd7e7c267f1b2c3c7fc20408f3c',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../laravel-lang/config',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel-lang/http-statuses' => 
        array (
          'pretty_version' => '3.11.0',
          'version' => '3.11.0.0',
          'reference' => '5f4f9aebf7d907c89e4f65136c7863d34bc9dc28',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../laravel-lang/http-statuses',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel-lang/lang' => 
        array (
          'pretty_version' => '15.26.2',
          'version' => '15.26.2.0',
          'reference' => '4f49e4a77ced9ace7955db2159234e4a9c0b22a3',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../laravel-lang/lang',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel-lang/locale-list' => 
        array (
          'pretty_version' => '1.6.0',
          'version' => '1.6.0.0',
          'reference' => '98227230d737b32279f8376a3149be43965513c6',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../laravel-lang/locale-list',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel-lang/locales' => 
        array (
          'pretty_version' => '2.10.0',
          'version' => '2.10.0.0',
          'reference' => '8c1d2383ced70a919b3c2f430589be6c81663087',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../laravel-lang/locales',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel-lang/native-country-names' => 
        array (
          'pretty_version' => '1.6.0',
          'version' => '1.6.0.0',
          'reference' => '22a9d18d9094fdf0b3384f37feefd3c7d91f1db9',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../laravel-lang/native-country-names',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel-lang/native-currency-names' => 
        array (
          'pretty_version' => '1.7.0',
          'version' => '1.7.0.0',
          'reference' => 'cc871b6d2574b4397728b78e4522e6cfd53cdb79',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../laravel-lang/native-currency-names',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel-lang/native-locale-names' => 
        array (
          'pretty_version' => '2.6.1',
          'version' => '2.6.1.0',
          'reference' => 'a5fe634a4db570160dbf3ac68882d281fc88436e',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../laravel-lang/native-locale-names',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel-lang/publisher' => 
        array (
          'pretty_version' => '16.7.0',
          'version' => '16.7.0.0',
          'reference' => 'af47a0807f753818d72808250a1166e98172047c',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../laravel-lang/publisher',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel/framework' => 
        array (
          'pretty_version' => 'v12.41.1',
          'version' => '12.41.1.0',
          'reference' => '3e229b05935fd0300c632fb1f718c73046d664fc',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../laravel/framework',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'laravel/pail' => 
        array (
          'pretty_version' => 'v1.2.4',
          'version' => '1.2.4.0',
          'reference' => '49f92285ff5d6fc09816e976a004f8dec6a0ea30',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../laravel/pail',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel/pint' => 
        array (
          'pretty_version' => 'v1.26.0',
          'version' => '1.26.0.0',
          'reference' => '69dcca060ecb15e4b564af63d1f642c81a241d6f',
          'type' => 'project',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../laravel/pint',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel/prompts' => 
        array (
          'pretty_version' => 'v0.3.8',
          'version' => '0.3.8.0',
          'reference' => '096748cdfb81988f60090bbb839ce3205ace0d35',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../laravel/prompts',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'laravel/sail' => 
        array (
          'pretty_version' => 'v1.50.0',
          'version' => '1.50.0.0',
          'reference' => '9177d5de1c8247166b92ea6049c2b069d2a1802f',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../laravel/sail',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'laravel/sanctum' => 
        array (
          'pretty_version' => 'v4.2.1',
          'version' => '4.2.1.0',
          'reference' => 'f5fb373be39a246c74a060f2cf2ae2c2145b3664',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../laravel/sanctum',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'laravel/serializable-closure' => 
        array (
          'pretty_version' => 'v2.0.7',
          'version' => '2.0.7.0',
          'reference' => 'cb291e4c998ac50637c7eeb58189c14f5de5b9dd',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../laravel/serializable-closure',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'laravel/tinker' => 
        array (
          'pretty_version' => 'v2.10.2',
          'version' => '2.10.2.0',
          'reference' => '3bcb5f62d6f837e0f093a601e26badafb127bd4c',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../laravel/tinker',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'lcobucci/clock' => 
        array (
          'pretty_version' => '3.5.0',
          'version' => '3.5.0.0',
          'reference' => 'a3139d9e97d47826f27e6a17bb63f13621f86058',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../lcobucci/clock',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'lcobucci/jwt' => 
        array (
          'pretty_version' => '4.3.0',
          'version' => '4.3.0.0',
          'reference' => '4d7de2fe0d51a96418c0d04004986e410e87f6b4',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../lcobucci/jwt',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'league/commonmark' => 
        array (
          'pretty_version' => '2.8.0',
          'version' => '2.8.0.0',
          'reference' => '4efa10c1e56488e658d10adf7b7b7dcd19940bfb',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../league/commonmark',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'league/config' => 
        array (
          'pretty_version' => 'v1.2.0',
          'version' => '1.2.0.0',
          'reference' => '754b3604fb2984c71f4af4a9cbe7b57f346ec1f3',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../league/config',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'league/flysystem' => 
        array (
          'pretty_version' => '3.30.2',
          'version' => '3.30.2.0',
          'reference' => '5966a8ba23e62bdb518dd9e0e665c2dbd4b5b277',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../league/flysystem',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'league/flysystem-local' => 
        array (
          'pretty_version' => '3.30.2',
          'version' => '3.30.2.0',
          'reference' => 'ab4f9d0d672f601b102936aa728801dd1a11968d',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../league/flysystem-local',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'league/mime-type-detection' => 
        array (
          'pretty_version' => '1.16.0',
          'version' => '1.16.0.0',
          'reference' => '2d6702ff215bf922936ccc1ad31007edc76451b9',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../league/mime-type-detection',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'league/uri' => 
        array (
          'pretty_version' => '7.6.0',
          'version' => '7.6.0.0',
          'reference' => 'f625804987a0a9112d954f9209d91fec52182344',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../league/uri',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'league/uri-interfaces' => 
        array (
          'pretty_version' => '7.6.0',
          'version' => '7.6.0.0',
          'reference' => 'ccbfb51c0445298e7e0b7f4481b942f589665368',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../league/uri-interfaces',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'mockery/mockery' => 
        array (
          'pretty_version' => '1.6.12',
          'version' => '1.6.12.0',
          'reference' => '1f4efdd7d3beafe9807b08156dfcb176d18f1699',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../mockery/mockery',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'monolog/monolog' => 
        array (
          'pretty_version' => '3.9.0',
          'version' => '3.9.0.0',
          'reference' => '10d85740180ecba7896c87e06a166e0c95a0e3b6',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../monolog/monolog',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'mtdowling/cron-expression' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => '^1.0',
          ),
        ),
        'myclabs/deep-copy' => 
        array (
          'pretty_version' => '1.13.4',
          'version' => '1.13.4.0',
          'reference' => '07d290f0c47959fd5eed98c95ee5602db07e0b6a',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../myclabs/deep-copy',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'nesbot/carbon' => 
        array (
          'pretty_version' => '3.11.0',
          'version' => '3.11.0.0',
          'reference' => 'bdb375400dcd162624531666db4799b36b64e4a1',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../nesbot/carbon',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'nette/schema' => 
        array (
          'pretty_version' => 'v1.3.3',
          'version' => '1.3.3.0',
          'reference' => '2befc2f42d7c715fd9d95efc31b1081e5d765004',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../nette/schema',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'nette/utils' => 
        array (
          'pretty_version' => 'v4.1.0',
          'version' => '4.1.0.0',
          'reference' => 'fa1f0b8261ed150447979eb22e373b7b7ad5a8e0',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../nette/utils',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'nikic/php-parser' => 
        array (
          'pretty_version' => 'v5.6.2',
          'version' => '5.6.2.0',
          'reference' => '3a454ca033b9e06b63282ce19562e892747449bb',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../nikic/php-parser',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'nunomaduro/collision' => 
        array (
          'pretty_version' => 'v8.8.3',
          'version' => '8.8.3.0',
          'reference' => '1dc9e88d105699d0fee8bb18890f41b274f6b4c4',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../nunomaduro/collision',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'nunomaduro/termwind' => 
        array (
          'pretty_version' => 'v2.3.3',
          'version' => '2.3.3.0',
          'reference' => '6fb2a640ff502caace8e05fd7be3b503a7e1c017',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../nunomaduro/termwind',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'pestphp/pest' => 
        array (
          'pretty_version' => 'v4.1.6',
          'version' => '4.1.6.0',
          'reference' => 'ae419afd363299c29ad5b17e8b70d118b1068bb4',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../pestphp/pest',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'pestphp/pest-plugin' => 
        array (
          'pretty_version' => 'v4.0.0',
          'version' => '4.0.0.0',
          'reference' => '9d4b93d7f73d3f9c3189bb22c220fef271cdf568',
          'type' => 'composer-plugin',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../pestphp/pest-plugin',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'pestphp/pest-plugin-arch' => 
        array (
          'pretty_version' => 'v4.0.0',
          'version' => '4.0.0.0',
          'reference' => '25bb17e37920ccc35cbbcda3b00d596aadf3e58d',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../pestphp/pest-plugin-arch',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'pestphp/pest-plugin-laravel' => 
        array (
          'pretty_version' => 'v4.0.0',
          'version' => '4.0.0.0',
          'reference' => 'e12a07046b826a40b1c8632fd7b80d6b8d7b628e',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../pestphp/pest-plugin-laravel',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'pestphp/pest-plugin-mutate' => 
        array (
          'pretty_version' => 'v4.0.1',
          'version' => '4.0.1.0',
          'reference' => 'd9b32b60b2385e1688a68cc227594738ec26d96c',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../pestphp/pest-plugin-mutate',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'pestphp/pest-plugin-profanity' => 
        array (
          'pretty_version' => 'v4.2.0',
          'version' => '4.2.0.0',
          'reference' => 'c37e5e2c7136ee4eae12082e7952332bc1c6600a',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../pestphp/pest-plugin-profanity',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phar-io/manifest' => 
        array (
          'pretty_version' => '2.0.4',
          'version' => '2.0.4.0',
          'reference' => '54750ef60c58e43759730615a392c31c80e23176',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../phar-io/manifest',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phar-io/version' => 
        array (
          'pretty_version' => '3.2.1',
          'version' => '3.2.1.0',
          'reference' => '4f7fd7836c6f332bb2933569e566a0d6c4cbed74',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../phar-io/version',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpdocumentor/reflection-common' => 
        array (
          'pretty_version' => '2.2.0',
          'version' => '2.2.0.0',
          'reference' => '1d01c49d4ed62f25aa84a747ad35d5a16924662b',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../phpdocumentor/reflection-common',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpdocumentor/reflection-docblock' => 
        array (
          'pretty_version' => '5.6.5',
          'version' => '5.6.5.0',
          'reference' => '90614c73d3800e187615e2dd236ad0e2a01bf761',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../phpdocumentor/reflection-docblock',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpdocumentor/type-resolver' => 
        array (
          'pretty_version' => '1.12.0',
          'version' => '1.12.0.0',
          'reference' => '92a98ada2b93d9b201a613cb5a33584dde25f195',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../phpdocumentor/type-resolver',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpoption/phpoption' => 
        array (
          'pretty_version' => '1.9.4',
          'version' => '1.9.4.0',
          'reference' => '638a154f8d4ee6a5cfa96d6a34dfbe0cffa9566d',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../phpoption/phpoption',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'phpstan/phpdoc-parser' => 
        array (
          'pretty_version' => '2.3.0',
          'version' => '2.3.0.0',
          'reference' => '1e0cd5370df5dd2e556a36b9c62f62e555870495',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../phpstan/phpdoc-parser',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpstan/phpstan' => 
        array (
          'pretty_version' => '2.1.32',
          'version' => '2.1.32.0',
          'reference' => 'e126cad1e30a99b137b8ed75a85a676450ebb227',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../phpstan/phpstan',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpunit/php-code-coverage' => 
        array (
          'pretty_version' => '12.5.0',
          'version' => '12.5.0.0',
          'reference' => 'bca180c050dd3ae15f87c26d25cabb34fe1a0a5a',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../phpunit/php-code-coverage',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpunit/php-file-iterator' => 
        array (
          'pretty_version' => '6.0.0',
          'version' => '6.0.0.0',
          'reference' => '961bc913d42fe24a257bfff826a5068079ac7782',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../phpunit/php-file-iterator',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpunit/php-invoker' => 
        array (
          'pretty_version' => '6.0.0',
          'version' => '6.0.0.0',
          'reference' => '12b54e689b07a25a9b41e57736dfab6ec9ae5406',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../phpunit/php-invoker',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpunit/php-text-template' => 
        array (
          'pretty_version' => '5.0.0',
          'version' => '5.0.0.0',
          'reference' => 'e1367a453f0eda562eedb4f659e13aa900d66c53',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../phpunit/php-text-template',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpunit/php-timer' => 
        array (
          'pretty_version' => '8.0.0',
          'version' => '8.0.0.0',
          'reference' => 'f258ce36aa457f3aa3339f9ed4c81fc66dc8c2cc',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../phpunit/php-timer',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'phpunit/phpunit' => 
        array (
          'pretty_version' => '12.4.4',
          'version' => '12.4.4.0',
          'reference' => '9253ec75a672e39fcc9d85bdb61448215b8162c7',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../phpunit/phpunit',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'psr/clock' => 
        array (
          'pretty_version' => '1.0.0',
          'version' => '1.0.0.0',
          'reference' => 'e41a24703d4560fd0acb709162f73b8adfc3aa0d',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../psr/clock',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'psr/clock-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '1.0',
          ),
        ),
        'psr/container' => 
        array (
          'pretty_version' => '2.0.2',
          'version' => '2.0.2.0',
          'reference' => 'c71ecc56dfe541dbd90c5360474fbc405f8d5963',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../psr/container',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'psr/container-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '1.1|2.0',
          ),
        ),
        'psr/event-dispatcher' => 
        array (
          'pretty_version' => '1.0.0',
          'version' => '1.0.0.0',
          'reference' => 'dbefd12671e8a14ec7f180cab83036ed26714bb0',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../psr/event-dispatcher',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'psr/event-dispatcher-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '1.0',
          ),
        ),
        'psr/http-client' => 
        array (
          'pretty_version' => '1.0.3',
          'version' => '1.0.3.0',
          'reference' => 'bb5906edc1c324c9a05aa0873d40117941e5fa90',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../psr/http-client',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'psr/http-client-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '1.0',
          ),
        ),
        'psr/http-factory' => 
        array (
          'pretty_version' => '1.1.0',
          'version' => '1.1.0.0',
          'reference' => '2b4765fddfe3b508ac62f829e852b1501d3f6e8a',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../psr/http-factory',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'psr/http-factory-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '1.0',
          ),
        ),
        'psr/http-message' => 
        array (
          'pretty_version' => '2.0',
          'version' => '2.0.0.0',
          'reference' => '402d35bcb92c70c026d1a6a9883f06b2ead23d71',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../psr/http-message',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'psr/http-message-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '1.0',
          ),
        ),
        'psr/log' => 
        array (
          'pretty_version' => '3.0.2',
          'version' => '3.0.2.0',
          'reference' => 'f16e1d5863e37f8d8c2a01719f5b34baa2b714d3',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../psr/log',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'psr/log-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '1.0|2.0|3.0',
            1 => '3.0.0',
          ),
        ),
        'psr/simple-cache' => 
        array (
          'pretty_version' => '3.0.0',
          'version' => '3.0.0.0',
          'reference' => '764e0b3939f5ca87cb904f570ef9be2d78a07865',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../psr/simple-cache',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'psr/simple-cache-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '1.0|2.0|3.0',
          ),
        ),
        'psy/psysh' => 
        array (
          'pretty_version' => 'v0.12.15',
          'version' => '0.12.15.0',
          'reference' => '38953bc71491c838fcb6ebcbdc41ab7483cd549c',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../psy/psysh',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'ralouphie/getallheaders' => 
        array (
          'pretty_version' => '3.0.3',
          'version' => '3.0.3.0',
          'reference' => '120b605dfeb996808c31b6477290a714d356e822',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../ralouphie/getallheaders',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'ramsey/collection' => 
        array (
          'pretty_version' => '2.1.1',
          'version' => '2.1.1.0',
          'reference' => '344572933ad0181accbf4ba763e85a0306a8c5e2',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../ramsey/collection',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'ramsey/uuid' => 
        array (
          'pretty_version' => '4.9.1',
          'version' => '4.9.1.0',
          'reference' => '81f941f6f729b1e3ceea61d9d014f8b6c6800440',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../ramsey/uuid',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'rhumsaa/uuid' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => '4.9.1',
          ),
        ),
        'sebastian/cli-parser' => 
        array (
          'pretty_version' => '4.2.0',
          'version' => '4.2.0.0',
          'reference' => '90f41072d220e5c40df6e8635f5dafba2d9d4d04',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../sebastian/cli-parser',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/comparator' => 
        array (
          'pretty_version' => '7.1.3',
          'version' => '7.1.3.0',
          'reference' => 'dc904b4bb3ab070865fa4068cd84f3da8b945148',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../sebastian/comparator',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/complexity' => 
        array (
          'pretty_version' => '5.0.0',
          'version' => '5.0.0.0',
          'reference' => 'bad4316aba5303d0221f43f8cee37eb58d384bbb',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../sebastian/complexity',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/diff' => 
        array (
          'pretty_version' => '7.0.0',
          'version' => '7.0.0.0',
          'reference' => '7ab1ea946c012266ca32390913653d844ecd085f',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../sebastian/diff',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/environment' => 
        array (
          'pretty_version' => '8.0.3',
          'version' => '8.0.3.0',
          'reference' => '24a711b5c916efc6d6e62aa65aa2ec98fef77f68',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../sebastian/environment',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/exporter' => 
        array (
          'pretty_version' => '7.0.2',
          'version' => '7.0.2.0',
          'reference' => '016951ae10980765e4e7aee491eb288c64e505b7',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../sebastian/exporter',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/global-state' => 
        array (
          'pretty_version' => '8.0.2',
          'version' => '8.0.2.0',
          'reference' => 'ef1377171613d09edd25b7816f05be8313f9115d',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../sebastian/global-state',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/lines-of-code' => 
        array (
          'pretty_version' => '4.0.0',
          'version' => '4.0.0.0',
          'reference' => '97ffee3bcfb5805568d6af7f0f893678fc076d2f',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../sebastian/lines-of-code',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/object-enumerator' => 
        array (
          'pretty_version' => '7.0.0',
          'version' => '7.0.0.0',
          'reference' => '1effe8e9b8e068e9ae228e542d5d11b5d16db894',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../sebastian/object-enumerator',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/object-reflector' => 
        array (
          'pretty_version' => '5.0.0',
          'version' => '5.0.0.0',
          'reference' => '4bfa827c969c98be1e527abd576533293c634f6a',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../sebastian/object-reflector',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/recursion-context' => 
        array (
          'pretty_version' => '7.0.1',
          'version' => '7.0.1.0',
          'reference' => '0b01998a7d5b1f122911a66bebcb8d46f0c82d8c',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../sebastian/recursion-context',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/type' => 
        array (
          'pretty_version' => '6.0.3',
          'version' => '6.0.3.0',
          'reference' => 'e549163b9760b8f71f191651d22acf32d56d6d4d',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../sebastian/type',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'sebastian/version' => 
        array (
          'pretty_version' => '6.0.0',
          'version' => '6.0.0.0',
          'reference' => '3e6ccf7657d4f0a59200564b08cead899313b53c',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../sebastian/version',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'spatie/once' => 
        array (
          'dev_requirement' => false,
          'replaced' => 
          array (
            0 => '*',
          ),
        ),
        'staabm/side-effects-detector' => 
        array (
          'pretty_version' => '1.0.5',
          'version' => '1.0.5.0',
          'reference' => 'd8334211a140ce329c13726d4a715adbddd0a163',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../staabm/side-effects-detector',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'symfony/clock' => 
        array (
          'pretty_version' => 'v8.0.0',
          'version' => '8.0.0.0',
          'reference' => '832119f9b8dbc6c8e6f65f30c5969eca1e88764f',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../symfony/clock',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/console' => 
        array (
          'pretty_version' => 'v7.4.0',
          'version' => '7.4.0.0',
          'reference' => '0bc0f45254b99c58d45a8fbf9fb955d46cbd1bb8',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../symfony/console',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/css-selector' => 
        array (
          'pretty_version' => 'v7.4.0',
          'version' => '7.4.0.0',
          'reference' => 'ab862f478513e7ca2fe9ec117a6f01a8da6e1135',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../symfony/css-selector',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/deprecation-contracts' => 
        array (
          'pretty_version' => 'v3.6.0',
          'version' => '3.6.0.0',
          'reference' => '63afe740e99a13ba87ec199bb07bbdee937a5b62',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../symfony/deprecation-contracts',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/error-handler' => 
        array (
          'pretty_version' => 'v7.4.0',
          'version' => '7.4.0.0',
          'reference' => '48be2b0653594eea32dcef130cca1c811dcf25c2',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../symfony/error-handler',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/event-dispatcher' => 
        array (
          'pretty_version' => 'v8.0.0',
          'version' => '8.0.0.0',
          'reference' => '573f95783a2ec6e38752979db139f09fec033f03',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../symfony/event-dispatcher',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/event-dispatcher-contracts' => 
        array (
          'pretty_version' => 'v3.6.0',
          'version' => '3.6.0.0',
          'reference' => '59eb412e93815df44f05f342958efa9f46b1e586',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../symfony/event-dispatcher-contracts',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/event-dispatcher-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '2.0|3.0',
          ),
        ),
        'symfony/finder' => 
        array (
          'pretty_version' => 'v7.4.0',
          'version' => '7.4.0.0',
          'reference' => '340b9ed7320570f319028a2cbec46d40535e94bd',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../symfony/finder',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/http-foundation' => 
        array (
          'pretty_version' => 'v7.4.0',
          'version' => '7.4.0.0',
          'reference' => '769c1720b68e964b13b58529c17d4a385c62167b',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../symfony/http-foundation',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/http-kernel' => 
        array (
          'pretty_version' => 'v7.4.0',
          'version' => '7.4.0.0',
          'reference' => '7348193cd384495a755554382e4526f27c456085',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../symfony/http-kernel',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/mailer' => 
        array (
          'pretty_version' => 'v7.4.0',
          'version' => '7.4.0.0',
          'reference' => 'a3d9eea8cfa467ece41f0f54ba28185d74bd53fd',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../symfony/mailer',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/mime' => 
        array (
          'pretty_version' => 'v7.4.0',
          'version' => '7.4.0.0',
          'reference' => 'bdb02729471be5d047a3ac4a69068748f1a6be7a',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../symfony/mime',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-ctype' => 
        array (
          'pretty_version' => 'v1.33.0',
          'version' => '1.33.0.0',
          'reference' => 'a3cc8b044a6ea513310cbd48ef7333b384945638',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../symfony/polyfill-ctype',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-intl-grapheme' => 
        array (
          'pretty_version' => 'v1.33.0',
          'version' => '1.33.0.0',
          'reference' => '380872130d3a5dd3ace2f4010d95125fde5d5c70',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../symfony/polyfill-intl-grapheme',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-intl-idn' => 
        array (
          'pretty_version' => 'v1.33.0',
          'version' => '1.33.0.0',
          'reference' => '9614ac4d8061dc257ecc64cba1b140873dce8ad3',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../symfony/polyfill-intl-idn',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-intl-normalizer' => 
        array (
          'pretty_version' => 'v1.33.0',
          'version' => '1.33.0.0',
          'reference' => '3833d7255cc303546435cb650316bff708a1c75c',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../symfony/polyfill-intl-normalizer',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-mbstring' => 
        array (
          'pretty_version' => 'v1.33.0',
          'version' => '1.33.0.0',
          'reference' => '6d857f4d76bd4b343eac26d6b539585d2bc56493',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../symfony/polyfill-mbstring',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-php80' => 
        array (
          'pretty_version' => 'v1.33.0',
          'version' => '1.33.0.0',
          'reference' => '0cc9dd0f17f61d8131e7df6b84bd344899fe2608',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../symfony/polyfill-php80',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-php81' => 
        array (
          'pretty_version' => 'v1.33.0',
          'version' => '1.33.0.0',
          'reference' => '4a4cfc2d253c21a5ad0e53071df248ed48c6ce5c',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../symfony/polyfill-php81',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'symfony/polyfill-php83' => 
        array (
          'pretty_version' => 'v1.33.0',
          'version' => '1.33.0.0',
          'reference' => '17f6f9a6b1735c0f163024d959f700cfbc5155e5',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../symfony/polyfill-php83',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-php84' => 
        array (
          'pretty_version' => 'v1.33.0',
          'version' => '1.33.0.0',
          'reference' => 'd8ced4d875142b6a7426000426b8abc631d6b191',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../symfony/polyfill-php84',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-php85' => 
        array (
          'pretty_version' => 'v1.33.0',
          'version' => '1.33.0.0',
          'reference' => 'd4e5fcd4ab3d998ab16c0db48e6cbb9a01993f91',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../symfony/polyfill-php85',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/polyfill-uuid' => 
        array (
          'pretty_version' => 'v1.33.0',
          'version' => '1.33.0.0',
          'reference' => '21533be36c24be3f4b1669c4725c7d1d2bab4ae2',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../symfony/polyfill-uuid',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/process' => 
        array (
          'pretty_version' => 'v7.4.0',
          'version' => '7.4.0.0',
          'reference' => '7ca8dc2d0dcf4882658313aba8be5d9fd01026c8',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../symfony/process',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/routing' => 
        array (
          'pretty_version' => 'v7.4.0',
          'version' => '7.4.0.0',
          'reference' => '4720254cb2644a0b876233d258a32bf017330db7',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../symfony/routing',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/service-contracts' => 
        array (
          'pretty_version' => 'v3.6.1',
          'version' => '3.6.1.0',
          'reference' => '45112560a3ba2d715666a509a0bc9521d10b6c43',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../symfony/service-contracts',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/string' => 
        array (
          'pretty_version' => 'v8.0.0',
          'version' => '8.0.0.0',
          'reference' => 'f929eccf09531078c243df72398560e32fa4cf4f',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../symfony/string',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/translation' => 
        array (
          'pretty_version' => 'v8.0.0',
          'version' => '8.0.0.0',
          'reference' => '82ab368a6fca6358d995b6dd5c41590fb42c03e6',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../symfony/translation',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/translation-contracts' => 
        array (
          'pretty_version' => 'v3.6.1',
          'version' => '3.6.1.0',
          'reference' => '65a8bc82080447fae78373aa10f8d13b38338977',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../symfony/translation-contracts',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/translation-implementation' => 
        array (
          'dev_requirement' => false,
          'provided' => 
          array (
            0 => '2.3|3.0',
          ),
        ),
        'symfony/uid' => 
        array (
          'pretty_version' => 'v7.4.0',
          'version' => '7.4.0.0',
          'reference' => '2498e9f81b7baa206f44de583f2f48350b90142c',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../symfony/uid',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/var-dumper' => 
        array (
          'pretty_version' => 'v7.4.0',
          'version' => '7.4.0.0',
          'reference' => '41fd6c4ae28c38b294b42af6db61446594a0dece',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../symfony/var-dumper',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'symfony/yaml' => 
        array (
          'pretty_version' => 'v7.4.0',
          'version' => '7.4.0.0',
          'reference' => '6c84a4b55aee4cd02034d1c528e83f69ddf63810',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../symfony/yaml',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'ta-tikoma/phpunit-architecture-test' => 
        array (
          'pretty_version' => '0.8.5',
          'version' => '0.8.5.0',
          'reference' => 'cf6fb197b676ba716837c886baca842e4db29005',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../ta-tikoma/phpunit-architecture-test',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'theseer/tokenizer' => 
        array (
          'pretty_version' => '1.3.1',
          'version' => '1.3.1.0',
          'reference' => 'b7489ce515e168639d17feec34b8847c326b0b3c',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../theseer/tokenizer',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
        'tijsverkoyen/css-to-inline-styles' => 
        array (
          'pretty_version' => 'v2.3.0',
          'version' => '2.3.0.0',
          'reference' => '0d72ac1c00084279c1816675284073c5a337c20d',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../tijsverkoyen/css-to-inline-styles',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'tymon/jwt-auth' => 
        array (
          'pretty_version' => '2.2.1',
          'version' => '2.2.1.0',
          'reference' => '42381e56db1bf887c12e5302d11901d65cc74856',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../tymon/jwt-auth',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'vlucas/phpdotenv' => 
        array (
          'pretty_version' => 'v5.6.2',
          'version' => '5.6.2.0',
          'reference' => '24ac4c74f91ee2c193fa1aaa5c249cb0822809af',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../vlucas/phpdotenv',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'voku/portable-ascii' => 
        array (
          'pretty_version' => '2.0.3',
          'version' => '2.0.3.0',
          'reference' => 'b1d923f88091c6bf09699efcd7c8a1b1bfd7351d',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../voku/portable-ascii',
          'aliases' => 
          array (
          ),
          'dev_requirement' => false,
        ),
        'webmozart/assert' => 
        array (
          'pretty_version' => '1.12.1',
          'version' => '1.12.1.0',
          'reference' => '9be6926d8b485f55b9229203f962b51ed377ba68',
          'type' => 'library',
          'install_path' => '/Users/junlonglin/Herd/CrediBiz/vendor/composer/../webmozart/assert',
          'aliases' => 
          array (
          ),
          'dev_requirement' => true,
        ),
      ),
    ),
  ),
  'executedFilesHashes' => 
  array (
    '/Users/junlonglin/Herd/CrediBiz/vendor/larastan/larastan/bootstrap.php' => '28392079817075879815f110287690e80398fe5e',
    'phar:///Users/junlonglin/Herd/CrediBiz/vendor/phpstan/phpstan/phpstan.phar/stubs/runtime/Attribute85.php' => '123dcd45f03f2463904087a66bfe2bc139760df0',
    'phar:///Users/junlonglin/Herd/CrediBiz/vendor/phpstan/phpstan/phpstan.phar/stubs/runtime/ReflectionAttribute.php' => '0b4b78277eb6545955d2ce5e09bff28f1f8052c8',
    'phar:///Users/junlonglin/Herd/CrediBiz/vendor/phpstan/phpstan/phpstan.phar/stubs/runtime/ReflectionIntersectionType.php' => 'a3e6299b87ee5d407dae7651758edfa11a74cb11',
    'phar:///Users/junlonglin/Herd/CrediBiz/vendor/phpstan/phpstan/phpstan.phar/stubs/runtime/ReflectionUnionType.php' => '1b349aa997a834faeafe05fa21bc31cae22bf2e2',
  ),
  'phpExtensions' => 
  array (
    0 => 'Core',
    1 => 'FFI',
    2 => 'PDO',
    3 => 'Phar',
    4 => 'Reflection',
    5 => 'SPL',
    6 => 'SimpleXML',
    7 => 'Zend OPcache',
    8 => 'bcmath',
    9 => 'bz2',
    10 => 'calendar',
    11 => 'ctype',
    12 => 'curl',
    13 => 'date',
    14 => 'dba',
    15 => 'dom',
    16 => 'exif',
    17 => 'fileinfo',
    18 => 'filter',
    19 => 'ftp',
    20 => 'gd',
    21 => 'gettext',
    22 => 'gmp',
    23 => 'hash',
    24 => 'herd',
    25 => 'iconv',
    26 => 'imagick',
    27 => 'imap',
    28 => 'intl',
    29 => 'json',
    30 => 'ldap',
    31 => 'lexbor',
    32 => 'libxml',
    33 => 'mbstring',
    34 => 'mongodb',
    35 => 'mysqli',
    36 => 'mysqlnd',
    37 => 'openssl',
    38 => 'pcntl',
    39 => 'pcre',
    40 => 'pdo_mysql',
    41 => 'pdo_pgsql',
    42 => 'pdo_sqlite',
    43 => 'pgsql',
    44 => 'posix',
    45 => 'random',
    46 => 'readline',
    47 => 'redis',
    48 => 'session',
    49 => 'shmop',
    50 => 'soap',
    51 => 'sockets',
    52 => 'sodium',
    53 => 'sqlite3',
    54 => 'standard',
    55 => 'sysvmsg',
    56 => 'sysvsem',
    57 => 'sysvshm',
    58 => 'tokenizer',
    59 => 'uri',
    60 => 'xml',
    61 => 'xmlreader',
    62 => 'xmlwriter',
    63 => 'xsl',
    64 => 'zip',
    65 => 'zlib',
    66 => 'zstd',
  ),
  'stubFiles' => 
  array (
  ),
  'level' => '5',
),
	'projectExtensionFiles' => array (
),
	'errorsCallback' => static function (): array { return array (
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminDashboardController.php' => 
  array (
    0 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Relation \'employee\' is not found in App\\Models\\VCStatusChangeLog model.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminDashboardController.php',
       'line' => 84,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminDashboardController.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 84,
       'nodeType' => 'PhpParser\\Node\\Expr\\StaticCall',
       'identifier' => 'larastan.relationExistence',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminEmployeeController.php' => 
  array (
    0 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Relation \'issuedVCs\' is not found in App\\Models\\Employee model.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminEmployeeController.php',
       'line' => 56,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminEmployeeController.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 56,
       'nodeType' => 'PhpParser\\Node\\Expr\\MethodCall',
       'identifier' => 'larastan.relationExistence',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    1 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Relation \'activityLogs\' is not found in App\\Models\\Employee model.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminEmployeeController.php',
       'line' => 75,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminEmployeeController.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 75,
       'nodeType' => 'PhpParser\\Node\\Expr\\MethodCall',
       'identifier' => 'larastan.relationExistence',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    2 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Relation \'issuedVCs\' is not found in App\\Models\\Employee model.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminEmployeeController.php',
       'line' => 75,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminEmployeeController.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 75,
       'nodeType' => 'PhpParser\\Node\\Expr\\MethodCall',
       'identifier' => 'larastan.relationExistence',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    3 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Relation \'medicalLeaves\' is not found in App\\Models\\Employee model.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminEmployeeController.php',
       'line' => 75,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminEmployeeController.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 75,
       'nodeType' => 'PhpParser\\Node\\Expr\\MethodCall',
       'identifier' => 'larastan.relationExistence',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/AuthController.php' => 
  array (
    0 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Call to an undefined method App\\Models\\User::currentAccessToken().',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/AuthController.php',
       'line' => 161,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/AuthController.php',
       'traitFilePath' => NULL,
       'tip' => NULL,
       'nodeLine' => 161,
       'nodeType' => 'PhpParser\\Node\\Expr\\MethodCall',
       'identifier' => 'method.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php' => 
  array (
    0 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_vc_cid.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'line' => 225,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 225,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    1 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'line' => 237,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 237,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    2 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$position.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'line' => 239,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 239,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    3 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$department.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'line' => 240,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 240,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    4 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$company_name.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'line' => 241,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 241,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    5 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employment_start_date.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'line' => 242,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 242,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    6 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_vc_cid.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'line' => 314,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 314,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    7 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$holder_did.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'line' => 327,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 327,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    8 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'line' => 334,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 334,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    9 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'line' => 346,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 346,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    10 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'line' => 349,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 349,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    11 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'line' => 369,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 369,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    12 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'line' => 390,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 390,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    13 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'line' => 398,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 398,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    14 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'line' => 401,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 401,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    15 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'line' => 407,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 407,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    16 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'line' => 411,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 411,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/MedicalLeaveController.php' => 
  array (
    0 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/MedicalLeaveController.php',
       'line' => 70,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/MedicalLeaveController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 70,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    1 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/MedicalLeaveController.php',
       'line' => 84,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/MedicalLeaveController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 84,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    2 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/MedicalLeaveController.php',
       'line' => 96,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/MedicalLeaveController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 96,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    3 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/MedicalLeaveController.php',
       'line' => 108,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/MedicalLeaveController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 108,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    4 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/MedicalLeaveController.php',
       'line' => 115,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/MedicalLeaveController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 115,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    5 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/MedicalLeaveController.php',
       'line' => 199,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/MedicalLeaveController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 199,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    6 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/MedicalLeaveController.php',
       'line' => 217,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/MedicalLeaveController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 217,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    7 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/MedicalLeaveController.php',
       'line' => 218,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/MedicalLeaveController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 218,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    8 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/MedicalLeaveController.php',
       'line' => 261,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/MedicalLeaveController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 261,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php' => 
  array (
    0 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'line' => 41,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 41,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    1 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'line' => 130,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 130,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    2 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'line' => 204,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 204,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    3 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'line' => 230,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 230,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    4 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'line' => 301,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 301,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    5 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$holder_did.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'line' => 317,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 317,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    6 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'line' => 327,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 327,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    7 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'line' => 328,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 328,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    8 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'line' => 357,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 357,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    9 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'line' => 365,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 365,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    10 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'line' => 369,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 369,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    11 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'line' => 394,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 394,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    12 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'line' => 456,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 456,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    13 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'line' => 484,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 484,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    14 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'line' => 532,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 532,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    15 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'line' => 549,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 549,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    16 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'line' => 552,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 552,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
    17 => 
    \PHPStan\Analyser\Error::__set_state(array(
       'message' => 'Access to an undefined property App\\Models\\User::$employee_id.',
       'file' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'line' => 572,
       'canBeIgnored' => true,
       'filePath' => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
       'traitFilePath' => NULL,
       'tip' => 'Learn more: <fg=cyan>https://phpstan.org/blog/solving-phpstan-access-to-undefined-property</>',
       'nodeLine' => 572,
       'nodeType' => 'PhpParser\\Node\\Expr\\PropertyFetch',
       'identifier' => 'property.notFound',
       'metadata' => 
      array (
      ),
       'fixedErrorDiff' => NULL,
    )),
  ),
); },
	'locallyIgnoredErrorsCallback' => static function (): array { return array (
); },
	'linesToIgnore' => array (
),
	'unmatchedLineIgnores' => array (
),
	'collectedDataCallback' => static function (): array { return array (
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminDashboardController.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 143,
      ),
      1 => 
      array (
        0 => 'App\\Models\\ActivityLog',
        1 => 'logVCRevoke',
        2 => 163,
      ),
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminEmployeeController.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 165,
      ),
      1 => 
      array (
        0 => 'App\\Models\\ActivityLog',
        1 => 'logVCRevoke',
        2 => 175,
      ),
      2 => 
      array (
        0 => 'App\\Models\\ActivityLog',
        1 => 'logVCRevoke',
        2 => 259,
      ),
      3 => 
      array (
        0 => 'App\\Models\\ActivityLog',
        1 => 'logVCRevoke',
        2 => 350,
      ),
      4 => 
      array (
        0 => 'App\\Models\\ActivityLog',
        1 => 'log',
        2 => 377,
      ),
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminMedicalLeaveController.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\ActivityLog',
        1 => 'log',
        2 => 120,
      ),
      1 => 
      array (
        0 => 'App\\Models\\ActivityLog',
        1 => 'log',
        2 => 195,
      ),
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminVisitorParkingController.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\ActivityLog',
        1 => 'log',
        2 => 59,
      ),
      1 => 
      array (
        0 => 'App\\Models\\ActivityLog',
        1 => 'log',
        2 => 243,
      ),
      2 => 
      array (
        0 => 'App\\Models\\ActivityLog',
        1 => 'log',
        2 => 311,
      ),
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ApplicationController.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\ActivityLog',
        1 => 'logVPVerification',
        2 => 127,
      ),
      1 => 
      array (
        0 => 'App\\Models\\ActivityLog',
        1 => 'log',
        2 => 140,
      ),
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/AuthController.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 103,
      ),
      1 => 
      array (
        0 => 'App\\Models\\ActivityLog',
        1 => 'logVPVerification',
        2 => 111,
      ),
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 179,
      ),
      1 => 
      array (
        0 => 'App\\Models\\ActivityLog',
        1 => 'logVCIssue',
        2 => 187,
      ),
      2 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 333,
      ),
      3 => 
      array (
        0 => 'App\\Models\\ActivityLog',
        1 => 'logVCRevoke',
        2 => 345,
      ),
      4 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 368,
      ),
      5 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 389,
      ),
      6 => 
      array (
        0 => 'App\\Models\\ActivityLog',
        1 => 'logVCRevoke',
        2 => 397,
      ),
      7 => 
      array (
        0 => 'App\\Models\\ActivityLog',
        1 => 'logVCIssue',
        2 => 406,
      ),
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/MedicalLeaveController.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Controllers\\MedicalLeaveController',
        1 => 'parseClaimsToArray',
        2 => 'App\\Http\\Controllers\\MedicalLeaveController',
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\ActivityLog',
        1 => 'logVPVerification',
        2 => 111,
      ),
      1 => 
      array (
        0 => 'App\\Models\\ActivityLog',
        1 => 'log',
        2 => 216,
      ),
      2 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'updateOrCreate',
        2 => 310,
      ),
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Http\\Controllers\\ParkingPermitController',
        1 => 'parseClaimsToArray',
        2 => 'App\\Http\\Controllers\\ParkingPermitController',
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 240,
      ),
      1 => 
      array (
        0 => 'App\\Models\\ActivityLog',
        1 => 'log',
        2 => 326,
      ),
      2 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 356,
      ),
      3 => 
      array (
        0 => 'App\\Models\\ActivityLog',
        1 => 'logVCIssue',
        2 => 364,
      ),
      4 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 471,
      ),
      5 => 
      array (
        0 => 'App\\Models\\ActivityLog',
        1 => 'log',
        2 => 481,
      ),
      6 => 
      array (
        0 => 'App\\Models\\ActivityLog',
        1 => 'logVCRevoke',
        2 => 548,
      ),
      7 => 
      array (
        0 => 'App\\Models\\ActivityLog',
        1 => 'log',
        2 => 569,
      ),
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/VisitorParkingController.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 157,
      ),
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Models/Employee.php' => 
  array (
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Laravel\\Sanctum\\HasApiTokens',
      ),
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Models/User.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\User',
        1 => 'casts',
        2 => 'App\\Models\\User',
      ),
    ),
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
        1 => 'Illuminate\\Notifications\\Notifiable',
      ),
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Models/VPVerificationLog.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 37,
      ),
      1 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 51,
      ),
      2 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 68,
      ),
      3 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'create',
        2 => 94,
      ),
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Models/VisitorParkingApplication.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\VisitorParkingApplication',
        1 => 'getStatusTextAttribute',
        2 => 'App\\Models\\VisitorParkingApplication',
      ),
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Services/TWDIWIssuerService.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Services\\TWDIWIssuerService',
        1 => 'sanitizeHeaders',
        2 => 'App\\Services\\TWDIWIssuerService',
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\ApiLog',
        1 => 'logApiCall',
        2 => 76,
      ),
      1 => 
      array (
        0 => 'App\\Models\\ApiLog',
        1 => 'logApiCall',
        2 => 110,
      ),
      2 => 
      array (
        0 => 'App\\Models\\ApiLog',
        1 => 'logApiCall',
        2 => 152,
      ),
      3 => 
      array (
        0 => 'App\\Models\\ApiLog',
        1 => 'logApiCall',
        2 => 220,
      ),
      4 => 
      array (
        0 => 'App\\Models\\ApiLog',
        1 => 'logApiCall',
        2 => 270,
      ),
      5 => 
      array (
        0 => 'App\\Models\\ApiLog',
        1 => 'logApiCall',
        2 => 296,
      ),
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Services/TWDIWVerifierService.php' => 
  array (
    'PHPStan\\Rules\\DeadCode\\MethodWithoutImpurePointsCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Services\\TWDIWVerifierService',
        1 => 'sanitizeHeaders',
        2 => 'App\\Services\\TWDIWVerifierService',
      ),
    ),
    'PHPStan\\Rules\\DeadCode\\PossiblyPureStaticCallCollector' => 
    array (
      0 => 
      array (
        0 => 'App\\Models\\ApiLog',
        1 => 'logApiCall',
        2 => 54,
      ),
      1 => 
      array (
        0 => 'App\\Models\\ApiLog',
        1 => 'logApiCall',
        2 => 87,
      ),
      2 => 
      array (
        0 => 'App\\Models\\ApiLog',
        1 => 'logApiCall',
        2 => 139,
      ),
      3 => 
      array (
        0 => 'App\\Models\\ApiLog',
        1 => 'logApiCall',
        2 => 173,
      ),
      4 => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'updateOrCreate',
        2 => 190,
      ),
      5 => 
      array (
        0 => 'App\\Models\\ApiLog',
        1 => 'logApiCall',
        2 => 212,
      ),
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/database/seeders/DatabaseSeeder.php' => 
  array (
    'PHPStan\\Rules\\Traits\\TraitUseCollector' => 
    array (
      0 => 
      array (
        0 => 'Illuminate\\Database\\Console\\Seeds\\WithoutModelEvents',
      ),
    ),
  ),
); },
	'dependencies' => array (
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminApiLogController.php' => 
  array (
    'fileHash' => 'd93d2bf2af9cdbaa5020600fe0e14a3190b8c9ae',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminDashboardController.php' => 
  array (
    'fileHash' => '0be8687a58b829772c6ddade4d6dfe91fe0929b0',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminEmployeeController.php' => 
  array (
    'fileHash' => '9d7606f05ee5cd33dc3523d75bcd9d22639d76d0',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminMedicalLeaveController.php' => 
  array (
    'fileHash' => 'd0f3a61022fedf23abd03fd768e42f4dbaf2beca',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminVisitorParkingController.php' => 
  array (
    'fileHash' => '499cb4b048241dad450ad05dde2f8ccb443d8f9a',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ApplicationController.php' => 
  array (
    'fileHash' => 'd6c79dc7ef75b1d594a0bff1fba532b838f788af',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/AuthController.php' => 
  array (
    'fileHash' => '980ef833c1428798655152deaca3524a8eac7183',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Controller.php' => 
  array (
    'fileHash' => 'a33a5105f92c73a309c9f8a549905dcdf6dccbae',
    'dependentFiles' => 
    array (
      0 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminApiLogController.php',
      1 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminDashboardController.php',
      2 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminEmployeeController.php',
      3 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminMedicalLeaveController.php',
      4 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminVisitorParkingController.php',
      5 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ApplicationController.php',
      6 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/AuthController.php',
      7 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
      8 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/MedicalLeaveController.php',
      9 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
      10 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/VPMachineController.php',
      11 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/VisitorParkingController.php',
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php' => 
  array (
    'fileHash' => '80dc3cde2ee8d38661c285c1147309115b741d4f',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/MedicalLeaveController.php' => 
  array (
    'fileHash' => '82be293e12a067d11b029acd82965e589d07914d',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php' => 
  array (
    'fileHash' => 'beace67f04cc44b31b2c2925bf054d05be1930d6',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/VPMachineController.php' => 
  array (
    'fileHash' => 'fad582d5b5996d5cc41e0ff0df3ce0f5b78e6ad8',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/VisitorParkingController.php' => 
  array (
    'fileHash' => 'a610417e2fee923bae1bca516c1a9dcfe6dc22bf',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Models/ActivityLog.php' => 
  array (
    'fileHash' => 'd609aea2988f434c954f89c25aaf22cd6725018f',
    'dependentFiles' => 
    array (
      0 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminDashboardController.php',
      1 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminEmployeeController.php',
      2 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminMedicalLeaveController.php',
      3 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminVisitorParkingController.php',
      4 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ApplicationController.php',
      5 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/AuthController.php',
      6 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
      7 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/MedicalLeaveController.php',
      8 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
      9 => '/Users/junlonglin/Herd/CrediBiz/app/Models/Employee.php',
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Models/ApiLog.php' => 
  array (
    'fileHash' => '45a1cbc427b2993d4067c442d35ea28e0210c2d7',
    'dependentFiles' => 
    array (
      0 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminApiLogController.php',
      1 => '/Users/junlonglin/Herd/CrediBiz/app/Services/TWDIWIssuerService.php',
      2 => '/Users/junlonglin/Herd/CrediBiz/app/Services/TWDIWVerifierService.php',
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Models/Employee.php' => 
  array (
    'fileHash' => 'f29dfc529fe2bb263665df3891368c782400c4ea',
    'dependentFiles' => 
    array (
      0 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminDashboardController.php',
      1 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminEmployeeController.php',
      2 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminVisitorParkingController.php',
      3 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ApplicationController.php',
      4 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/AuthController.php',
      5 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
      6 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
      7 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/VPMachineController.php',
      8 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/VisitorParkingController.php',
      9 => '/Users/junlonglin/Herd/CrediBiz/app/Models/ActivityLog.php',
      10 => '/Users/junlonglin/Herd/CrediBiz/app/Models/EmployeeLoginLog.php',
      11 => '/Users/junlonglin/Herd/CrediBiz/app/Models/IssuedVC.php',
      12 => '/Users/junlonglin/Herd/CrediBiz/app/Models/MedicalLeave.php',
      13 => '/Users/junlonglin/Herd/CrediBiz/app/Models/ParkingPermit.php',
      14 => '/Users/junlonglin/Herd/CrediBiz/app/Models/ParkingPermitVehicle.php',
      15 => '/Users/junlonglin/Herd/CrediBiz/app/Models/VCStatusChangeLog.php',
      16 => '/Users/junlonglin/Herd/CrediBiz/app/Models/VPVerificationResult.php',
      17 => '/Users/junlonglin/Herd/CrediBiz/app/Models/VisitorParkingApplication.php',
      18 => '/Users/junlonglin/Herd/CrediBiz/config/auth.php',
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Models/EmployeeLoginLog.php' => 
  array (
    'fileHash' => '2fe0e4547e756c3076f5240d4d82b06066f2a421',
    'dependentFiles' => 
    array (
      0 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminDashboardController.php',
      1 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/AuthController.php',
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Models/IssuedVC.php' => 
  array (
    'fileHash' => '3ea5ef3b03d84f84252357b52c75775a4fe15956',
    'dependentFiles' => 
    array (
      0 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminDashboardController.php',
      1 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminEmployeeController.php',
      2 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
      3 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
      4 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/VisitorParkingController.php',
      5 => '/Users/junlonglin/Herd/CrediBiz/app/Models/Employee.php',
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Models/MedicalLeave.php' => 
  array (
    'fileHash' => 'c4589e0eb074b838e0fee6d1c115fda97bd2f4df',
    'dependentFiles' => 
    array (
      0 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminDashboardController.php',
      1 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminMedicalLeaveController.php',
      2 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/MedicalLeaveController.php',
      3 => '/Users/junlonglin/Herd/CrediBiz/app/Models/Employee.php',
      4 => '/Users/junlonglin/Herd/CrediBiz/app/Models/VPVerificationResult.php',
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Models/ParkingPermit.php' => 
  array (
    'fileHash' => '98f049d321c8701d2e7b43550ae1ae5059744ac8',
    'dependentFiles' => 
    array (
      0 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
      1 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/VPMachineController.php',
      2 => '/Users/junlonglin/Herd/CrediBiz/app/Models/ParkingPermitVehicle.php',
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Models/ParkingPermitVehicle.php' => 
  array (
    'fileHash' => '0afd36e9be4318917d3d60ad25df2e59cfc691c6',
    'dependentFiles' => 
    array (
      0 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
      1 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/VPMachineController.php',
      2 => '/Users/junlonglin/Herd/CrediBiz/app/Models/ParkingPermit.php',
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Models/User.php' => 
  array (
    'fileHash' => '0de556dcaed737c421ea5b9b029f7cc1445768cf',
    'dependentFiles' => 
    array (
      0 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/AuthController.php',
      1 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
      2 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/MedicalLeaveController.php',
      3 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
      4 => '/Users/junlonglin/Herd/CrediBiz/config/auth.php',
      5 => '/Users/junlonglin/Herd/CrediBiz/database/factories/UserFactory.php',
      6 => '/Users/junlonglin/Herd/CrediBiz/database/seeders/DatabaseSeeder.php',
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Models/VCStatusChangeLog.php' => 
  array (
    'fileHash' => '10bdcae1c5b6ff8b99814942bfe25dc4c73c56d0',
    'dependentFiles' => 
    array (
      0 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminDashboardController.php',
      1 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminEmployeeController.php',
      2 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Models/VPMachine.php' => 
  array (
    'fileHash' => '0d9ce432e919df52aa36ab20d0c95e896d68eb92',
    'dependentFiles' => 
    array (
      0 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/VPMachineController.php',
      1 => '/Users/junlonglin/Herd/CrediBiz/app/Models/VPVerificationLog.php',
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Models/VPVerificationLog.php' => 
  array (
    'fileHash' => '3a1ef7755a651a8525e6b1115d7a43236d01c898',
    'dependentFiles' => 
    array (
      0 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/VPMachineController.php',
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Models/VPVerificationResult.php' => 
  array (
    'fileHash' => '08eeaa7bb616cc93fd3f5018cda386870ce007f7',
    'dependentFiles' => 
    array (
      0 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminDashboardController.php',
      1 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/MedicalLeaveController.php',
      2 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
      3 => '/Users/junlonglin/Herd/CrediBiz/app/Models/EmployeeLoginLog.php',
      4 => '/Users/junlonglin/Herd/CrediBiz/app/Models/MedicalLeave.php',
      5 => '/Users/junlonglin/Herd/CrediBiz/app/Services/TWDIWVerifierService.php',
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Models/VisitorParkingApplication.php' => 
  array (
    'fileHash' => '93fe12ec8b52ce28b1bb325229680e7fb8ec27ed',
    'dependentFiles' => 
    array (
      0 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminVisitorParkingController.php',
      1 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/VisitorParkingController.php',
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Providers/AppServiceProvider.php' => 
  array (
    'fileHash' => 'b05d06e9cb0c835b310d233e03a8ba9e97dd14d7',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Rules/RocIdNumber.php' => 
  array (
    'fileHash' => '7448bfd80b7a202cc24d823494096781cd23f5bc',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Services/TWDIWIssuerService.php' => 
  array (
    'fileHash' => '843771c6da107b4fdf1b17513156935879857a45',
    'dependentFiles' => 
    array (
      0 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminDashboardController.php',
      1 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminEmployeeController.php',
      2 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminVisitorParkingController.php',
      3 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php',
      4 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
      5 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/VisitorParkingController.php',
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Services/TWDIWVerifierService.php' => 
  array (
    'fileHash' => '3811ac0507e605d39cf4fd991b85f41305e20591',
    'dependentFiles' => 
    array (
      0 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ApplicationController.php',
      1 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/AuthController.php',
      2 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/MedicalLeaveController.php',
      3 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php',
      4 => '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/VPMachineController.php',
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/config/app.php' => 
  array (
    'fileHash' => '19475397679ea26973e1134595e60a6c9acb40ba',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/config/auth.php' => 
  array (
    'fileHash' => 'dd58f914667ad0fb6f6615e191861bef9fd445d6',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/config/cache.php' => 
  array (
    'fileHash' => 'cd1d6925c3548f3081f827bcce8f9b2c5522795e',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/config/database.php' => 
  array (
    'fileHash' => '4d7bb78ce43539e75ede1418a37fd5b9cecbb718',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/config/filesystems.php' => 
  array (
    'fileHash' => '6e1e66753542ecbccfe730cfee0d623723be2986',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/config/logging.php' => 
  array (
    'fileHash' => 'f163e17e3d43b2aa18f20994b2d26c2ccabd5abc',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/config/mail.php' => 
  array (
    'fileHash' => '55990e37cb337eee513173e5c48479cbb1e5202e',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/config/queue.php' => 
  array (
    'fileHash' => 'd010c040a947e792dee55b6c5a74f14ba7f656d8',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/config/sanctum.php' => 
  array (
    'fileHash' => '50c35e92c94e5a3e9c3790db95047bb8fbad2dd0',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/config/services.php' => 
  array (
    'fileHash' => '463872f0a29f19e9533b60e4be80fb764cf58d4d',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/config/session.php' => 
  array (
    'fileHash' => 'a0ce1b173c09908a3d698b26372566c604844a94',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/database/factories/UserFactory.php' => 
  array (
    'fileHash' => '7ac74334b97dded2308b4265ca46014b317a82f9',
    'dependentFiles' => 
    array (
      0 => '/Users/junlonglin/Herd/CrediBiz/app/Models/User.php',
      1 => '/Users/junlonglin/Herd/CrediBiz/database/seeders/DatabaseSeeder.php',
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/database/migrations/0001_01_01_000000_create_users_table.php' => 
  array (
    'fileHash' => 'c83722f2f43dc31195e37312e72524af995c15a9',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/database/migrations/0001_01_01_000001_create_cache_table.php' => 
  array (
    'fileHash' => '1e63143baede25661ec2075259ba517cbf2c2400',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/database/migrations/0001_01_01_000002_create_jobs_table.php' => 
  array (
    'fileHash' => '61d635023428eaa5cc6f27e5b7f9683817125a50',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/database/migrations/2025_11_08_073711_create_personal_access_tokens_table.php' => 
  array (
    'fileHash' => '44b07540293a82d1ac4400042d0b2ce33ca8d162',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/database/migrations/2025_11_09_030756_create_employees_table.php' => 
  array (
    'fileHash' => '8f737b504f3dc8b73a8964d53ef987bdb448f14f',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/database/migrations/2025_11_09_050844_create_vp_verification_results_table.php' => 
  array (
    'fileHash' => '268a05fa719c56e800cc23bbfa4da9b23c371d86',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/database/migrations/2025_11_09_053759_remove_unused_fields_from_employees_table.php' => 
  array (
    'fileHash' => '678e4ba8f7a966f60ac87c8a23c59f10435a5dc9',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/database/migrations/2025_11_09_054410_remove_student_id_and_toeic_institution_from_employees.php' => 
  array (
    'fileHash' => '312d5da3e31c23459b9810c7a78083ae0f4e55e9',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/database/migrations/2025_11_09_060008_create_employee_login_logs_table.php' => 
  array (
    'fileHash' => '4d5fece7c58049b672ae4b450236ebbbc554869e',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/database/migrations/2025_11_09_060137_create_issued_vcs_table.php' => 
  array (
    'fileHash' => '3905cc1a930bb4e5233d4f54d65496430d0ee754',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/database/migrations/2025_11_09_065405_add_last_login_at_to_employees_table.php' => 
  array (
    'fileHash' => 'b64f1f325e30ab5a774e5558ed456750a3f63baf',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/database/migrations/2025_11_09_070030_create_vc_status_change_logs_table.php' => 
  array (
    'fileHash' => 'c0beae03ef961d89eb4b3f7d5128b70f2a665eee',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/database/migrations/2025_11_09_073656_add_vc_expiry_date_to_employees_table.php' => 
  array (
    'fileHash' => '77a902f000d1bc2316a0ea12df09b1d03abe733e',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/database/migrations/2025_11_10_135221_add_employee_fields_to_vp_verification_results_table.php' => 
  array (
    'fileHash' => '4451d57c04a4f37d2b63d9a70e907ed99808551a',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/database/migrations/2025_11_10_135225_create_medical_leaves_table.php' => 
  array (
    'fileHash' => 'fc3d4e71a0e03699ca42953b399a213cccbb3827',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/database/migrations/2025_11_10_144719_create_activity_logs_table.php' => 
  array (
    'fileHash' => '7e3408e7bc1c09495508aecd1eccb8f130aded6e',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/database/migrations/2025_11_22_222558_add_approval_fields_to_medical_leaves_table.php' => 
  array (
    'fileHash' => '297da4b009efa652abb2d252faa5060371d7a397',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/database/migrations/2025_11_22_223247_add_resignation_fields_to_employees_table.php' => 
  array (
    'fileHash' => '23354d0cb21c3be6cb6780aaff5ad97ae4fa523b',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/database/migrations/2025_11_22_230459_create_api_logs_table.php' => 
  array (
    'fileHash' => '65f802c501f4cdbed049a257ded778bd89a6231a',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/database/migrations/2025_11_23_023537_add_holder_did_to_employees_table.php' => 
  array (
    'fileHash' => '3e0aeb313b90a6cc5f96f8d5fc41f8fa6d6f67d5',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/database/migrations/2025_11_23_082800_create_parking_permits_table.php' => 
  array (
    'fileHash' => '3cf08ba4fdfd387115201b7a87714a4f01346626',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/database/migrations/2025_11_23_082801_create_parking_permit_vehicles_table.php' => 
  array (
    'fileHash' => '8e54497513f100eb9b9090feddcf22f685528aa9',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/database/migrations/2025_11_23_083508_create_visitor_parking_applications_table.php' => 
  array (
    'fileHash' => '97b5186790b94be015b61339ba76f1188a96a6bb',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/database/migrations/2025_11_23_150121_add_name_to_visitor_parking_applications_table.php' => 
  array (
    'fileHash' => 'd7c10ef928f7dacf85998823886d476b656753ec',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/database/migrations/2025_11_24_035206_create_vp_machines_table.php' => 
  array (
    'fileHash' => 'b3c9e0dd05ddfb6421a68188dd69a453ccee7ba7',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/database/migrations/2025_11_24_035305_create_vp_verification_logs_table.php' => 
  array (
    'fileHash' => '41c408078a686c979abbe90f6b876472473cfd40',
    'dependentFiles' => 
    array (
    ),
  ),
  '/Users/junlonglin/Herd/CrediBiz/database/seeders/DatabaseSeeder.php' => 
  array (
    'fileHash' => 'b7baaa4ff3da53e2766554dd985b74f2d68424a2',
    'dependentFiles' => 
    array (
    ),
  ),
),
	'exportedNodesCallback' => static function (): array { return array (
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminApiLogController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\Admin\\AdminApiLogController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'index',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 取得 API Logs 列表
     */',
             'namespace' => 'App\\Http\\Controllers\\Admin',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'apilog' => 'App\\Models\\ApiLog',
              'jsonresponse' => 'Illuminate\\Http\\JsonResponse',
              'request' => 'Illuminate\\Http\\Request',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'show',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 取得單一 API Log 詳情
     */',
             'namespace' => 'App\\Http\\Controllers\\Admin',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'apilog' => 'App\\Models\\ApiLog',
              'jsonresponse' => 'Illuminate\\Http\\JsonResponse',
              'request' => 'Illuminate\\Http\\Request',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'statistics',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 取得統計資料
     */',
             'namespace' => 'App\\Http\\Controllers\\Admin',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'apilog' => 'App\\Models\\ApiLog',
              'jsonresponse' => 'Illuminate\\Http\\JsonResponse',
              'request' => 'Illuminate\\Http\\Request',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'cleanup',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 清理舊的 API Logs
     */',
             'namespace' => 'App\\Http\\Controllers\\Admin',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'apilog' => 'App\\Models\\ApiLog',
              'jsonresponse' => 'Illuminate\\Http\\JsonResponse',
              'request' => 'Illuminate\\Http\\Request',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Http\\JsonResponse',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminDashboardController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\Admin\\AdminDashboardController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'index',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 顯示後台主頁面
     *
     * @return \\Illuminate\\Contracts\\View\\View
     */',
             'namespace' => 'App\\Http\\Controllers\\Admin',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'employee' => 'App\\Models\\Employee',
              'employeeloginlog' => 'App\\Models\\EmployeeLoginLog',
              'issuedvc' => 'App\\Models\\IssuedVC',
              'medicalleave' => 'App\\Models\\MedicalLeave',
              'vpverificationresult' => 'App\\Models\\VPVerificationResult',
              'vcstatuschangelog' => 'App\\Models\\VCStatusChangeLog',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Contracts\\View\\View',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getLoginLogs',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 取得登入記錄
     */',
             'namespace' => 'App\\Http\\Controllers\\Admin',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'employee' => 'App\\Models\\Employee',
              'employeeloginlog' => 'App\\Models\\EmployeeLoginLog',
              'issuedvc' => 'App\\Models\\IssuedVC',
              'medicalleave' => 'App\\Models\\MedicalLeave',
              'vpverificationresult' => 'App\\Models\\VPVerificationResult',
              'vcstatuschangelog' => 'App\\Models\\VCStatusChangeLog',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getVCIssuedLogs',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 取得 VC 發行記錄
     */',
             'namespace' => 'App\\Http\\Controllers\\Admin',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'employee' => 'App\\Models\\Employee',
              'employeeloginlog' => 'App\\Models\\EmployeeLoginLog',
              'issuedvc' => 'App\\Models\\IssuedVC',
              'medicalleave' => 'App\\Models\\MedicalLeave',
              'vpverificationresult' => 'App\\Models\\VPVerificationResult',
              'vcstatuschangelog' => 'App\\Models\\VCStatusChangeLog',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getVPVerificationLogs',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 取得 VP 驗證記錄
     */',
             'namespace' => 'App\\Http\\Controllers\\Admin',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'employee' => 'App\\Models\\Employee',
              'employeeloginlog' => 'App\\Models\\EmployeeLoginLog',
              'issuedvc' => 'App\\Models\\IssuedVC',
              'medicalleave' => 'App\\Models\\MedicalLeave',
              'vpverificationresult' => 'App\\Models\\VPVerificationResult',
              'vcstatuschangelog' => 'App\\Models\\VCStatusChangeLog',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getVCStatusChangeLogs',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 取得 VC 狀態變更記錄
     */',
             'namespace' => 'App\\Http\\Controllers\\Admin',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'employee' => 'App\\Models\\Employee',
              'employeeloginlog' => 'App\\Models\\EmployeeLoginLog',
              'issuedvc' => 'App\\Models\\IssuedVC',
              'medicalleave' => 'App\\Models\\MedicalLeave',
              'vpverificationresult' => 'App\\Models\\VPVerificationResult',
              'vcstatuschangelog' => 'App\\Models\\VCStatusChangeLog',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getEmployees',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 取得員工列表
     */',
             'namespace' => 'App\\Http\\Controllers\\Admin',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'employee' => 'App\\Models\\Employee',
              'employeeloginlog' => 'App\\Models\\EmployeeLoginLog',
              'issuedvc' => 'App\\Models\\IssuedVC',
              'medicalleave' => 'App\\Models\\MedicalLeave',
              'vpverificationresult' => 'App\\Models\\VPVerificationResult',
              'vcstatuschangelog' => 'App\\Models\\VCStatusChangeLog',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'revokeCredential',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 撤銷員工憑證
     */',
             'namespace' => 'App\\Http\\Controllers\\Admin',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'employee' => 'App\\Models\\Employee',
              'employeeloginlog' => 'App\\Models\\EmployeeLoginLog',
              'issuedvc' => 'App\\Models\\IssuedVC',
              'medicalleave' => 'App\\Models\\MedicalLeave',
              'vpverificationresult' => 'App\\Models\\VPVerificationResult',
              'vcstatuschangelog' => 'App\\Models\\VCStatusChangeLog',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'issuerService',
               'type' => 'App\\Services\\TWDIWIssuerService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'reissueCredential',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 為員工重新發行憑證（管理員操作）
     */',
             'namespace' => 'App\\Http\\Controllers\\Admin',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'employee' => 'App\\Models\\Employee',
              'employeeloginlog' => 'App\\Models\\EmployeeLoginLog',
              'issuedvc' => 'App\\Models\\IssuedVC',
              'medicalleave' => 'App\\Models\\MedicalLeave',
              'vpverificationresult' => 'App\\Models\\VPVerificationResult',
              'vcstatuschangelog' => 'App\\Models\\VCStatusChangeLog',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'issuerService',
               'type' => 'App\\Services\\TWDIWIssuerService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        8 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getMedicalLeaves',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 取得病假申請記錄
     */',
             'namespace' => 'App\\Http\\Controllers\\Admin',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'employee' => 'App\\Models\\Employee',
              'employeeloginlog' => 'App\\Models\\EmployeeLoginLog',
              'issuedvc' => 'App\\Models\\IssuedVC',
              'medicalleave' => 'App\\Models\\MedicalLeave',
              'vpverificationresult' => 'App\\Models\\VPVerificationResult',
              'vcstatuschangelog' => 'App\\Models\\VCStatusChangeLog',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        9 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getMedicalLeaveVPLogs',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 取得病假 VP 驗證記錄
     */',
             'namespace' => 'App\\Http\\Controllers\\Admin',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'employee' => 'App\\Models\\Employee',
              'employeeloginlog' => 'App\\Models\\EmployeeLoginLog',
              'issuedvc' => 'App\\Models\\IssuedVC',
              'medicalleave' => 'App\\Models\\MedicalLeave',
              'vpverificationresult' => 'App\\Models\\VPVerificationResult',
              'vcstatuschangelog' => 'App\\Models\\VCStatusChangeLog',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        10 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getActivityLogs',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 取得活動日誌
     */',
             'namespace' => 'App\\Http\\Controllers\\Admin',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'employee' => 'App\\Models\\Employee',
              'employeeloginlog' => 'App\\Models\\EmployeeLoginLog',
              'issuedvc' => 'App\\Models\\IssuedVC',
              'medicalleave' => 'App\\Models\\MedicalLeave',
              'vpverificationresult' => 'App\\Models\\VPVerificationResult',
              'vcstatuschangelog' => 'App\\Models\\VCStatusChangeLog',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        11 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getActivityStats',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 取得活動日誌統計
     */',
             'namespace' => 'App\\Http\\Controllers\\Admin',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'employee' => 'App\\Models\\Employee',
              'employeeloginlog' => 'App\\Models\\EmployeeLoginLog',
              'issuedvc' => 'App\\Models\\IssuedVC',
              'medicalleave' => 'App\\Models\\MedicalLeave',
              'vpverificationresult' => 'App\\Models\\VPVerificationResult',
              'vcstatuschangelog' => 'App\\Models\\VCStatusChangeLog',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminEmployeeController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\Admin\\AdminEmployeeController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'index',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 取得員工列表（含搜尋、篩選）
     */',
             'namespace' => 'App\\Http\\Controllers\\Admin',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'employee' => 'App\\Models\\Employee',
              'issuedvc' => 'App\\Models\\IssuedVC',
              'vcstatuschangelog' => 'App\\Models\\VCStatusChangeLog',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
              'db' => 'Illuminate\\Support\\Facades\\DB',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'show',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 取得員工詳細資料
     */',
             'namespace' => 'App\\Http\\Controllers\\Admin',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'employee' => 'App\\Models\\Employee',
              'issuedvc' => 'App\\Models\\IssuedVC',
              'vcstatuschangelog' => 'App\\Models\\VCStatusChangeLog',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
              'db' => 'Illuminate\\Support\\Facades\\DB',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'employeeId',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'revokeVC',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Revoke 特定 VC
     */',
             'namespace' => 'App\\Http\\Controllers\\Admin',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'employee' => 'App\\Models\\Employee',
              'issuedvc' => 'App\\Models\\IssuedVC',
              'vcstatuschangelog' => 'App\\Models\\VCStatusChangeLog',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
              'db' => 'Illuminate\\Support\\Facades\\DB',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'issuerService',
               'type' => 'App\\Services\\TWDIWIssuerService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'reissueVC',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 換發員工 VC（管理員操作）
     */',
             'namespace' => 'App\\Http\\Controllers\\Admin',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'employee' => 'App\\Models\\Employee',
              'issuedvc' => 'App\\Models\\IssuedVC',
              'vcstatuschangelog' => 'App\\Models\\VCStatusChangeLog',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
              'db' => 'Illuminate\\Support\\Facades\\DB',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'issuerService',
               'type' => 'App\\Services\\TWDIWIssuerService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'resign',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 員工離職處理（revoke 所有 VC）
     */',
             'namespace' => 'App\\Http\\Controllers\\Admin',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'employee' => 'App\\Models\\Employee',
              'issuedvc' => 'App\\Models\\IssuedVC',
              'vcstatuschangelog' => 'App\\Models\\VCStatusChangeLog',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
              'db' => 'Illuminate\\Support\\Facades\\DB',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'issuerService',
               'type' => 'App\\Services\\TWDIWIssuerService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'update',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 更新員工資料
     */',
             'namespace' => 'App\\Http\\Controllers\\Admin',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'employee' => 'App\\Models\\Employee',
              'issuedvc' => 'App\\Models\\IssuedVC',
              'vcstatuschangelog' => 'App\\Models\\VCStatusChangeLog',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
              'db' => 'Illuminate\\Support\\Facades\\DB',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'employeeId',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminMedicalLeaveController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\Admin\\AdminMedicalLeaveController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'index',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 取得病假申請列表（含搜尋、篩選）
     */',
             'namespace' => 'App\\Http\\Controllers\\Admin',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'medicalleave' => 'App\\Models\\MedicalLeave',
              'activitylog' => 'App\\Models\\ActivityLog',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'show',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 取得病假申請詳細資料（含 VP 驗證資料）
     */',
             'namespace' => 'App\\Http\\Controllers\\Admin',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'medicalleave' => 'App\\Models\\MedicalLeave',
              'activitylog' => 'App\\Models\\ActivityLog',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'approve',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 審核病假申請（通過）
     */',
             'namespace' => 'App\\Http\\Controllers\\Admin',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'medicalleave' => 'App\\Models\\MedicalLeave',
              'activitylog' => 'App\\Models\\ActivityLog',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'reject',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 審核病假申請（不通過）
     */',
             'namespace' => 'App\\Http\\Controllers\\Admin',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'medicalleave' => 'App\\Models\\MedicalLeave',
              'activitylog' => 'App\\Models\\ActivityLog',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'statistics',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 取得統計資料
     */',
             'namespace' => 'App\\Http\\Controllers\\Admin',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'medicalleave' => 'App\\Models\\MedicalLeave',
              'activitylog' => 'App\\Models\\ActivityLog',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminVisitorParkingController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\Admin\\AdminVisitorParkingController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'store',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 管理員代為申請訪客停車證
     */',
             'namespace' => 'App\\Http\\Controllers\\Admin',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'visitorparkingapplication' => 'App\\Models\\VisitorParkingApplication',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'index',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 列出所有訪客停車證申請
     */',
             'namespace' => 'App\\Http\\Controllers\\Admin',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'visitorparkingapplication' => 'App\\Models\\VisitorParkingApplication',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'show',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 查看單一申請詳情
     */',
             'namespace' => 'App\\Http\\Controllers\\Admin',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'visitorparkingapplication' => 'App\\Models\\VisitorParkingApplication',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'approve',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 核准申請並發行停車證 VC
     */',
             'namespace' => 'App\\Http\\Controllers\\Admin',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'visitorparkingapplication' => 'App\\Models\\VisitorParkingApplication',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'issuerService',
               'type' => 'App\\Services\\TWDIWIssuerService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'reject',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 拒絕申請
     */',
             'namespace' => 'App\\Http\\Controllers\\Admin',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'visitorparkingapplication' => 'App\\Models\\VisitorParkingApplication',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'id',
               'type' => 'int',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'statistics',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 統計資訊
     */',
             'namespace' => 'App\\Http\\Controllers\\Admin',
             'uses' => 
            array (
              'controller' => 'App\\Http\\Controllers\\Controller',
              'visitorparkingapplication' => 'App\\Models\\VisitorParkingApplication',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ApplicationController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\ApplicationController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'store',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 處理應徵申請（透過 VP 交易 ID + 手動填寫欄位）
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'employee' => 'App\\Models\\Employee',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwverifierservice' => 'App\\Services\\TWDIWVerifierService',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
              'carbon' => 'Carbon\\Carbon',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'verifierService',
               'type' => 'App\\Services\\TWDIWVerifierService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/AuthController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\AuthController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'login',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 使用員工 VC 登入
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'employee' => 'App\\Models\\Employee',
              'employeeloginlog' => 'App\\Models\\EmployeeLoginLog',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwverifierservice' => 'App\\Services\\TWDIWVerifierService',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'verifierService',
               'type' => 'App\\Services\\TWDIWVerifierService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'logout',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 登出
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'employee' => 'App\\Models\\Employee',
              'employeeloginlog' => 'App\\Models\\EmployeeLoginLog',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwverifierservice' => 'App\\Services\\TWDIWVerifierService',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Controller.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\Controller',
       'phpDoc' => NULL,
       'abstract' => true,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\EmployeeCredentialController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'show',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 取得員工資料（需要 token 驗證）
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'employee' => 'App\\Models\\Employee',
              'issuedvc' => 'App\\Models\\IssuedVC',
              'vcstatuschangelog' => 'App\\Models\\VCStatusChangeLog',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
              'http' => 'Illuminate\\Support\\Facades\\Http',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'employeeId',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'issue',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 發行員工 VC
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'employee' => 'App\\Models\\Employee',
              'issuedvc' => 'App\\Models\\IssuedVC',
              'vcstatuschangelog' => 'App\\Models\\VCStatusChangeLog',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
              'http' => 'Illuminate\\Support\\Facades\\Http',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'updateCredential',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 更新員工憑證資料
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'employee' => 'App\\Models\\Employee',
              'issuedvc' => 'App\\Models\\IssuedVC',
              'vcstatuschangelog' => 'App\\Models\\VCStatusChangeLog',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
              'http' => 'Illuminate\\Support\\Facades\\Http',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'employeeId',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'issuerService',
               'type' => 'App\\Services\\TWDIWIssuerService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'reissue',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 換發員工 VC（需要登入）
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'employee' => 'App\\Models\\Employee',
              'issuedvc' => 'App\\Models\\IssuedVC',
              'vcstatuschangelog' => 'App\\Models\\VCStatusChangeLog',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
              'http' => 'Illuminate\\Support\\Facades\\Http',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'issuerService',
               'type' => 'App\\Services\\TWDIWIssuerService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'confirmReissue',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 確認換發憑證（revoke 舊卡、更新新卡資料）
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'employee' => 'App\\Models\\Employee',
              'issuedvc' => 'App\\Models\\IssuedVC',
              'vcstatuschangelog' => 'App\\Models\\VCStatusChangeLog',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
              'http' => 'Illuminate\\Support\\Facades\\Http',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'issuerService',
               'type' => 'App\\Services\\TWDIWIssuerService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/MedicalLeaveController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\MedicalLeaveController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'verifyMedicalCertificate',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 驗證醫療診斷證明 VP 並提取資料
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'medicalleave' => 'App\\Models\\MedicalLeave',
              'vpverificationresult' => 'App\\Models\\VPVerificationResult',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwverifierservice' => 'App\\Services\\TWDIWVerifierService',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
              'carbon' => 'Carbon\\Carbon',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'verifierService',
               'type' => 'App\\Services\\TWDIWVerifierService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'store',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 提交病假申請
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'medicalleave' => 'App\\Models\\MedicalLeave',
              'vpverificationresult' => 'App\\Models\\VPVerificationResult',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwverifierservice' => 'App\\Services\\TWDIWVerifierService',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
              'carbon' => 'Carbon\\Carbon',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'index',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 獲取當前員工的病假列表
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'medicalleave' => 'App\\Models\\MedicalLeave',
              'vpverificationresult' => 'App\\Models\\VPVerificationResult',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwverifierservice' => 'App\\Services\\TWDIWVerifierService',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
              'carbon' => 'Carbon\\Carbon',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\ParkingPermitController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'generateVerificationQR',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 產生員工證驗證 QR Code（用於停車證申請）
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'parkingpermit' => 'App\\Models\\ParkingPermit',
              'parkingpermitvehicle' => 'App\\Models\\ParkingPermitVehicle',
              'employee' => 'App\\Models\\Employee',
              'vpverificationresult' => 'App\\Models\\VPVerificationResult',
              'issuedvc' => 'App\\Models\\IssuedVC',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwverifierservice' => 'App\\Services\\TWDIWVerifierService',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
              'db' => 'Illuminate\\Support\\Facades\\DB',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'verifierService',
               'type' => 'App\\Services\\TWDIWVerifierService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'verifyEmployeeCredential',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 驗證員工證 VP
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'parkingpermit' => 'App\\Models\\ParkingPermit',
              'parkingpermitvehicle' => 'App\\Models\\ParkingPermitVehicle',
              'employee' => 'App\\Models\\Employee',
              'vpverificationresult' => 'App\\Models\\VPVerificationResult',
              'issuedvc' => 'App\\Models\\IssuedVC',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwverifierservice' => 'App\\Services\\TWDIWVerifierService',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
              'db' => 'Illuminate\\Support\\Facades\\DB',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'verifierService',
               'type' => 'App\\Services\\TWDIWVerifierService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'apply',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 申請停車證（發行 VC）
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'parkingpermit' => 'App\\Models\\ParkingPermit',
              'parkingpermitvehicle' => 'App\\Models\\ParkingPermitVehicle',
              'employee' => 'App\\Models\\Employee',
              'vpverificationresult' => 'App\\Models\\VPVerificationResult',
              'issuedvc' => 'App\\Models\\IssuedVC',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwverifierservice' => 'App\\Services\\TWDIWVerifierService',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
              'db' => 'Illuminate\\Support\\Facades\\DB',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'issuerService',
               'type' => 'App\\Services\\TWDIWIssuerService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'confirmIssuance',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 確認停車證領取（更新 VC CID）
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'parkingpermit' => 'App\\Models\\ParkingPermit',
              'parkingpermitvehicle' => 'App\\Models\\ParkingPermitVehicle',
              'employee' => 'App\\Models\\Employee',
              'vpverificationresult' => 'App\\Models\\VPVerificationResult',
              'issuedvc' => 'App\\Models\\IssuedVC',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwverifierservice' => 'App\\Services\\TWDIWVerifierService',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
              'db' => 'Illuminate\\Support\\Facades\\DB',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'issuerService',
               'type' => 'App\\Services\\TWDIWIssuerService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'show',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 查詢員工的停車證
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'parkingpermit' => 'App\\Models\\ParkingPermit',
              'parkingpermitvehicle' => 'App\\Models\\ParkingPermitVehicle',
              'employee' => 'App\\Models\\Employee',
              'vpverificationresult' => 'App\\Models\\VPVerificationResult',
              'issuedvc' => 'App\\Models\\IssuedVC',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwverifierservice' => 'App\\Services\\TWDIWVerifierService',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
              'db' => 'Illuminate\\Support\\Facades\\DB',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'updateVehicles',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 更新車輛資訊（不影響 VC）
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'parkingpermit' => 'App\\Models\\ParkingPermit',
              'parkingpermitvehicle' => 'App\\Models\\ParkingPermitVehicle',
              'employee' => 'App\\Models\\Employee',
              'vpverificationresult' => 'App\\Models\\VPVerificationResult',
              'issuedvc' => 'App\\Models\\IssuedVC',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwverifierservice' => 'App\\Services\\TWDIWVerifierService',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
              'db' => 'Illuminate\\Support\\Facades\\DB',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'reissue',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 換發停車證（撤銷舊的，允許重新申請）
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'parkingpermit' => 'App\\Models\\ParkingPermit',
              'parkingpermitvehicle' => 'App\\Models\\ParkingPermitVehicle',
              'employee' => 'App\\Models\\Employee',
              'vpverificationresult' => 'App\\Models\\VPVerificationResult',
              'issuedvc' => 'App\\Models\\IssuedVC',
              'activitylog' => 'App\\Models\\ActivityLog',
              'twdiwverifierservice' => 'App\\Services\\TWDIWVerifierService',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
              'db' => 'Illuminate\\Support\\Facades\\DB',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'issuerService',
               'type' => 'App\\Services\\TWDIWIssuerService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/VPMachineController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\VPMachineController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getConfig',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 取得 VP 驗證配置（動態讀取機器設定）
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'request' => 'Illuminate\\Http\\Request',
              'twdiwverifierservice' => 'App\\Services\\TWDIWVerifierService',
              'vpmachine' => 'App\\Models\\VPMachine',
              'vpverificationlog' => 'App\\Models\\VPVerificationLog',
              'parkingpermit' => 'App\\Models\\ParkingPermit',
              'str' => 'Illuminate\\Support\\Str',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
              'carbon' => 'Carbon\\Carbon',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'machineId',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'verifierService',
               'type' => 'App\\Services\\TWDIWVerifierService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'verifyResult',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 查詢驗證結果（停車證驗證邏輯）
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'request' => 'Illuminate\\Http\\Request',
              'twdiwverifierservice' => 'App\\Services\\TWDIWVerifierService',
              'vpmachine' => 'App\\Models\\VPMachine',
              'vpverificationlog' => 'App\\Models\\VPVerificationLog',
              'parkingpermit' => 'App\\Models\\ParkingPermit',
              'str' => 'Illuminate\\Support\\Str',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
              'carbon' => 'Carbon\\Carbon',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'verifierService',
               'type' => 'App\\Services\\TWDIWVerifierService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/VisitorParkingController.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Http\\Controllers\\VisitorParkingController',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'App\\Http\\Controllers\\Controller',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'store',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 提交訪客停車證申請
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'visitorparkingapplication' => 'App\\Models\\VisitorParkingApplication',
              'issuedvc' => 'App\\Models\\IssuedVC',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'show',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 查看申請資訊（透過 visitor_token）
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'visitorparkingapplication' => 'App\\Models\\VisitorParkingApplication',
              'issuedvc' => 'App\\Models\\IssuedVC',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'visitorToken',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'claim',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 訪客領取停車證（確認領取）
     */',
             'namespace' => 'App\\Http\\Controllers',
             'uses' => 
            array (
              'visitorparkingapplication' => 'App\\Models\\VisitorParkingApplication',
              'issuedvc' => 'App\\Models\\IssuedVC',
              'twdiwissuerservice' => 'App\\Services\\TWDIWIssuerService',
              'request' => 'Illuminate\\Http\\Request',
              'validator' => 'Illuminate\\Support\\Facades\\Validator',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'request',
               'type' => 'Illuminate\\Http\\Request',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'visitorToken',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'issuerService',
               'type' => 'App\\Services\\TWDIWIssuerService',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Models/ActivityLog.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\ActivityLog',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'casts',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'employee',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 關聯：相關員工
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'request' => 'Illuminate\\Support\\Facades\\Request',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'actor',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 關聯：操作者（如果是員工）
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'request' => 'Illuminate\\Support\\Facades\\Request',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'log',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 靜態方法：記錄活動
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'request' => 'Illuminate\\Support\\Facades\\Request',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'self',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'data',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'logVCIssue',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 靜態方法：記錄 VC 發行
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'request' => 'Illuminate\\Support\\Facades\\Request',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'self',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'employeeId',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'vcCid',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'vcUid',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            3 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'reason',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            4 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'actorId',
               'type' => '?string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
            )),
            5 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'actorType',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'logVPVerification',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 靜態方法：記錄 VP 驗證
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'request' => 'Illuminate\\Support\\Facades\\Request',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'self',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'transactionId',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'reason',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'success',
               'type' => 'bool',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
            )),
            3 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'employeeId',
               'type' => '?string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
            )),
            4 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'failureReason',
               'type' => '?string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
            )),
            5 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'metadata',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'logVCRevoke',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 靜態方法：記錄 VC 撤銷
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'request' => 'Illuminate\\Support\\Facades\\Request',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'self',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'employeeId',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'vcCid',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'reason',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            3 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'actorId',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            4 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'actorType',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Models/ApiLog.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\ApiLog',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'casts',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'logApiCall',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 靜態方法：記錄 API 呼叫
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'self',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'data',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Models/Employee.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\Employee',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Laravel\\Sanctum\\HasApiTokens',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'casts',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'generateEmployeeId',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 產生下一個員工編號（6位流水號）
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'hasapitokens' => 'Laravel\\Sanctum\\HasApiTokens',
              'carbon' => 'Carbon\\Carbon',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'string',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'generateCredentialToken',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 產生員工證領取 token（用於驗證領取連結）
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'hasapitokens' => 'Laravel\\Sanctum\\HasApiTokens',
              'carbon' => 'Carbon\\Carbon',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'string',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'issuedVCs',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 關聯到已發行的 VC
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'hasapitokens' => 'Laravel\\Sanctum\\HasApiTokens',
              'carbon' => 'Carbon\\Carbon',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'medicalLeaves',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 關聯到病假申請
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'hasapitokens' => 'Laravel\\Sanctum\\HasApiTokens',
              'carbon' => 'Carbon\\Carbon',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'activityLogs',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 關聯到活動記錄
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'hasapitokens' => 'Laravel\\Sanctum\\HasApiTokens',
              'carbon' => 'Carbon\\Carbon',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Models/EmployeeLoginLog.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\EmployeeLoginLog',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'employee',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 關聯到員工
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'vpVerificationResult',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 關聯到 VP 驗證結果
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Models/IssuedVC.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\IssuedVC',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'table',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'casts',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'employee',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 關聯到員工
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Models/MedicalLeave.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\MedicalLeave',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'casts',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'employee',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 關聯到員工
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'vpVerification',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 關聯到 VP 驗證結果
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Models/ParkingPermit.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\ParkingPermit',
       'phpDoc' => 
      \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
         'phpDocString' => '/**
 * @property string $permit_id
 * @property string $employee_id
 * @property string|null $vc_cid
 * @property string|null $vp_transaction_id
 * @property string|null $vc_transaction_id
 * @property string $name
 * @property string $parking_type
 * @property \\Carbon\\Carbon|null $issued_at
 * @property \\Carbon\\Carbon|null $expiry_date
 * @property-read Collection<int, ParkingPermitVehicle> $vehicles
 * @property-read Employee|null $employee
 */',
         'namespace' => 'App\\Models',
         'uses' => 
        array (
          'collection' => 'Illuminate\\Database\\Eloquent\\Collection',
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
          'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
        ),
         'constUses' => 
        array (
        ),
      )),
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'casts',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'generatePermitId',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 產生下一個停車證編號 (格式: P + 年份後2碼 + 6位流水號)
     * 例如: P25000001
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'collection' => 'Illuminate\\Database\\Eloquent\\Collection',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'string',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'employee',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 關聯到員工
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'collection' => 'Illuminate\\Database\\Eloquent\\Collection',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'vehicles',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 關聯到車輛資料
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'collection' => 'Illuminate\\Database\\Eloquent\\Collection',
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Models/ParkingPermitVehicle.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\ParkingPermitVehicle',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'parkingPermit',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 關聯到停車證
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Models/User.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\User',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Foundation\\Auth\\User',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
        1 => 'Illuminate\\Notifications\\Notifiable',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'authenticatable' => 'Illuminate\\Foundation\\Auth\\User',
              'notifiable' => 'Illuminate\\Notifications\\Notifiable',
            ),
             'constUses' => 
            array (
            ),
          )),
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'hidden',
          ),
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'authenticatable' => 'Illuminate\\Foundation\\Auth\\User',
              'notifiable' => 'Illuminate\\Notifications\\Notifiable',
            ),
             'constUses' => 
            array (
            ),
          )),
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'casts',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'hasfactory' => 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory',
              'authenticatable' => 'Illuminate\\Foundation\\Auth\\User',
              'notifiable' => 'Illuminate\\Notifications\\Notifiable',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Models/VCStatusChangeLog.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\VCStatusChangeLog',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'table',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'casts',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'employee',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 關聯到員工
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Models/VPMachine.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\VPMachine',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'table',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'casts',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getConfigByMachineId',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 根據 machine_id 取得機器配置
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => '?array',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'machineId',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'isActive',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 檢查機器是否存在且啟用
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'bool',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'machineId',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Models/VPVerificationLog.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\VPVerificationLog',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'table',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'casts',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'logConfigRequest',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 記錄取得配置
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'machineId',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'transactionId',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'vpRef',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            3 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'vpName',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'logScanDetected',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 記錄掃描檢測
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'machineId',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'transactionId',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'logVerifySuccess',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 記錄驗證成功
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'machineId',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'transactionId',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'vpRef',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            3 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'vpName',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            4 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'data',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'logVerifyFailed',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 記錄驗證失敗
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'machineId',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'transactionId',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'vpRef',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            3 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'vpName',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            4 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'reason',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'machine',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 關聯到機器
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Models/VPVerificationResult.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\VPVerificationResult',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'table',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'casts',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'employee',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 關聯到員工
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'medicalLeaves',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 關聯到病假申請
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
              'hasmany' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\HasMany',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Models/VisitorParkingApplication.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Models\\VisitorParkingApplication',
       'phpDoc' => 
      \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
         'phpDocString' => '/**
 * @property int $id
 * @property string $email
 * @property string $name
 * @property string $application_reason
 * @property string $vehicle_plate_number
 * @property string $vehicle_type
 * @property string $brand_model
 * @property string $color
 * @property \\Carbon\\Carbon $parking_start_date
 * @property \\Carbon\\Carbon $parking_end_date
 * @property string $status
 * @property string|null $reviewed_by
 * @property \\Carbon\\Carbon|null $reviewed_at
 * @property string|null $review_note
 * @property string|null $permit_id
 * @property string $visitor_token
 * @property string|null $vc_transaction_id
 * @property string|null $vc_cid
 * @property string|null $qr_code
 * @property string|null $deep_link
 * @property bool $is_issued
 * @property \\Carbon\\Carbon|null $issued_at
 * @property-read Employee|null $reviewer
 * @property-read string $status_text
 * @property-read string $claim_url
 */',
         'namespace' => 'App\\Models',
         'uses' => 
        array (
          'model' => 'Illuminate\\Database\\Eloquent\\Model',
          'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
        ),
         'constUses' => 
        array (
        ),
      )),
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Model',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'fillable',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'casts',
          ),
           'phpDoc' => NULL,
           'type' => NULL,
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'generateVisitorToken',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 產生唯一的訪客 token
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'string',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'generatePermitId',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 產生訪客停車證編號 (格式: V + 年份後2碼 + 6位流水號)
     * 例如: V25000001
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => true,
           'returnType' => 'string',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'reviewer',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 關聯到審核者
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getStatusTextAttribute',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 取得申請狀態的中文描述
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'string',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getClaimUrlAttribute',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 取得領取連結
     */',
             'namespace' => 'App\\Models',
             'uses' => 
            array (
              'model' => 'Illuminate\\Database\\Eloquent\\Model',
              'belongsto' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'string',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Providers/AppServiceProvider.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Providers\\AppServiceProvider',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Support\\ServiceProvider',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'register',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Register any application services.
     */',
             'namespace' => 'App\\Providers',
             'uses' => 
            array (
              'serviceprovider' => 'Illuminate\\Support\\ServiceProvider',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'boot',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Bootstrap any application services.
     */',
             'namespace' => 'App\\Providers',
             'uses' => 
            array (
              'serviceprovider' => 'Illuminate\\Support\\ServiceProvider',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Rules/RocIdNumber.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Rules\\RocIdNumber',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
        0 => 'Illuminate\\Contracts\\Validation\\ValidationRule',
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'validate',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 中華民國身分證字號驗證規則
     *
     * 驗證邏輯：
     * 1. 格式：1個大寫字母 + 1個數字(1或2) + 8個數字
     * 2. 字母對應數字表（A=10, B=11, ..., Z=35）
     * 3. 檢查碼驗證公式
     *
     * @param  \\Closure(string, ?string=): \\Illuminate\\Translation\\PotentiallyTranslatedString  $fail
     */',
             'namespace' => 'App\\Rules',
             'uses' => 
            array (
              'closure' => 'Closure',
              'validationrule' => 'Illuminate\\Contracts\\Validation\\ValidationRule',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'attribute',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'value',
               'type' => 'mixed',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'fail',
               'type' => 'Closure',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Services/TWDIWIssuerService.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Services\\TWDIWIssuerService',
       'phpDoc' => 
      \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
         'phpDocString' => '/**
 * TW-DIW (Taiwan Digital Identity Wallet) Issuer Service
 *
 * 用於與 TW-DIW Issuer Sandbox API 互動，發行數位憑證 (VC)
 */',
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'apilog' => 'App\\Models\\ApiLog',
          'http' => 'Illuminate\\Support\\Facades\\Http',
        ),
         'constUses' => 
        array (
        ),
      )),
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'baseUrl',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'accessToken',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'issueVC',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 發行 VC - 產生 QR Code
     *
     * @param string $vcUid VC 模板 UID
     * @param array $fields 欄位資料 (key-value pairs)
     * @param string|null $issuanceDate 發行日期 (YYYYMMDD)
     * @param string|null $expiredDate 到期日期 (YYYYMMDD)
     * @return array
     * @throws \\Exception
     */',
             'namespace' => 'App\\Services',
             'uses' => 
            array (
              'apilog' => 'App\\Models\\ApiLog',
              'http' => 'Illuminate\\Support\\Facades\\Http',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'vcUid',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'fields',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            2 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'issuanceDate',
               'type' => '?string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
            )),
            3 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'expiredDate',
               'type' => '?string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => true,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getVCStatus',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 查詢 VC 發行狀態
     *
     * @param string $transactionId 交易 ID
     * @return array
     * @throws \\Exception
     */',
             'namespace' => 'App\\Services',
             'uses' => 
            array (
              'apilog' => 'App\\Models\\ApiLog',
              'http' => 'Illuminate\\Support\\Facades\\Http',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'transactionId',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'changeVCStatus',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 變更 VC 狀態
     *
     * @param string $cid VC 的 CID
     * @param string $action 操作類型：revocation（撤銷）, suspension（停用）, recovery（復用）
     * @return array
     * @throws \\Exception
     */',
             'namespace' => 'App\\Services',
             'uses' => 
            array (
              'apilog' => 'App\\Models\\ApiLog',
              'http' => 'Illuminate\\Support\\Facades\\Http',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'cid',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'action',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'sanitizeHeaders',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 移除敏感資訊（如 Access-Token）
     */',
             'namespace' => 'App\\Services',
             'uses' => 
            array (
              'apilog' => 'App\\Models\\ApiLog',
              'http' => 'Illuminate\\Support\\Facades\\Http',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'headers',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/app/Services/TWDIWVerifierService.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'App\\Services\\TWDIWVerifierService',
       'phpDoc' => 
      \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
         'phpDocString' => '/**
 * TW-DIW (Taiwan Digital Identity Wallet) Verifier Service
 *
 * 用於與 TW-DIW Verifier Sandbox API 互動，驗證數位簡報 (VP)
 */',
         'namespace' => 'App\\Services',
         'uses' => 
        array (
          'apilog' => 'App\\Models\\ApiLog',
          'vpverificationresult' => 'App\\Models\\VPVerificationResult',
          'http' => 'Illuminate\\Support\\Facades\\Http',
          'carbon' => 'Carbon\\Carbon',
        ),
         'constUses' => 
        array (
        ),
      )),
       'abstract' => false,
       'final' => false,
       'extends' => NULL,
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'baseUrl',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'accessToken',
          ),
           'phpDoc' => NULL,
           'type' => 'string',
           'public' => false,
           'private' => false,
           'static' => false,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => '__construct',
           'phpDoc' => NULL,
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => NULL,
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        3 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'generateVPQRCode',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 產生 VP 驗證 QR Code
     *
     * @param string $ref 驗證服務代碼
     * @param string $transactionId 交易 ID (建議使用 UUID v4)
     * @return array
     * @throws \\Exception
     */',
             'namespace' => 'App\\Services',
             'uses' => 
            array (
              'apilog' => 'App\\Models\\ApiLog',
              'vpverificationresult' => 'App\\Models\\VPVerificationResult',
              'http' => 'Illuminate\\Support\\Facades\\Http',
              'carbon' => 'Carbon\\Carbon',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'ref',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
            1 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'transactionId',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        4 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getVPResult',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 查詢 VP 驗證結果並保存到資料庫
     *
     * 注意：TW-DIW 在查詢一次後會刪除資料，因此必須立即保存
     *
     * @param string $transactionId 交易 ID
     * @return array|null 如果還沒有驗證結果則回傳 null
     * @throws \\Exception
     */',
             'namespace' => 'App\\Services',
             'uses' => 
            array (
              'apilog' => 'App\\Models\\ApiLog',
              'vpverificationresult' => 'App\\Models\\VPVerificationResult',
              'http' => 'Illuminate\\Support\\Facades\\Http',
              'carbon' => 'Carbon\\Carbon',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => '?array',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'transactionId',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        5 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'sanitizeHeaders',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 移除敏感資訊（如 Access-Token）
     */',
             'namespace' => 'App\\Services',
             'uses' => 
            array (
              'apilog' => 'App\\Models\\ApiLog',
              'vpverificationresult' => 'App\\Models\\VPVerificationResult',
              'http' => 'Illuminate\\Support\\Facades\\Http',
              'carbon' => 'Carbon\\Carbon',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => false,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'headers',
               'type' => 'array',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        6 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'getStoredVPResult',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 從資料庫取得已保存的 VP 驗證結果
     *
     * @param string $transactionId 交易 ID
     * @return array|null
     */',
             'namespace' => 'App\\Services',
             'uses' => 
            array (
              'apilog' => 'App\\Models\\ApiLog',
              'vpverificationresult' => 'App\\Models\\VPVerificationResult',
              'http' => 'Illuminate\\Support\\Facades\\Http',
              'carbon' => 'Carbon\\Carbon',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => '?array',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'transactionId',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
        7 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'markVPResultAsUsed',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * 標記 VP 驗證結果為已使用
     *
     * @param string $transactionId 交易 ID
     * @return void
     */',
             'namespace' => 'App\\Services',
             'uses' => 
            array (
              'apilog' => 'App\\Models\\ApiLog',
              'vpverificationresult' => 'App\\Models\\VPVerificationResult',
              'http' => 'Illuminate\\Support\\Facades\\Http',
              'carbon' => 'Carbon\\Carbon',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
            0 => 
            \PHPStan\Dependency\ExportedNode\ExportedParameterNode::__set_state(array(
               'name' => 'transactionId',
               'type' => 'string',
               'byRef' => false,
               'variadic' => false,
               'hasDefault' => false,
               'attributes' => 
              array (
              ),
            )),
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/database/factories/UserFactory.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'Database\\Factories\\UserFactory',
       'phpDoc' => 
      \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
         'phpDocString' => '/**
 * @extends \\Illuminate\\Database\\Eloquent\\Factories\\Factory<\\App\\Models\\User>
 */',
         'namespace' => 'Database\\Factories',
         'uses' => 
        array (
          'factory' => 'Illuminate\\Database\\Eloquent\\Factories\\Factory',
          'hash' => 'Illuminate\\Support\\Facades\\Hash',
          'str' => 'Illuminate\\Support\\Str',
        ),
         'constUses' => 
        array (
        ),
      )),
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Eloquent\\Factories\\Factory',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedPropertiesNode::__set_state(array(
           'names' => 
          array (
            0 => 'password',
          ),
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * The current password being used by the factory.
     */',
             'namespace' => 'Database\\Factories',
             'uses' => 
            array (
              'factory' => 'Illuminate\\Database\\Eloquent\\Factories\\Factory',
              'hash' => 'Illuminate\\Support\\Facades\\Hash',
              'str' => 'Illuminate\\Support\\Str',
            ),
             'constUses' => 
            array (
            ),
          )),
           'type' => '?string',
           'public' => false,
           'private' => false,
           'static' => true,
           'readonly' => false,
           'abstract' => false,
           'final' => false,
           'publicSet' => false,
           'protectedSet' => false,
           'privateSet' => false,
           'virtual' => false,
           'attributes' => 
          array (
          ),
           'hooks' => 
          array (
          ),
        )),
        1 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'definition',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Define the model\'s default state.
     *
     * @return array<string, mixed>
     */',
             'namespace' => 'Database\\Factories',
             'uses' => 
            array (
              'factory' => 'Illuminate\\Database\\Eloquent\\Factories\\Factory',
              'hash' => 'Illuminate\\Support\\Facades\\Hash',
              'str' => 'Illuminate\\Support\\Str',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'array',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
        2 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'unverified',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Indicate that the model\'s email address should be unverified.
     */',
             'namespace' => 'Database\\Factories',
             'uses' => 
            array (
              'factory' => 'Illuminate\\Database\\Eloquent\\Factories\\Factory',
              'hash' => 'Illuminate\\Support\\Facades\\Hash',
              'str' => 'Illuminate\\Support\\Str',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'static',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
  '/Users/junlonglin/Herd/CrediBiz/database/seeders/DatabaseSeeder.php' => 
  array (
    0 => 
    \PHPStan\Dependency\ExportedNode\ExportedClassNode::__set_state(array(
       'name' => 'Database\\Seeders\\DatabaseSeeder',
       'phpDoc' => NULL,
       'abstract' => false,
       'final' => false,
       'extends' => 'Illuminate\\Database\\Seeder',
       'implements' => 
      array (
      ),
       'usedTraits' => 
      array (
        0 => 'Illuminate\\Database\\Console\\Seeds\\WithoutModelEvents',
      ),
       'traitUseAdaptations' => 
      array (
      ),
       'statements' => 
      array (
        0 => 
        \PHPStan\Dependency\ExportedNode\ExportedMethodNode::__set_state(array(
           'name' => 'run',
           'phpDoc' => 
          \PHPStan\Dependency\ExportedNode\ExportedPhpDocNode::__set_state(array(
             'phpDocString' => '/**
     * Seed the application\'s database.
     */',
             'namespace' => 'Database\\Seeders',
             'uses' => 
            array (
              'user' => 'App\\Models\\User',
              'withoutmodelevents' => 'Illuminate\\Database\\Console\\Seeds\\WithoutModelEvents',
              'seeder' => 'Illuminate\\Database\\Seeder',
            ),
             'constUses' => 
            array (
            ),
          )),
           'byRef' => false,
           'public' => true,
           'private' => false,
           'abstract' => false,
           'final' => false,
           'static' => false,
           'returnType' => 'void',
           'parameters' => 
          array (
          ),
           'attributes' => 
          array (
          ),
        )),
      ),
       'attributes' => 
      array (
      ),
    )),
  ),
); },
];
