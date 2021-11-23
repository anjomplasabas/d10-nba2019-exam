<?php

namespace App\Services\Formats;

use App\Contracts\FormatInterface;

class Xml implements FormatInterface
{

    /**
     * @var string
     */
    const KEY_MAP = [
        'zero',
        'one',
        'two',
        'three',
        'four',
        'five',
        'six',
        'seven',
        'eight',
        'nine'
    ];

    /**
     * @var string
     */
    const FILE_NAME = 'export.csv';

    /**
     * @param array|null $data
     * @return mixed
     */
    public function format(?array $data)
    {
        // Set response headers
        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=' . self::FILE_NAME,
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];
        // Prepare XML
        $count = 0;
        foreach ($data as $item) {
            $xmlRow = [];
            foreach ($item as $key => $value) {
                $key = preg_replace_callback('(\d)', function ($matches) {
                    return self::KEY_MAP[$matches[0]] . '_';
                }, $key);
                $xmlRow[$key] = $value;
            }
            $xmlData['_'.$count] = $xmlRow;
            $count++;
        }
        
        return response()->xml($xmlData);
    }
}
