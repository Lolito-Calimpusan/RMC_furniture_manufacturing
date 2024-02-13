<?php
$fees = [];

if (($handle = fopen("philippine_cities.csv", "r")) !== false) {
    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
        $city = $data[0];
        $fee = $data[1];

        $fees[$city] = $fee;
    }
    fclose($handle);
}

function findClosestMatch($userInput, $fees) {
    $minDistance = PHP_INT_MAX;
    $closestMatch = "";

    foreach ($fees as $city => $fee) {
        $distance = levenshtein($userInput, $city);
        if ($distance < $minDistance) {
            $minDistance = $distance;
            $closestMatch = $city;
        }
    }

    return $closestMatch;
}

function computeShippingFee($customerLocation) {
    global $fees;

    if (array_key_exists($customerLocation, $fees)) {
        return $fees[$customerLocation];
    } else {
        $closestMatch = findClosestMatch($customerLocation, $fees);

        if ($closestMatch !== "") {
            return $fees[$closestMatch];
            return "Hindi namin matukoy ang fee para sa lokasyon na ito.";
        }
    }
}

if (isset($_POST['set'])) {
    $customerLocation = $_POST['customer_location'];
    $shippingFee = computeShippingFee($customerLocation);

    if (is_numeric($shippingFee)) {
        echo "Ang shipping fee para sa $customerLocation ay ₱$shippingFee.";
    } else {
        echo $shippingFee;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Fee Calculator</title>
</head>
<body>
    <form action="" method="post">
        <p>Address</p>
        <input type="text" name="customer_location" id="customer_location" value="">
        <input type="submit" value="Submit" name="set">
    </form>
</body>
</html>
