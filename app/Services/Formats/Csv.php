<?php

namespace App\Services\Formats;

use App\Contracts\FormatInterface;

class Csv implements FormatInterface
{

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
        return response()->stream(function () use ($data) {
            // Prepare csv file
            $file = fopen('php://output', 'w');
            fputcsv($file, array_keys($data[0]));

            foreach ($data as $item) {
                fputcsv($file, array_values($item));
            }

            fclose($file);
        }, 200, $headers);
    }
}
