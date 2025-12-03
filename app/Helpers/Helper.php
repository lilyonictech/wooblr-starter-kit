<?php

if (!function_exists('actionLabels')) {
    function actionLabels($key = null)
    {
        $actionLabels = [
            'viewAny'   => 'Melihat',
            'view'      => 'Detail',
            'create'    => 'Membuat',
            'edit'      => 'Mengubah',
            'delete'    => 'Menghapus',
            'publish'   => 'Menerbitkan',
        ];
        return $actionLabels[$key] ?? 'Unknown';
    }
}
