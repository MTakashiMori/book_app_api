<?php

namespace App\Models;

use Exception;
use App\Constants\SqlInjectionWords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AbstractModel extends Model
{

    use HasFactory;

    /**
     * @var array
     */
    protected $hidden = [];

    /**
     * @param $query Builder
     * @param $param
     * @return mixed
     */
    public function scopeLike($query, $param)
    {
        collect($param)->each(function ($value, $name) use ($query) {

            if(is_numeric($value)) {
                $query->where(
                    $name,
                    $value
                );
                return true;
            }

            $this->sanitizeInput(strtoupper($value), strtoupper($name));

            if(strtoupper($value) === 'TRUE' || strtoupper($value) === 'FALSE') {
                $query->where(
                    $name,
                    (filter_var($value, FILTER_VALIDATE_BOOLEAN))
                );
                return true;
            }

            $query->where(
                DB::raw("unaccent(UPPER($name))"),
//                DB::raw("UPPER($name)"),
                'LIKE',
                DB::raw("unaccent(UPPER('%" . str_replace("'", '', $value) . "%'))")
//                DB::raw("UPPER('%" . str_replace("'", '', $value) . "%')")
            );

            return true;

        });

        return $query;
    }

    /**
     * @param $value string
     * @param $name string
     */
    private function sanitizeInput($value, $name)
    {
        $valuesError = collect((new SqlInjectionWords())->returnArray());

        $valuesError->each(function($sqlExpression) use ($value, $name) {

            if(strpos($value, $sqlExpression) !== false || strpos($name, $sqlExpression) !== false) {
                throw new Exception('Attempt to a SQL injection', 403);
            }

        });
        return;
    }

}
