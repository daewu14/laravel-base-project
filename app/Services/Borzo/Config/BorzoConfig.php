<?php

namespace App\Services\Borza\Config;

trait BorzoConfig {

    /**
     * Toggle switcher configuration mode
     *
     * TRUE => Development mode is active
     * FALSE => Production mode is active
     *
     * @var bool
     */
    private bool $is_development = true;

    /**
     * Base URL development mode
     *
     * @var string
     */
    protected static string $base_url_dev = "https://robotapitest-id.borzodelivery.com/";

    /**
     * Base URL production mode
     *
     * @var string
     */
    protected static string $base_url_prod = "https://robotapitest-id.borzodelivery.com/";

    /**
     * Api key development mode
     *
     * @var string
     */
    protected static string $api_key_dev = "3304B0D89A2F2A6DC6117902AEF51D5F1A3F861B";

    /**
     * Api key production mode
     *
     * @var string
     */
    protected static string $api_key_prod = "3304B0D89A2F2A6DC6117902AEF51D5F1A3F861B";

    /**
     * Setter development mode
     *
     * @param bool $dev
     */
    public function setDevelopment(bool $dev = true) {
        $this->is_development = $dev;
    }

    /**
     * Getter Base URL
     *
     * @return string
     */
    public function getBaseUrl(): string {
        if ($this->is_development) return self::$base_url_dev;
        return self::$base_url_prod;
    }

    /**
     * Getter API key
     *
     * @return string
     */
    public function getApiKey(): string {
        if ($this->is_development) return self::$api_key_dev;
        return self::$api_key_prod;
    }
}
