<?php
$unsorted = array(43,21,2,1,9,24,2,99,23,8,7,114,92,5);
function quick_sort($array)
{
    $length = count($array);
    if($length <= 1){
        return $array;
    }
    else{
        $pivot = $array[0];
        $left = $right = array();

        for($i = 1; $i < count($array); $i++)
        {
            if($array[$i] < $pivot){
                $left[] = $array[$i];
            }
            else{
                $right[] = $array[$i];
            }
        }
        return array_merge(quick_sort($left), array($pivot), quick_sort($right));
    }
}
$sorted = quick_sort($unsorted);
//print_r($sorted);
$arr[0] = (array(
    'id'=>'1',
    'score'=>40));
$arr[1] = (array(
    'id'=>'2',
    'score'=>60));
$arr[2] = (array(
    'id'=>'3',
    'score'=>80));
//print_r($arr);
array_multisort($arr,SORT_DESC);
echo'<br>';
echo'****************************************** AFTER SORTING **************************************<br>';
//print_r($arr);
?>
<html>
<body>
<script>
    window.print();

</script>
<h1>frdrck</h1>
</body>
</html>
