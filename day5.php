<?php
$program = [3,225,1,225,6,6,1100,1,238,225,104,0,1101,11,91,225,1002,121,77,224,101,-6314,224,224,4,224,1002,223,8,223,1001,224,3,224,1,223,224,223,1102,74,62,225,1102,82,7,224,1001,224,-574,224,4,224,102,8,223,223,1001,224,3,224,1,224,223,223,1101,28,67,225,1102,42,15,225,2,196,96,224,101,-4446,224,224,4,224,102,8,223,223,101,6,224,224,1,223,224,223,1101,86,57,225,1,148,69,224,1001,224,-77,224,4,224,102,8,223,223,1001,224,2,224,1,223,224,223,1101,82,83,225,101,87,14,224,1001,224,-178,224,4,224,1002,223,8,223,101,7,224,224,1,223,224,223,1101,38,35,225,102,31,65,224,1001,224,-868,224,4,224,1002,223,8,223,1001,224,5,224,1,223,224,223,1101,57,27,224,1001,224,-84,224,4,224,102,8,223,223,1001,224,7,224,1,223,224,223,1101,61,78,225,1001,40,27,224,101,-89,224,224,4,224,1002,223,8,223,1001,224,1,224,1,224,223,223,4,223,99,0,0,0,677,0,0,0,0,0,0,0,0,0,0,0,1105,0,99999,1105,227,247,1105,1,99999,1005,227,99999,1005,0,256,1105,1,99999,1106,227,99999,1106,0,265,1105,1,99999,1006,0,99999,1006,227,274,1105,1,99999,1105,1,280,1105,1,99999,1,225,225,225,1101,294,0,0,105,1,0,1105,1,99999,1106,0,300,1105,1,99999,1,225,225,225,1101,314,0,0,106,0,0,1105,1,99999,1008,677,226,224,1002,223,2,223,1006,224,329,101,1,223,223,8,226,677,224,102,2,223,223,1005,224,344,101,1,223,223,1107,226,677,224,102,2,223,223,1006,224,359,101,1,223,223,1007,226,226,224,102,2,223,223,1006,224,374,101,1,223,223,7,677,677,224,102,2,223,223,1005,224,389,1001,223,1,223,108,677,677,224,1002,223,2,223,1005,224,404,101,1,223,223,1008,226,226,224,102,2,223,223,1005,224,419,1001,223,1,223,1107,677,226,224,102,2,223,223,1005,224,434,1001,223,1,223,1108,677,677,224,102,2,223,223,1006,224,449,1001,223,1,223,7,226,677,224,102,2,223,223,1005,224,464,101,1,223,223,1008,677,677,224,102,2,223,223,1005,224,479,101,1,223,223,1007,226,677,224,1002,223,2,223,1006,224,494,101,1,223,223,8,677,226,224,1002,223,2,223,1005,224,509,101,1,223,223,1007,677,677,224,1002,223,2,223,1006,224,524,101,1,223,223,107,226,226,224,102,2,223,223,1006,224,539,101,1,223,223,107,226,677,224,102,2,223,223,1005,224,554,1001,223,1,223,7,677,226,224,102,2,223,223,1006,224,569,1001,223,1,223,107,677,677,224,1002,223,2,223,1005,224,584,101,1,223,223,1107,677,677,224,102,2,223,223,1005,224,599,101,1,223,223,1108,226,677,224,102,2,223,223,1006,224,614,101,1,223,223,8,226,226,224,102,2,223,223,1006,224,629,101,1,223,223,108,226,677,224,102,2,223,223,1005,224,644,1001,223,1,223,108,226,226,224,102,2,223,223,1005,224,659,101,1,223,223,1108,677,226,224,102,2,223,223,1006,224,674,1001,223,1,223,4,223,99,226];

$input = 5;
$codes = $program;
$found = false;
while ($found == false) {
    $progLength = count($codes);
    
    $stepSize = 0;
    for ($i = 0; $i < $progLength; $i+=$stepSize) {
        $instruction = array_map('intval', str_split($codes[$i]));
        $opCode = $instruction[count($instruction)-1];
        if ($instruction[count($instruction)-1] == 9 && $instruction[count($instruction)-2] == 9)
            die('Finished');
        $param1Mode =  (array_key_exists(count($instruction)-3, $instruction)?$instruction[count($instruction) - 3]:0);
        $param2Mode =  (array_key_exists(count($instruction)-4, $instruction)?$instruction[count($instruction) - 4]:0);
        $param3Mode = (array_key_exists(count($instruction)-5, $instruction)?$instruction[count($instruction) - 5]:0);
        switch ($opCode) {
            case 1: // +
               $param1 = ($param1Mode == 0?$codes[$codes[$i+1]]:$codes[$i+1]);
               $param2 = ($param2Mode == 0?$codes[$codes[$i+2]]:$codes[$i+2]);
               $sum = $param1 + $param2;
               echo "$sum = $param1 + $param2;\n";
               $codes[$codes[$i+3]] = $sum;
               $stepSize = 4;
               break;
            case 2: // *
           $param1 = ($param1Mode == 0?$codes[$codes[$i+1]]:$codes[$i+1]);
               $param2 = ($param2Mode == 0?$codes[$codes[$i+2]]:$codes[$i+2]);
               
               $sum = $param1 * $param2;
               $codes[$codes[$i+3]] = $sum;
               $stepSize = 4;
               break;
            case 3: // input
               $codes[$codes[$i+1]] = $input;
               $stepSize = 2;
               break; 
            case 4: // output
               $param1 = ($param1Mode == 0?$codes[$codes[$i+1]]:$codes[$i+1]);
               echo '?'.$param1Mode.'output ||'.$param1.'|'."\n";
               $stepSize = 2;
               break; 
             case 5: // jump-if-true
               $param1 = ($param1Mode == 0?$codes[$codes[$i+1]]:$codes[$i+1]);
               $param2 = ($param2Mode == 0?$codes[$codes[$i+2]]:$codes[$i+2]);
               if ($param1 != 0) {
                   $i = $param2;     
                   $stepSize = 0;
               } else {
                   $stepSize = 3;
               }
               break; 
              case 6: // jump-if-true
               $param1 = ($param1Mode == 0?$codes[$codes[$i+1]]:$codes[$i+1]);
               $param2 = ($param2Mode == 0?$codes[$codes[$i+2]]:$codes[$i+2]);
               if ($param1 == 0) {
                   $i = $param2;
                   $stepSize = 0;
               }else {
                   $stepSize = 3;
               }
               break; 
             case 7:  
               $stepSize = 4;
               $param1 = ($param1Mode == 0?$codes[$codes[$i+1]]:$codes[$i+1]);
               $param2 = ($param2Mode == 0?$codes[$codes[$i+2]]:$codes[$i+2]);
               if ($param1 < $param2) {
                    $codes[$codes[$i+3]] = 1;
               } else {
                    $codes[$codes[$i+3]] = 0;
               }
               break; 
             case 8: // Opcode 8 is equals
              $stepSize = 4;
               $param1 = ($param1Mode == 0?$codes[$codes[$i+1]]:$codes[$i+1]);
               $param2 = ($param2Mode == 0?$codes[$codes[$i+2]]:$codes[$i+2]);
               if ($param1 == $param2) {
                    $codes[$codes[$i+3]] = 1;
               } else {
                    $codes[$codes[$i+3]] = 0;
               }
               break; 
               
            case 99:
               $found = true;
               return;
        }
    }
}
?>
