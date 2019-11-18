<?php

namespace Aping\LaravelOpcacheGui;

class Opcache
{
    /**
     * configuration
     *
     * @var array
     */
    protected $configuration;

    /**
     * status
     *
     * @var array
     */
    protected $status;

    /**
     * is enable opcache
     *
     * @return bool
     */
    public function isEnable()
    {
        return function_exists('opcache_get_configuration');
    }

    /**
     * opcache version
     *
     * @return string
     */
    public function version()
    {
        list($version, $name) = array_values($this->configuration('version'));

        return sprintf('PHP %s & %s %s', phpversion(), $name, $version);
    }

    /**
     * directives
     *
     * @return array
     */
    public function directives()
    {
        return $this->configuration('directives');
    }

    /**
     * scripts
     *
     * @return array
     */
    public function scripts()
    {
        return $this->status('scripts');
    }

    /**
     * scripts count
     *
     * @return int
     */
    public function countScripts()
    {
        return count($this->scripts());
    }

    /**
     * opcache status
     *
     * @return array
     */
    public function opcacheStatus()
    {
        return array_only($this->status(), [
            'opcache_enabled',
            'cache_full',
            'restart_pending',
            'restart_in_progress',
        ]);
    }

    /**
     * memory usage
     *
     * @return array
     */
    public function memoryUsage()
    {
        return $this->status('memory_usage');
    }

    /**
     * interned strings usage
     *
     * @return array
     */
    public function internedStringsUsage()
    {
        return $this->status('interned_strings_usage');
    }

    /**
     * opcache statistics
     *
     * @return array
     */
    public function opcacheStatistics()
    {
        return $this->status('opcache_statistics');
    }

    /**
     * configuration
     *
     * @param string $key
     *
     * @return array | mixed
     */
    public function configuration(string $key = null)
    {
        if (is_null($this->configuration)) {
            $this->configuration = opcache_get_configuration();
        }

        return is_null($key) ? $this->configuration : array_get($this->configuration, $key);
    }

    /**
     * status
     *
     * @param string $key
     *
     * @return array | mixed
     */
    public function status(string $key = null)
    {
        if (is_null($this->status)) {
            $this->status = opcache_get_status();
        }

        return is_null($key) ? $this->status : array_get($this->status, $key);
    }

}
