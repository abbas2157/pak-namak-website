<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DealerApplication extends Model
{
    public const BUSINESS_TYPES = [
        'wholesaler' => 'Wholesaler / تھوک فروش',
        'distributor' => 'Distributor / ڈسٹری بیوٹر',
        'retailer' => 'Retail shop / دکاندار',
        'restaurant' => 'Restaurant / Hotel / ریسٹورنٹ',
        'other' => 'Other / دیگر',
    ];

    public const INTERESTS = [
        'salt' => 'Salt / نمک',
        'masala' => 'Masala / مصالحہ جات',
        'both' => 'Both / دونوں',
    ];

    public const VOLUMES = [
        'under-50' => 'Under 50 bags (50kg) a month',
        '50-200' => '50 – 200 bags a month',
        '200-500' => '200 – 500 bags a month',
        'over-500' => 'Over 500 bags a month',
    ];

    public const STATUSES = [
        'new' => 'New',
        'contacted' => 'Contacted',
        'approved' => 'Approved',
        'rejected' => 'Not suitable',
    ];

    protected $fillable = [
        'name', 'phone', 'business_name', 'business_type', 'city',
        'monthly_volume', 'interest', 'message', 'status', 'admin_notes',
    ];

    public function label(string $field): ?string
    {
        $options = match ($field) {
            'business_type' => self::BUSINESS_TYPES,
            'interest' => self::INTERESTS,
            'monthly_volume' => self::VOLUMES,
            'status' => self::STATUSES,
        };

        return $options[$this->$field] ?? $this->$field;
    }
}
