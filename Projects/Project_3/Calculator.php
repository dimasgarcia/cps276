<?php

class Calculator {

    public function calc($operator, $num1 = null, $num2 = null) {
        // This is to check if the operator is valid
        if (!in_array($operator, ["+", "-", "*", "/"])) {
            return "<p>Cannot perform operation. Invalid operator. Only +, -, *, / are allowed.</p>";
        }
        
        // This is to check if both numbers are provided and are either integers or floats
        if (!is_numeric($num1) || !is_numeric($num2)) {
            return "<p>Cannot perform operation. You must provide two numbers as the second and third arguments.</p>";
        }

        // This is to check if both numbers are provided
        switch ($operator) {
            case "+":
                $result = $num1 + $num2;
                break;
            case "-":
                $result = $num1 - $num2;
                break;
            case "*":
                $result = $num1 * $num2;
                break;
            case "/":
                if ($num2 == 0) {
                    return "<p>The answer is cannot divide a number by zero.</p>";
                }
                $result = $num1 / $num2;
                break;
            default:
                return "<p>Cannot perform operation. Invalid operator.</p>";
        }

        // This is to return the result
        return "<p>The calculation is $num1 $operator $num2. The answer is $result.</p>";
    }
}

?>
