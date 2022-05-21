<?php

namespace App\Services;


use App\Exceptions\FileNotFoundException;
use Exception;

class FileService
{

    /**
     * Read CSV into associative array
     *
     * @param $filePath
     * @return array
     * @throws FileNotFoundException
     */
    public static function readCSV($filePath): array
    {
        try {
            $csv = array_map("str_getcsv", file($filePath, FILE_SKIP_EMPTY_LINES));
        } catch (Exception $e) {
            throw new FileNotFoundException($filePath . " was not found");
        }

        try {
            $keys = array_shift($csv);
            foreach ($csv as $i => $row) {
                $csv[$i] = array_combine($keys, $row);
            }
        } catch (Exception $e) {
            throw new Exception($filePath . " could not be parsed due to unknown errors");
        }
        return $csv;
    }

}
