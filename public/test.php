<?php
$d = parse_str('mysqli://mysql@aeropark.s:djfey45DHe4E@localhost/aeropark');
var_dump($d);
exit;
$string = "AAAABBBCCCDD";
$stringArray = str_split($string);

$prices = [
    'A' => ['num' => 3, 'price' => 130],
    'B' => ['num' => 2, 'price' => 45],
];

$prices_normal = [
    'A' => 50,
    'B' => 30,
    'C' => 20,
    'D' => 10
];

$values = [];
$final = [];

foreach($stringArray as $key => $char){
    if(array_key_exists($char, $values)){
        $values[$char] = $values[$char] + 1;
    }else{
        $values[$char] = 1;
    }
}

foreach($prices as $key => $price){
    if(!array_key_exists($key, $values)){
        continue;
    }
    $final[$key] = calculate($price, $prices_normal[$key], $values[$key], $key);
    unset($values[$key]);
}

foreach($values as $char => $value){
    $final[$char] = ['normal_price' => ['items' => $value, 'price' => $prices_normal[$char], 'total' => $value * $prices_normal[$char]]];
}

$total_price = 0;
foreach ($final as $f){
    if(!empty($f['normal_price'])){
        $total_price += $f['normal_price']['total'];
    }

    if(!empty($f['promo_price'])){
        $total_price += $f['promo_price']['total'];
    }
}

echo $total_price;

function calculate($price, $prices_normal, $value, $char){
    $data = [];
    if($value < $price['num']){
        return $data['price'] = ['normal_price' => ['items' => $value, 'price' => $prices_normal, 'total' => $value * $prices_normal]];
    }elseif($value == $price['num']){
        return $data['price'] = ['normal_price' => [], 'promo_price' => ['items' => $value, 'price' => $price['price']/$value, 'total' => $price['price']]];
    }else{
        $del = $value%$price['num'];
        if($del){
            $normal = fmod($value, $price['num']);
            $promo = ($value - $del);
            $promo_items = $promo/$price['num'];
            return $data['price'] = ['normal_price' => ['items' => $normal, 'price' => $prices_normal, 'total' => $normal * $prices_normal], 'promo_price' => ['items' => $promo_items, 'price' => $price['price']/$promo_items, 'total' => $promo_items * $price['price']]];
        }else{
            $items = $value/$price['num'];
            return $data['price'] = ['normal_price' => [], 'promo_price' => ['items' => $value, 'price' => $price['price']/$value, 'total' => $items * $price['price']]];
        }
    }

    return $data;
}