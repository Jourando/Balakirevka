<?php

$zip = zip_open("/tmp/test2.zip");

if ($zip) {
    while ($zip_entry = zip_read($zip)) {
        echo "Название:         " . zip_entry_name($zip_entry) . "\n";
        echo "Исходный размер:  " . zip_entry_filesize($zip_entry) . "\n";
        echo "Сжатый размер:    " . zip_entry_compressedsize($zip_entry) . "\n";
        echo "Метод сжатия:     " . zip_entry_compressionmethod($zip_entry) . "\n";

        if (zip_entry_open($zip, $zip_entry, "r")) {
            echo "Содержимое файла:\n";
            $buf = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
            echo "$buf\n";

            zip_entry_close($zip_entry);
        }
        echo "\n";

    }

    zip_close($zip);

}
?>