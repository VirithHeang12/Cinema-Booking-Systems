<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            ['name' => 'Afrikaans', 'code' => 'af'],
            ['name' => 'Albanian', 'code' => 'sq'],
            ['name' => 'Amharic', 'code' => 'am'],
            ['name' => 'Arabic', 'code' => 'ar'],
            ['name' => 'Armenian', 'code' => 'hy'],
            ['name' => 'Azerbaijani', 'code' => 'az'],
            ['name' => 'Basque', 'code' => 'eu'],
            ['name' => 'Belarusian', 'code' => 'be'],
            ['name' => 'Bengali', 'code' => 'bn'],
            ['name' => 'Bosnian', 'code' => 'bs'],
            ['name' => 'Bulgarian', 'code' => 'bg'],
            ['name' => 'Catalan', 'code' => 'ca'],
            ['name' => 'Cebuano', 'code' => 'ceb'],
            ['name' => 'Chinese', 'code' => 'zh'],
            ['name' => 'Corsican', 'code' => 'co'],
            ['name' => 'Croatian', 'code' => 'hr'],
            ['name' => 'Czech', 'code' => 'cs'],
            ['name' => 'Danish', 'code' => 'da'],
            ['name' => 'Dutch', 'code' => 'nl'],
            ['name' => 'English', 'code' => 'en'],
            ['name' => 'Esperanto', 'code' => 'eo'],
            ['name' => 'Estonian', 'code' => 'et'],
            ['name' => 'Finnish', 'code' => 'fi'],
            ['name' => 'French', 'code' => 'fr'],
            ['name' => 'Galician', 'code' => 'gl'],
            ['name' => 'Georgian', 'code' => 'ka'],
            ['name' => 'German', 'code' => 'de'],
            ['name' => 'Greek', 'code' => 'el'],
            ['name' => 'Gujarati', 'code' => 'gu'],
            ['name' => 'Haitian Creole', 'code' => 'ht'],
            ['name' => 'Hausa', 'code' => 'ha'],
            ['name' => 'Hebrew', 'code' => 'he'],
            ['name' => 'Hindi', 'code' => 'hi'],
            ['name' => 'Hungarian', 'code' => 'hu'],
            ['name' => 'Icelandic', 'code' => 'is'],
            ['name' => 'Indonesian', 'code' => 'id'],
            ['name' => 'Irish', 'code' => 'ga'],
            ['name' => 'Italian', 'code' => 'it'],
            ['name' => 'Japanese', 'code' => 'ja'],
            ['name' => 'Javanese', 'code' => 'jv'],
            ['name' => 'Kannada', 'code' => 'kn'],
            ['name' => 'Kazakh', 'code' => 'kk'],
            ['name' => 'Khmer', 'code' => 'km'],
            ['name' => 'Korean', 'code' => 'ko'],
            ['name' => 'Kurdish', 'code' => 'ku'],
            ['name' => 'Kyrgyz', 'code' => 'ky'],
            ['name' => 'Lao', 'code' => 'lo'],
            ['name' => 'Latvian', 'code' => 'lv'],
            ['name' => 'Lithuanian', 'code' => 'lt'],
            ['name' => 'Macedonian', 'code' => 'mk'],
            ['name' => 'Malay', 'code' => 'ms'],
            ['name' => 'Malayalam', 'code' => 'ml'],
            ['name' => 'Maltese', 'code' => 'mt'],
            ['name' => 'Maori', 'code' => 'mi'],
            ['name' => 'Marathi', 'code' => 'mr'],
            ['name' => 'Mongolian', 'code' => 'mn'],
            ['name' => 'Nepali', 'code' => 'ne'],
            ['name' => 'Norwegian', 'code' => 'no'],
            ['name' => 'Pashto', 'code' => 'ps'],
            ['name' => 'Persian', 'code' => 'fa'],
            ['name' => 'Polish', 'code' => 'pl'],
            ['name' => 'Portuguese', 'code' => 'pt'],
            ['name' => 'Punjabi', 'code' => 'pa'],
            ['name' => 'Romanian', 'code' => 'ro'],
            ['name' => 'Russian', 'code' => 'ru'],
            ['name' => 'Samoan', 'code' => 'sm'],
            ['name' => 'Serbian', 'code' => 'sr'],
            ['name' => 'Sinhala', 'code' => 'si'],
            ['name' => 'Slovak', 'code' => 'sk'],
            ['name' => 'Slovenian', 'code' => 'sl'],
            ['name' => 'Somali', 'code' => 'so'],
            ['name' => 'Spanish', 'code' => 'es'],
            ['name' => 'Sundanese', 'code' => 'su'],
            ['name' => 'Swahili', 'code' => 'sw'],
            ['name' => 'Swedish', 'code' => 'sv'],
            ['name' => 'Tagalog', 'code' => 'tl'],
            ['name' => 'Tajik', 'code' => 'tg'],
            ['name' => 'Tamil', 'code' => 'ta'],
            ['name' => 'Telugu', 'code' => 'te'],
            ['name' => 'Thai', 'code' => 'th'],
            ['name' => 'Turkish', 'code' => 'tr'],
            ['name' => 'Ukrainian', 'code' => 'uk'],
            ['name' => 'Urdu', 'code' => 'ur'],
            ['name' => 'Uzbek', 'code' => 'uz'],
            ['name' => 'Vietnamese', 'code' => 'vi'],
            ['name' => 'Welsh', 'code' => 'cy'],
            ['name' => 'Xhosa', 'code' => 'xh'],
            ['name' => 'Yiddish', 'code' => 'yi'],
            ['name' => 'Yoruba', 'code' => 'yo'],
            ['name' => 'Zulu', 'code' => 'zu']
        ];

        foreach ($languages as $language) {
            Language::create($language);
        }

    }
}
