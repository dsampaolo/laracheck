<?php

/**
 * Class Laracheck
 *
 * @package LaraCheck
 * @author Didier Sampaolo <didier@didcode.com>
 */

class Laracheck
{

    public $is_version_ok = false;
    public $version = null;

    public $is_extensions_ok = true;
    public $extensions = array();

    private $extensions_needed = array(
        'openssl',
        'pdo',
        'mbstring',
        'tokenizer',
        'libxml'
    );

    public function __construct()
    {
        $this->check_version();
        $this->check_extensions();
    }

    /**
     * Checks if PHP version is fine
     */
    private function check_version()
    {
        $this->is_version_ok = version_compare(PHP_VERSION, '5.6.4');
        $this->version = PHP_VERSION;
    }

    /**
     * Checks that every required extension is enabled
     */
    public function check_extensions()
    {
        foreach ($this->extensions_needed as $extension) {
            $is_loaded = extension_loaded($extension);
            $this->extensions[$extension] = $is_loaded;

            if (!$is_loaded) {
                $this->is_extensions_ok = false;
            }
        }
    }
}
