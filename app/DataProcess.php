<?php

namespace App;

use League\Csv\Reader;

class DataProcess
{
    /**
     * File to process
     *
     * @var Illuminate\Http\UploadedFile
     */
    private $file;


    /**
     *
     * @param Illuminate\Http\UploadedFile
     *
     * @return void
     */
    public function __construct(\Illuminate\Http\UploadedFile $file)
    {
        $this->file = $file;
    }

    /**
     * Process uploaded file.
     *
     *
     * @return array
     */
    public function processCsv()
    {
        $success = 0;
        $error = [];

        $reader = Reader::createFromFileObject($this->file->openFile());
        $reader->setHeaderOffset(0);
        foreach ($reader->getRecords() as $line) {
            $item = $this->convertKeys($line);

            if (!$this->validateItem($item)) {
                $error[] = 'Not all keys set!';
                continue;
            }
            try {
                //load the item by product_code or create a new entry
                //fill the rest of the values from CSV
                $db_line = Data::firstOrCreate(
                    [
                        'product_code' => $item['product_code']
                    ],
                    [
                        'product_code' => (string) $item['product_code'],
                        'product_name' => (string) $item['product_name'],
                        'product_description' => (string) $item['product_description'],
                        'stock' => (int) $item['stock'],
                        'cost_in_g_b_p' => floatval($item['cost_in_g_b_p']),
                        'discontinued' => ( strtolower($item['discontinued']) == 'yes' ) ? true : false,
                    ]
                );

                $success++;
            } catch (\Exception $e) {
                $error[] = $e->getMessage();
            }
        }

        return ['success' => $success, 'error' => $error];
    }

    /**
     * Convert keys to snake case
     *
     * @param array
     *
     * @return array
     */
    private function convertKeys($line)
    {
        $_line = [];
        foreach ($line as $key => $value) {
            $_line[snake_case($key)] = $value;
        }
        return $_line;
    }

    /**
     * Check if all keys are set
     *
     * @param array
     *
     * @return boolean
     */
    private function validateItem($item)
    {
        if (!isset($item['product_code']) ||
            !isset($item['product_name']) ||
            !isset($item['product_description']) ||
            !isset($item['stock']) ||
            !isset($item['cost_in_g_b_p']) ||
            !isset($item['discontinued'])) {
            return false;
        }

        return true;
    }
}
