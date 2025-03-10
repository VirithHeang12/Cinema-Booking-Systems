<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            [
                'name' => 'Afghanistan'
            ],
            [
                'name' => 'Albania'
            ],
            [
                'name' => 'Algeria'
            ],
            [
                'name' => 'Andorra'
            ],
            [
                'name' => 'Angola'
            ],
            [
                'name' => 'Antigua and Barbuda'
            ],
            [
                'name' => 'Argentina'
            ],
            [
                'name' => 'Armenia'
            ],
            [
                'name' => 'Australia'
            ],
            [
                'name' => 'Austria'
            ],
            [
                'name' => 'Azerbaijan'
            ],
            [
                'name' => 'Bahamas'
            ],
            [
                'name' => 'Bahrain'
            ],
            [
                'name' => 'Bangladesh'
            ],
            [
                'name' => 'Barbados'
            ],
            [
                'name' => 'Belarus'
            ],
            [
                'name' => 'Belgium'
            ],
            [
                'name' => 'Belize'
            ],
            [
                'name' => 'Benin'
            ],
            [
                'name' => 'Bhutan'
            ],
            [
                'name' => 'Bolivia'
            ],
            [
                'name' => 'Bosnia and Herzegovina'
            ],
            [
                'name' => 'Botswana'
            ],
            [
                'name' => 'Brazil'
            ],
            [
                'name' => 'Brunei'
            ],
            [
                'name' => 'Bulgaria'
            ],
            [
                'name' => 'Burkina Faso'
            ],
            [
                'name' => 'Burundi'
            ],
            [
                'name' => 'Cabo Verde'
            ],
            [
                'name' => 'Cambodia'
            ],
            [
                'name' => 'Cameroon'
            ],
            [
                'name' => 'Canada'
            ],
            [
                'name' => 'Central African Republic'
            ],
            [
                'name' => 'Chad'
            ],
            [
                'name' => 'Chile'
            ],
            [
                'name' => 'China'
            ],
            [
                'name' => 'Colombia'
            ],
            [
                'name' => 'Comoros'
            ],
            [
                'name' => 'Congo'
            ],
            [
                'name' => 'Costa Rica'
            ],
            [
                'name' => 'Croatia'
            ],
            [
                'name' => 'Cuba'
            ],
            [
                'name' => 'Cyprus'
            ],
            [
                'name' => 'Czechia'
            ],
            [
                'name' => 'Denmark'
            ],
            [
                'name' => 'Djibouti'
            ],
            [
                'name' => 'Dominica'
            ],
            [
                'name' => 'Dominican Republic'
            ],
            [
                'name' => 'Ecuador'
            ],
            [
                'name' => 'Egypt'
            ],
            [
                'name' => 'El Salvador'
            ],
            [
                'name' => 'Equatorial Guinea'
            ],
            [
                'name' => 'Eritrea'
            ],
            [
                'name' => 'Estonia'
            ],
            [
                'name' => 'Eswatini'
            ],
            [
                'name' => 'Ethiopia'
            ],
            [
                'name' => 'Fiji'
            ],
            [
                'name' => 'Finland'
            ],
            [
                'name' => 'France'
            ],
            [
                'name' => 'Gabon'
            ],
            [
                'name' => 'Gambia'
            ],
            [
                'name' => 'Georgia'
            ],
            [
                'name' => 'Germany'
            ],
            [
                'name' => 'Ghana'
            ],
            [
                'name' => 'Greece'
            ],
            [
                'name' => 'Grenada'
            ],
            [
                'name' => 'Guatemala'
            ],
            [
                'name' => 'Guinea'
            ],
            [
                'name' => 'Guinea-Bissau'
            ],
            [
                'name' => 'Guyana'
            ],
            [
                'name' => 'Haiti'
            ],
            [
                'name' => 'Honduras'
            ],
            [
                'name' => 'Hungary'
            ],
            [
                'name' => 'Iceland'
            ],
            [
                'name' => 'India'
            ],
            [
                'name' => 'Indonesia'
            ],
            [
                'name' => 'Iran'
            ],
            [
                'name' => 'Iraq'
            ],
            [
                'name' => 'Ireland'
            ],
            [
                'name' => 'Israel'
            ],
            [
                'name' => 'Italy'
            ],
            [
                'name' => 'Jamaica'
            ],
            [
                'name' => 'Japan'
            ],
            [
                'name' => 'Jordan'
            ],
            [
                'name' => 'Kazakhstan'
            ],
            [
                'name' => 'Kenya'
            ],
            [
                'name' => 'Kiribati'
            ],
            [
                'name' => 'Kuwait'
            ],
            [
                'name' => 'Kyrgyzstan'
            ],
            [
                'name' => 'Laos'
            ],
            [
                'name' => 'Latvia'
            ],
            [
                'name' => 'Lebanon'
            ],
            [
                'name' => 'Lesotho'
            ],
            [
                'name' => 'Liberia'
            ],
            [
                'name' => 'Libya'
            ],
            [
                'name' => 'Liechtenstein'
            ],
            [
                'name' => 'Lithuania'
            ],
            [
                'name' => 'Luxembourg'
            ],
            [
                'name' => 'Madagascar'
            ],
            [
                'name' => 'Malawi'
            ],
            [
                'name' => 'Malaysia'
            ],
            [
                'name' => 'Maldives'
            ],
            [
                'name' => 'Mali'
            ],
            [
                'name' => 'Malta'
            ],
            [
                'name' => 'Mauritania'
            ],
            [
                'name' => 'Mauritius'
            ]
        ];


        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
