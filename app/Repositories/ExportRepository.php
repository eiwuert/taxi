<?php

namespace App\Repositories;

use Maatwebsite\Excel\Facades\Excel;


class ExportRepository
{
    /**
     * Export given model to given format.
     * @param  string $name
     * @param  Model $model
     * @param  string $type
     * @param  string $sheet
     * @return download
     */
    public static function from($name, $model, $type = 'pdf', $sheet = 'Sheet')
    {
        Excel::create($name, function ($excel) use (&$model, &$sheet) {
            $excel->sheet($sheet, function ($sheet) use (&$model) {
                $sheet->fromArray($model);
            });
        })->download($type);
    }
}
