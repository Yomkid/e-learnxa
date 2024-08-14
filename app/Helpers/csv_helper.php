<?php

if (!function_exists('csv_from_array')) {
    /**
     * Convert an array to CSV format
     *
     * @param array $data The array to convert
     * @param string $delimiter The delimiter to use in the CSV
     * @param string $enclosure The enclosure character to use in the CSV
     * @return string The CSV formatted string
     */
    function csv_from_array(array $data, string $delimiter = ',', string $enclosure = '"')
    {
        $handle = fopen('php://memory', 'r+');
        fputcsv($handle, array_keys(reset($data)), $delimiter, $enclosure);
        foreach ($data as $row) {
            fputcsv($handle, $row, $delimiter, $enclosure);
        }
        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);
        return $csv;
    }
}
