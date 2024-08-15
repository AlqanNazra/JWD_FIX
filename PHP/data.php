<?php
function hasiljumlah($data) 
{
    // Pastikan $data adalah array, jika tidak, ubah menjadi array dengan satu elemen
    if (!is_array($data)) {
        $data = [$data];
    }

    $total = 0;
    foreach ($data as $index) {
        $total += (int)$index;
    }
    return $total;
}

    function kosong($data)
    {
        echo "Anda belum memilih pesanan";
    }

?>