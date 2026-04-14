<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SystemSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'description',
    ];

    protected $casts = [
        'value' => 'string',
    ];

    /**
     * Get a setting value by key.
     */
    public static function getValue(string $key, $default = null)
    {
        return Cache::remember("system_setting_{$key}", 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            
            if (!$setting) {
                return $default;
            }

            return match ($setting->type) {
                'boolean' => filter_var($setting->value, FILTER_VALIDATE_BOOLEAN),
                'number' => is_numeric($setting->value) ? (float) $setting->value : $default,
                'json' => json_decode($setting->value, true),
                default => $setting->value,
            };
        });
    }

    /**
     * Set a setting value.
     */
    public static function setValue(string $key, $value, string $type = 'text', string $description = null): void
    {
        $setting = static::updateOrCreate(
            ['key' => $key],
            [
                'value' => is_array($value) || is_object($value) ? json_encode($value) : (string) $value,
                'type' => $type,
                'description' => $description,
            ]
        );

        // Clear cache
        Cache::forget("system_setting_{$key}");
    }

    /**
     * Get tax rate from system settings.
     */
    public static function getTaxRate(): float
    {
        $taxRate = static::getValue('tax_rate', 18);
        return is_numeric($taxRate) ? (float) $taxRate : 18.0;
    }

    /**
     * Set tax rate in system settings.
     */
    public static function setTaxRate(float $rate): void
    {
        static::setValue('tax_rate', $rate, 'number', 'Tax rate percentage applied to sales');
    }

    /**
     * Check if tax is enabled.
     */
    public static function isTaxEnabled(): bool
    {
        return static::getValue('tax_enabled', true);
    }

    /**
     * Enable or disable tax.
     */
    public static function setTaxEnabled(bool $enabled): void
    {
        static::setValue('tax_enabled', $enabled, 'boolean', 'Enable tax calculation on sales');
    }

    /**
     * Get company name.
     */
    public static function getCompanyName(): string
    {
        return static::getValue('company_name', 'Business Management System');
    }

    /**
     * Set company name.
     */
    public static function setCompanyName(string $name): void
    {
        static::setValue('company_name', $name, 'text', 'Company name displayed on reports and invoices');
    }

    /**
     * Get currency code.
     */
    public static function getCurrencyCode(): string
    {
        return static::getValue('currency_code', 'TZS');
    }

    /**
     * Set currency code.
     */
    public static function setCurrencyCode(string $code): void
    {
        static::setValue('currency_code', $code, 'text', 'Currency code for financial displays');
    }

    /**
     * Clear all system settings cache.
     */
    public static function clearCache(): void
    {
        $keys = static::pluck('key');
        foreach ($keys as $key) {
            Cache::forget("system_setting_{$key}");
        }
    }
}
