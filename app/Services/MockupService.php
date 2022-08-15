<?php

namespace App\Services;

use App\Http\Requests\MakeMockupRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Intervention\Image\Gd\Font;
use ZipArchive;

class MockupService
{
    /**
     * @var array
     */
    private array $settings;

    /**
     * @var array
     */
    private array $files;

    public function __construct()
    {
        $this->settings = $this->settings();
    }

    /**
     * @return array
     */
    private function settings(): array
    {
        return [
            'name'       => 'RC Suresnes Seniors 2',
            'images'     => [
                'green'      => public_path('img/green.jpg'),
                'green_line' => public_path('img/green-line.jpg'),
                'logo'       => public_path('img/logo.png'),
            ],
            'fonts'      => [
                'verdana' => [
                    'italic' => public_path('fonts/verdana-bold-italic.ttf'),
                    'bold'   => public_path('fonts/verdana-bold.ttf'),
                ],
            ],
            'playerSize' => [50, 70],
            'exportPath' => storage_path('app/public/kit'),
            'positions'  => [
                1  => ['bottom-right', 65, 25],
                2  => ['bottom-right', 132, 22],
                3  => ['bottom-right', 205, 25],
                4  => ['bottom-right', 102, 110],
                5  => ['bottom-right', 170, 112],
                6  => ['bottom-right', 65, 200],
                7  => ['bottom-right', 132, 210],
                8  => ['bottom-right', 205, 200],
                9  => ['bottom-right', 99, 305],
                10 => ['bottom-right', 175, 300],
                11 => ['top-left', 18, 70],
                12 => ['top-right', 100, 105],
                13 => ['top-left', 95, 105],
                14 => ['top-right', 15, 72],
                15 => ['top-left', 135, 15],
            ],
        ];
    }

    /**
     * @return void
     */
    public function makeAllFiles(): void
    {
        $this->makePresentation();

        $zip = new ZipArchive;
        $zip->open(storage_path('app/public/kit/kit.zip'), ZipArchive::CREATE | ZipArchive::OVERWRITE);

        foreach ($this->files as $file) {
            $zip->addFile($file);
        }

        $zip->close();
    }

    /**
     * @return void
     */
    private function makePresentation(): void
    {
        $green = Image::make($this->settings['images']['green']);
        $logo = Image::make($this->settings['images']['logo']);

        $enemyLogo = Image::make($this->request->file('enemyLogo'));

        $presentation = $green
            ->text(Str::upper('La composition'),
                (int)($green->getWidth() / 2),
                75 * 2,
                function (Font $font) {
                    $font->file($this->settings['fonts']['verdana']['italic']);
                    $font->size(75);
                    $font->align('center');
                    $font->color('#fff');
                }
            )->text(Str::upper($this->request->get('enemyName')),
                (int)($green->getWidth() / 2),
                75 * 3,
                function (Font $font) {
                    $font->file($this->settings['fonts']['verdana']['bold']);
                    $font->size(50);
                    $font->align('center');
                    $font->color('#000');
                }
            )->text(Str::upper($this->settings['name']),
                (int)($green->getWidth() / 2),
                75 * 3 + 50,
                function (Font $font) {
                    $font->file($this->settings['fonts']['verdana']['bold']);
                    $font->size(50);
                    $font->align('center');
                    $font->color('#000');
                }
            )->insert($enemyLogo, 'left', (int)($enemyLogo->getWidth() / 2))
            ->insert($logo, 'right', (int)($logo->getWidth() / 2))
            ->text($this->request->get('where'),
                (int)($green->getWidth() / 2),
                $green->getHeight() - 50,
                function (Font $font) {
                    $font->file($this->settings['fonts']['verdana']['bold']);
                    $font->size(25);
                    $font->align('center');
                    $font->color('#fff');
                }
            );

        Storage::disk('public')->makeDirectory('kit');

        $filePath = $this->settings['exportPath'] . '/presentation.jpg';

        $presentation->save($filePath, 100);

        $this->files['presentation'] = $filePath;
    }
}
