<?php

namespace App\Imports;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Throwable;

class StudentImport implements ToModel, WithHeadingRow, SkipsOnError, SkipsOnFailure
{
    use Importable,SkipsErrors, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      //dd( $row['sinifi']);
        $numbers= preg_replace('/[^0-9]/', '', $row['sinif']);
        $string = preg_replace('/[^A-Za-z\-]/', '', $row['sinif']);
        $sonuc = DB::table('levels')->select('id')
            ->where('level',intval($numbers))
            ->where('name', $string)
            ->first();

        //dd($sonuc->id);
        return new Student([
            'school_no' => $row['okul_no'],
            'name'     => $row['isim'],
            'lastname' => $row['soyisim'],
            'level_id' => $sonuc->id,
            'school_id'=>Auth::user()->school_id,
        ]);
    }

    public function onError(Throwable $error)
    {

    }
}
