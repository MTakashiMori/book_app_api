<?php

namespace App\Http\Controllers;

class MainController extends Controller
{

    public function main()
    {
        $result = [];

        for ($i = 1; $i <= 100; $i++) {

            $a[0] = $this->checkDivisionBy($i, 15, 'ThreeAndFive');
            $a[1] = $this->checkDivisionBy($i, 5, 'Five');
            $a[2] = $this->checkDivisionBy($i, 3, 'Three');
            $a[3] = $this->checkDivisionBy($i, $i, $i);

            array_push($result, $this->assignTrueValue($a));

        }

        return $result;

    }

    public function checkDivisionBy($value, $division, $return)
    {
        if($value % $division === 0) {
            return $return;
        }
        return false;
    }

    public function assignTrueValue($arr)
    {
        return current(array_filter($arr));
    }

}
