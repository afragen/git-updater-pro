<?php return array(
    'root' => array(
        'name' => 'afragen/git-updater-pro',
        'pretty_version' => 'dev-develop',
        'version' => 'dev-develop',
        'reference' => '3f510624e4819b57a466f145743bc9c277423b32',
        'type' => 'wordpress-plugin',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'dev' => false,
    ),
    'versions' => array(
        'afragen/git-updater-pro' => array(
            'pretty_version' => 'dev-develop',
            'version' => 'dev-develop',
            'reference' => '3f510624e4819b57a466f145743bc9c277423b32',
            'type' => 'wordpress-plugin',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'afragen/singleton' => array(
            'pretty_version' => 'dev-master',
            'version' => 'dev-master',
            'reference' => 'be8e3c3b3a53ba30db9f77f5b3bcf2d5e58ed9c0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../afragen/singleton',
            'aliases' => array(
                0 => '9999999-dev',
            ),
            'dev_requirement' => false,
        ),
        'freemius/wordpress-sdk' => array(
            'pretty_version' => '2.4.5',
            'version' => '2.4.5.0',
            'reference' => 'd4aa83b1e74f3269affcbfe0d2b75ceae35ba864',
            'type' => 'library',
            'install_path' => __DIR__ . '/../freemius/wordpress-sdk',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
    ),
);
