<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScreenTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $screenTypes = [
            [
                'name'          => 'LED',
                'description'   => 'A light-emitting diode (LED) is a semiconductor light source that emits light when current flows through it.'
            ],
            [
                'name'          => 'LCD',
                'description'   => 'A liquid-crystal display (LCD) is a flat-panel display or other electronically modulated optical device that uses the light-modulating properties of liquid crystals.'
            ],
            [
                'name'          => 'OLED',
                'description'   => 'An organic light-emitting diode (OLED) is a light-emitting diode (LED) in which the emissive electroluminescent layer is a film of organic compound that emits light in response to an electric current.'
            ],
            [
                'name'          => 'Plasma',
                'description'   => 'A plasma display panel (PDP) is a type of flat panel display that uses small cells containing plasma; ionized gas that responds to electric fields.'
            ],
            [
                'name'          => 'CRT',
                'description'   => 'A cathode-ray tube (CRT) is a vacuum tube containing one or more electron guns, the beams of which are manipulated to display images on a phosphorescent screen.'
            ],
            [
                'name'          => 'DLP',
                'description'   => 'A digital light processing (DLP) is a display device based on micro-electro-mechanical technology that uses a digital micromirror device.'
            ],
        ];

        foreach ($screenTypes as $screenType) {
            \App\Models\ScreenType::create($screenType);
        }
    }
}
