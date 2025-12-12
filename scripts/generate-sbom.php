#!/usr/bin/env php
<?php

/**
 * Generate SBOM (Software Bill of Materials) for competition compliance
 *
 * This script generates a comprehensive SBOM including:
 * - PHP dependencies from composer.lock
 * - License information
 * - Dependency tree
 */

echo "📦 Generating SBOM (Software Bill of Materials)...\n\n";

// Ensure compliance directory exists
$complianceDir = __DIR__ . '/../compliance';
if (!is_dir($complianceDir)) {
    mkdir($complianceDir, 0755, true);
}

// Read composer.lock
$composerLockPath = __DIR__ . '/../composer.lock';
if (!file_exists($composerLockPath)) {
    echo "❌ Error: composer.lock not found. Run 'composer install' first.\n";
    exit(1);
}

$composerLock = json_decode(file_get_contents($composerLockPath), true);
if (!$composerLock) {
    echo "❌ Error: Failed to parse composer.lock\n";
    exit(1);
}

// Read composer.json
$composerJsonPath = __DIR__ . '/../composer.json';
$composerJson = json_decode(file_get_contents($composerJsonPath), true);

// Generate SBOM structure
$sbom = [
    'bomFormat' => 'CycloneDX',
    'specVersion' => '1.4',
    'version' => 1,
    'metadata' => [
        'timestamp' => date('c'),
        'component' => [
            'type' => 'application',
            'name' => $composerJson['name'] ?? 'credibiz',
            'version' => '1.0.0',
            'description' => $composerJson['description'] ?? '',
            'licenses' => [
                ['license' => ['id' => $composerJson['license'] ?? 'MIT']]
            ]
        ]
    ],
    'components' => []
];

// Process packages (production + dev)
$allPackages = array_merge(
    $composerLock['packages'] ?? [],
    $composerLock['packages-dev'] ?? []
);

foreach ($allPackages as $package) {
    $component = [
        'type' => 'library',
        'name' => $package['name'],
        'version' => $package['version'],
    ];

    if (isset($package['description'])) {
        $component['description'] = $package['description'];
    }

    if (isset($package['license'])) {
        $licenses = is_array($package['license']) ? $package['license'] : [$package['license']];
        $component['licenses'] = array_map(function($license) {
            return ['license' => ['id' => $license]];
        }, $licenses);
    }

    if (isset($package['source']['url'])) {
        $component['externalReferences'] = [
            [
                'type' => 'vcs',
                'url' => $package['source']['url']
            ]
        ];
    }

    $sbom['components'][] = $component;
}

// Save SBOM
$sbomPath = $complianceDir . '/sbom-composer.json';
file_put_contents($sbomPath, json_encode($sbom, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

echo "✅ SBOM generated successfully!\n";
echo "   📄 File: compliance/sbom-composer.json\n";
echo "   📦 Components: " . count($sbom['components']) . "\n\n";

// Generate license summary
$licenseSummary = [];
foreach ($allPackages as $package) {
    if (isset($package['license'])) {
        $licenses = is_array($package['license']) ? $package['license'] : [$package['license']];
        foreach ($licenses as $license) {
            if (!isset($licenseSummary[$license])) {
                $licenseSummary[$license] = 0;
            }
            $licenseSummary[$license]++;
        }
    }
}

arsort($licenseSummary);

echo "📋 License Summary:\n";
foreach ($licenseSummary as $license => $count) {
    echo "   - {$license}: {$count} packages\n";
}

// Check for incompatible licenses
$incompatibleLicenses = ['GPL-3.0', 'AGPL-3.0', 'GPL-2.0'];
$foundIncompatible = false;

foreach ($allPackages as $package) {
    if (isset($package['license'])) {
        $licenses = is_array($package['license']) ? $package['license'] : [$package['license']];
        foreach ($licenses as $license) {
            if (in_array($license, $incompatibleLicenses)) {
                if (!$foundIncompatible) {
                    echo "\n⚠️  Warning: Found potentially incompatible licenses:\n";
                    $foundIncompatible = true;
                }
                echo "   - {$package['name']}: {$license}\n";
            }
        }
    }
}

if (!$foundIncompatible) {
    echo "\n✅ No incompatible licenses found!\n";
}

echo "\n✨ SBOM generation complete!\n";
exit(0);
