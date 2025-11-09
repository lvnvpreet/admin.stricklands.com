<?php

namespace Vanguard\Helpers;

class VehicleOptionsHelper{

    /**
     * @param string $option
     * @return array
     */
    public static function getAlloptionByCodes(string $codestring){
        $options = [];
        $codes = explode('|',$codestring);
        foreach ($codes as $option){
            if (strtoupper($option) == "DRBB")   $options[] = "Previous Rental";
            if (strtoupper($option) == "BLUE")   $options[] = "Bluetooth";
            if (strtoupper($option) == "HUD")    $options[] = "Heads Up Display";
            if (strtoupper($option) == "XM")     $options[] = "XM Radio";
            if (strtoupper($option) == "RCAM") 	 $options[] = "Rear Backup Camera";
            if (strtoupper($option) == "SIRRA")  $options[] = "Sirius Sattelite Radio";
            if (strtoupper($option) == "2.0L") 	 $options[] = "2.0LITER";
            if (strtoupper($option) == "2.7L") 	 $options[] = "2.7LITER";
            if (strtoupper($option) == "20WH") 	 $options[] = "20 INCH WHEELS";
            if (strtoupper($option) == "2TOPS")  $options[] = "2 TOPS";
            if (strtoupper($option) == "2WD") 	 $options[] = "2.0LITER";
            if (strtoupper($option) == "2YTRA")  $options[] = "2 YEAR OLD TRANSMISSION";
            if (strtoupper($option) == "3.1L") 	 $options[] = "3.1LITER";
            if (strtoupper($option) == "3.3L") 	 $options[] = "3.3LITER";
            if (strtoupper($option) == "3.5L") 	 $options[] = "3.5LITER";
            if (strtoupper($option) == "3.6L") 	 $options[] = "3.6LITER";
            if (strtoupper($option) == "3.8L") 	 $options[] = "3.8LITER";
            if (strtoupper($option) == "3/4TO")  $options[] = "3/4 TONNE PACKAGE";
            if (strtoupper($option) == "3S") 	 $options[] = "Third Rear Seat";
            if (strtoupper($option) == "4.5L") 	 $options[] = "4.6LITER";
            if (strtoupper($option) == "4WD") 	 $options[] = "4 WHEEL DRIVE";
            if (strtoupper($option) == "4X4") 	 $options[] = "4X4";
            if (strtoupper($option) == "5.4L") 	 $options[] = "5.4LITER";
            if (strtoupper($option) == "5.7L") 	 $options[] = "5.7LITER HEMI";
            if (strtoupper($option) == "5PASS")  $options[] = "5 PASSENGER";
            if (strtoupper($option) == "6P") 	 $options[] = "6 Passenger";
            if (strtoupper($option) == "7P") 	 $options[] = "7 Passenger";
            if (strtoupper($option) == "8P") 	 $options[] = "8 Passenger";
            if (strtoupper($option) == "A") 	 $options[] = "Air";
            if (strtoupper($option) == "ACCRP")  $options[] = "ACCIDENT REPAIR";
            if (strtoupper($option) == "ADTR") 	 $options[] = "ADVANCE TRAC";
            if (strtoupper($option) == "ADVTR")  $options[] = "ADVANCED TRAC";
            if (strtoupper($option) == "ALL") 	 $options[] = "Alloy Wheels";
            if (strtoupper($option) == "AWD") 	 $options[] = "All Wheel Drive";
            if (strtoupper($option) == "BB") 	 $options[] = "BUSH BAR";
            if (strtoupper($option) == "BOES") 	 $options[] = "BOES STEREO";
            if (strtoupper($option) == "BOX") 	 $options[] = "Boxliner";
            if (strtoupper($option) == "BS") 	 $options[] = "BUMPER SENSOR";
            if (strtoupper($option) == "BUMP") 	 $options[] = "BUMP SENSORS";
            if (strtoupper($option) == "BUSH") 	 $options[] = "BUSH BAR";
            if (strtoupper($option) == "C") 	 $options[] = "Cruise";
            if (strtoupper($option) == "CA") 	 $options[] = "STEREO CASSETTE";
            if (strtoupper($option) == "CD") 	 $options[] = "Stereo CD";
            if (strtoupper($option) == "CH") 	 $options[] = "Chrome Wheels";
            if (strtoupper($option) == "CHAIR")  $options[] = "CHAIRLIFT";
            if (strtoupper($option) == "CHILD")  $options[] = "CHILD SEAT";
            if (strtoupper($option) == "CL") 	 $options[] = "CLIMATE";
            if (strtoupper($option) == "COM") 	 $options[] = "COMPASS";
            if (strtoupper($option) == "CPACK")  $options[] = "C PACKAGE";
            if (strtoupper($option) == "D") 	 $options[] = "DURATEC";
            if (strtoupper($option) == "DC") 	 $options[] = "DUAL CLIMATE CONTROL";
            if (strtoupper($option) == "DD") 	 $options[] = "DUTCH DOORS";
            if (strtoupper($option) == "DGR") 	 $options[] = "DUAL GLASS ROOF";
            if (strtoupper($option) == "DIES") 	 $options[] = "DIESEL";
            if (strtoupper($option) == "DIES") 	 $options[] = "DIESEL";
            if (strtoupper($option) == "DPR") 	 $options[] = "DUAL PWR ROOFS";
            if (strtoupper($option) == "DVD") 	 $options[] = "DVD Player";
            if (strtoupper($option) == "ETEST")  $options[] = "VALID E TEST";
            if (strtoupper($option) == "EVERY")  $options[] = "EVERYTHING AVAILABLE";
            if (strtoupper($option) == "EXTW") 	 $options[] = "EXTENDED WARRANTY";
            if (strtoupper($option) == "FF") 	 $options[] = "FLEX FUEL";
            if (strtoupper($option) == "GTPKG")  $options[] = "GT PACKAGE";
            if (strtoupper($option) == "HEMI") 	 $options[] = "HEMI";
            if (strtoupper($option) == "HIT") 	 $options[] = "HITCH";
            if (strtoupper($option) == "HS") 	 $options[] = "Heated Seat";
            if (strtoupper($option) == "HTOP") 	 $options[] = "Hard Top";
            if (strtoupper($option) == "HUD") 	 $options[] = "";
            if (strtoupper($option) == "L") 	 $options[] = "Leather Interior";
            if (strtoupper($option) == "L/C") 	 $options[] = "LEATHER/CLOTH";
            if (strtoupper($option) == "LIVE") 	 $options[] = "FULL LIVING ACCOMODATIONS";
            if (strtoupper($option) == "LOAD") 	 $options[] = "LOADING RAMP";
            if (strtoupper($option) == "LUX") 	 $options[] = "LUXURY PACKAGE";
            if (strtoupper($option) == "MP3") 	 $options[] = "MP3 PLAYER";
            if (strtoupper($option) == "MR") 	 $options[] = "MOOR ROOF";
            if (strtoupper($option) == "MTOP") 	 $options[] = "MATCHING TOPPER";
            if (strtoupper($option) == "NAV") 	 $options[] = "Navigation System";
            if (strtoupper($option) == "NEV") 	 $options[] = "NEVADA PACKAGE";
            if (strtoupper($option) == "OFFR") 	 $options[] = "OFF ROAD PACKAGE";
            if (strtoupper($option) == "ON") 	 $options[] = "Onstar";
            if (strtoupper($option) == "PANA") 	 $options[] = "PANA ROOF";
            if (strtoupper($option) == "PANR") 	 $options[] = "Panoramic Roof";
            if (strtoupper($option) == "PDR") 	 $options[] = "Power Doors";
            if (strtoupper($option) == "PL") 	 $options[] = "Power Locks";
            if (strtoupper($option) == "PLPKG")  $options[] = "PLUS PACKAGE";
            if (strtoupper($option) == "PM") 	 $options[] = "Power Mirrors";
            if (strtoupper($option) == "PP") 	 $options[] = "PWR PEDDLES";
            if (strtoupper($option) == "PR") 	 $options[] = "Power Moonroof";
            if (strtoupper($option) == "PS") 	 $options[] = "Power Seats";
            if (strtoupper($option) == "PSR") 	 $options[] = "PWR SKYVIEW ROOF";
            if (strtoupper($option) == "PW") 	 $options[] = "Power Windows";
            if (strtoupper($option) == "PWDR") 	 $options[] = "Power Doors";
            if (strtoupper($option) == "Q") 	 $options[] = "Quad Seats";
            if (strtoupper($option) == "RA") 	 $options[] = "Radio";
            if (strtoupper($option) == "RAMA") 	 $options[] = "RAM AIR";
            if (strtoupper($option) == "RH") 	 $options[] = "Rear Heat";
            if (strtoupper($option) == "RIM") 	 $options[] = "20 INCH RIMS";
            if (strtoupper($option) == "RPG") 	 $options[] = "REAR POWER GROUP";
            if (strtoupper($option) == "RPW") 	 $options[] = "REAR POWER WINDOWS";
            if (strtoupper($option) == "RR") 	 $options[] = "Rear A/C";
            if (strtoupper($option) == "RRR") 	 $options[] = "REAR POWER ROOF";
            if (strtoupper($option) == "RS") 	 $options[] = "Rear Spoiler";
            if (strtoupper($option) == "RUN") 	 $options[] = "Running Boards";
            if (strtoupper($option) == "RUST") 	 $options[] = "RUST PROTECTION";
            if (strtoupper($option) == "SATRA")  $options[] = "Satellite Radio";
            if (strtoupper($option) == "SHBOX")  $options[] = "SHORTBOX";
            if (strtoupper($option) == "SHEL") 	 $options[] = "SHELVES";
            if (strtoupper($option) == "SIDE") 	 $options[] = "SIDEBARS";
            if (strtoupper($option) == "SKY") 	 $options[] = "Skylight Roof";
            if (strtoupper($option) == "SLRW") 	 $options[] = "SLIDING REAR WINDOW";
            if (strtoupper($option) == "SP") 	 $options[] = "STEREO PACKAGE";
            if (strtoupper($option) == "SPEC") 	 $options[] = "SPECIAL EDITION";
            if (strtoupper($option) == "SPP") 	 $options[] = "Sport Package";
            if (strtoupper($option) == "ST") 	 $options[] = "SOFT TOP";
            if (strtoupper($option) == "STAR") 	 $options[] = "Remote Starter";
            if (strtoupper($option) == "START")  $options[] = "Remote Starter";
            if (strtoupper($option) == "STEP") 	 $options[] = "STEPSIDE";
            if (strtoupper($option) == "STOP") 	 $options[] = "SOFT TOP";
            if (strtoupper($option) == "SUN") 	 $options[] = "Sunroof";
            if (strtoupper($option) == "T") 	 $options[] = "Tilt Steering";
            if (strtoupper($option) == "TBAR") 	 $options[] = "TBAR ROOF";
            if (strtoupper($option) == "TON") 	 $options[] = "Tonneau Cover";
            if (strtoupper($option) == "TOP") 	 $options[] = "TOPPER";
            if (strtoupper($option) == "TOW") 	 $options[] = "Towing Package";
            if (strtoupper($option) == "TRD") 	 $options[] = "TRD Package";
            if (strtoupper($option) == "TV") 	 $options[] = "TV";
            if (strtoupper($option) == "UNDER")  $options[] = "UNDERCOATED";
            if (strtoupper($option) == "V6") 	 $options[] = "V6";
            if (strtoupper($option) == "V8MAG")  $options[] = "V8 MAGNUM";
            if (strtoupper($option) == "VCR") 	 $options[] = "VCR PLAYER";
            if (strtoupper($option) == "WOOD") 	 $options[] = "WOODGRAIN ENHANCED";
            if (strtoupper($option) == "ZR2") 	 $options[] = "HIGHBOY ZR2 PACKAGE";
        }

        return (count($options)) ? $options : false;
    }

    
}
