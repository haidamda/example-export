<?php

namespace App\Http\Controllers;

use App\Models\User;
use Rap2hpoutre\FastExcel\FastExcel;
use Rap2hpoutre\FastExcel\SheetCollection;

class ExportController
{
    public function export()
    {
        $amount = 20000;
        $users = [];
        User::chunk($amount, function ($records) use (&$users) {
            $users[] = $records;
        });
        $sheets = new SheetCollection($users);
        // Export
        return (new FastExcel($sheets))->download('file.xlsx');
    }
}
