<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class CountryCodeService
{
    /**
     * Cache key for countries data
     */
    const CACHE_KEY = 'country_codes_data';
    
    /**
     * Cache duration in minutes
     */
    const CACHE_DURATION = null; // Will be set from config

    /**
     * Get all country codes with caching
     */
    public static function getAllCountries()
    {
        $cacheDuration = config('country_codes.cache_duration', 60 * 24);
        
        return Cache::remember(self::CACHE_KEY, $cacheDuration, function () {
            return include resource_path('data/country_codes.php');
        });
    }

    /**
     * Get country by code
     */
    public static function getCountryByCode($code)
    {
        $countries = self::getAllCountries();
        
        foreach ($countries as $country) {
            if ($country['code'] === $code) {
                return $country;
            }
        }
        
        return null;
    }

    /**
     * Get popular countries (most commonly used)
     */
    public static function getPopularCountries()
    {
        $popularCodes = config('country_codes.popular_countries', ['GH', 'US', 'GB', 'NG', 'KE', 'ZA', 'IN', 'CA', 'AU', 'DE', 'FR', 'IT', 'ES', 'BR', 'MX', 'JP', 'CN', 'KR']);
        $countries = self::getAllCountries();
        
        $popular = [];
        foreach ($popularCodes as $code) {
            if (isset($countries[$code])) {
                $popular[$code] = $countries[$code];
            }
        }
        
        return $popular;
    }

    /**
     * Get countries for dropdown (simplified - flag and code only)
     */
    public static function getCountriesForDropdown()
    {
        $countries = self::getAllCountries();
        $dropdown = [];
        
        foreach ($countries as $code => $country) {
            $dropdown[$code] = $country['flag'] . ' ' . $country['code'];
        }
        
        return $dropdown;
    }

    /**
     * Get popular countries for dropdown (simplified - flag and code only)
     */
    public static function getPopularCountriesForDropdown()
    {
        $popular = self::getPopularCountries();
        $dropdown = [];
        
        foreach ($popular as $code => $country) {
            $dropdown[$code] = $country['flag'] . ' ' . $country['code'];
        }
        
        return $dropdown;
    }

    /**
     * Clear countries cache
     */
    public static function clearCache()
    {
        Cache::forget(self::CACHE_KEY);
    }

    /**
     * Get countries for dropdown with full names (for reference)
     */
    public static function getCountriesForDropdownWithNames()
    {
        $countries = self::getAllCountries();
        $dropdown = [];
        
        foreach ($countries as $code => $country) {
            $dropdown[$code] = $country['flag'] . ' ' . $country['name'] . ' (' . $country['code'] . ')';
        }
        
        return $dropdown;
    }
}
