<?php
$target = __DIR__ . '/storage/app/public';
$link = __DIR__ . '/public/storage';

if (file_exists($link)) {
    echo "❌ Folder 'public/storage' sudah ada. Harap hapus dulu agar bisa buat symbolic link.";
    exit;
}

if (symlink($target, $link)) {
    echo "✅ Symbolic link berhasil dibuat: public/storage → storage/app/public";
} else {
    echo "❌ Gagal membuat symbolic link. Mungkin server tidak mengizinkan symlink()";
}
