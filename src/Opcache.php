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
     * scripts
     *
     * @return array
     */
    public function scripts()
    {
        return $this->status('scripts');
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
     * directives
     *
     * @param string $key
     * @return array
     */
    public function directives(string $key = null)
    {
        $key = $this->prefixKey('directives', $key);

        return $this->configuration($key);
    }

    /**
     * memory usage
     *
     * @param string $key
     * @return array
     */
    public function memoryUsage(string $key = null)
    {
        $key = $this->prefixKey('memory_usage', $key);

        return $this->status($key);
    }

    /**
     * interned strings usage
     *
     * @param string $key
     * @return array
     */
    public function internedStringsUsage(string $key = null)
    {
        $key = $this->prefixKey('interned_strings_usage', $key);

        return $this->status($key);
    }

    /**
     * opcache statistics
     *
     * @param string $key
     * @return array
     */
    public function opcacheStatistics(string $key = null)
    {
        $key = $this->prefixKey('opcache_statistics', $key);

        return $this->status($key);
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

    /**
     * array key prefix
     *
     * @param string $prefix
     * @param string|null $key
     * @return string
     */
    protected function prefixKey(string $prefix, string $key = null)
    {
        return $prefix . ($key ? ".$key" : '');
    }

}
