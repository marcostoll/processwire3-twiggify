<?php

/**
 * Class definition of TwiggifyConfig
 *
 * @author Marco Stoll <marco@fast-forward-encoding.de>
 * @version 1.0.0
 * @copyright 2016, Marco Stoll, https://github.com/marcostoll
 * @filesource
 */

namespace ffe\ProcessWire3;

use ProcessWire\ModuleConfig;

/**
 * Class TwiggifyConfig
 *
 * @package ffe/ProcessWire3
 */
class TwiggifyConfig extends ModuleConfig
{
    /**
     * TwiggifyConfig constructor.
     */
    public function __construct()
    {
        $this->add([
            [
                'name' => 'twigPath',
                'label' => 'Twig Installation Path',
                'type' => 'text',
                'required' => true,
                'value' => '',
                'placeholder' => 'path to Twig_Autoloader class file',
                'description' => 'Insert path to Twig_Autoloader class file (relative to $config->paths->root).',
                'notes' => 'Unless you\'ve installed Twig via composer (which you probably should), '
                    . 'the module will register the Twig autoloader requiring the given file.',
                'columnWidth' => 34
            ],
            [
                'name' => 'twigCache',
                'label' => 'Twig Cache Directory',
                'type' => 'text',
                'value' => 'twig',
                'placeholder' => 'directory name for the Twig cache',
                'description' => 'Insert a directory name for storing Twig cache files '
                    . '(relative to $config->paths->cache).',
                'notes' => 'Leave blank to disable Twig cache.',
                'columnWidth' => 33
            ],
            [
                'name' => 'twigTemplates',
                'label' => 'Twig Templates Directory',
                'type' => 'text',
                'value' => '',
                'placeholder' => 'directory name of the Twig templates',
                'description' => 'Insert the directory name for loading Twig templates from '
                    . '(relative to $config->paths->root).',
                'notes' => 'Uses $config->paths->templates if left blank.',
                'columnWidth' => 33
            ],
            [
                'name' => 'twigAutoReload',
                'label' => 'Twig Auto Reload',
                'type' => 'checkbox',
                'value' => 1,
                'description' => 'Auto-recompile templates if changed.',
                'columnWidth' => 25,
                'notes' => 'This should always be on.',
            ],
            [
                'name' => 'twigStrictVariables',
                'label' => 'Twig Strict Variables',
                'type' => 'checkbox',
                'value' => 0,
                'description' => 'If checked, Twig will throw an exception when accessing '
                     . 'invalid variables or attributes.',
                'notes' => 'You might want to use this in development mode only.',
                'columnWidth' => 25
            ],
            [
                'name' => 'twigAutoEscape',
                'label' => 'Twig Auto Escape',
                'type' => 'select',
                'options' => [
                    'default' => 'default (true)',
                    'disabled' => 'disabled (false)',
                    'html' => 'html',
                    'html_attr' => 'html_attr',
                    'js' => 'js',
                    'css' => 'css',
                    'url' => 'url'
                ],
                'required' => true,
                'value' => 'default',
                'description' => 'Select a Twig auto-escape strategy.',
                'notes' => 'See Twig environment options for further information.',
                'columnWidth' => 25
            ],
            [
                'name' => 'twigDebug',
                'label' => 'Twig Debug',
                'type' => 'checkbox',
                'value' => 0,
                'description' => 'Enable the Twig debug mode.',
                'notes' => 'You might want to use this in development mode only.',
                'columnWidth' => 25
            ],
            [
                'name' => 'wireFuelImport',
                'label' => 'ProcessWire Fuel Import',
                'type' => 'text',
                'required' => false,
                'value' => 'page,user,session',
                'placeholder' => 'list of wire() fuel keys',
                'description' => 'Specify a list of wire() fuel keys to import as context '
                    . 'for the twig template rendering',
                'notes' => 'Use comma (,) as separator.',
                'columnWidth' => 100
            ]
        ]);
    }
}
