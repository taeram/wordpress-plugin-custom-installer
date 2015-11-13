<?php

namespace Wordpress\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class TemplateInstaller extends LibraryInstaller
{
    /**
     * {@inheritDoc}
     */
    public function getPackageBasePath(PackageInterface $package) {
        if (substr_count($package->getPrettyName(), 'wordpress-plugin') == 0) {
            throw new \InvalidArgumentException(
                'Unable to install template, WordPress plugins '
                .'should always start their package name with '
                .'"wordpress-plugin-"'
            );
        }

        $packageDirName = preg_replace('/^(.*wordpress-plugin-)/', '', $package->getPrettyName());
        return '../wp-content/plugins/composer-' . $packageDirName;
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType) {
        return 'wordpress-plugin' === $packageType;
    }
}
