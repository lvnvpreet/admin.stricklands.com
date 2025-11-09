<?php

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleSM360 extends Model
{

    protected $table = 'vehicles_sm360';

    public $timestamps = false;

    public $fillable = [
            "d_id",
            "dealer_name",
            "dealer_address",
            "dealer_city",
            "dealer_region",
            "dealer_postal",
            "dealer_phone",
            "v_id",
            "remote_date_modified",
            "remote_date_entered",
            "stock",
            "vin",
            "status",
            "year",
            "make",
            "model",
            "trim",
            "body",
            "doors",
            "drive",
            "transmission",
            "fuel",
            "eng_cyl",
            "eng_desc",
            "extcolour",
            "intcolour",
            "is_certified",
            "is_demo",
            "is_new",
            "category",
            "odometer",
            "warranty",
            "passenger",
            "standard_price",
            "photo",
            "option",
            "special_mentions",
            "in_service_date",
            "external_url",
            "main_photo",
            "regular_price",
            "sale_price",
            "video_en",
            "video_fr",
            "stock_status"
        ];
}
