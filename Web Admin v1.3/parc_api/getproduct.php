<?php
require dirname(dirname(__FILE__)) . '/include/lanconfig.php';
header('Content-type: application/json');

$query = "SELECT * FROM tbl_pcat WHERE status=?";
$stmt = $lundry->prepare($query);
$status = 1;
$stmt->bind_param("i", $status);
$stmt->execute();
$maincat_result = $stmt->get_result();

$cat_arr = [];
while ($maincat_row = $maincat_result->fetch_assoc()) {
    $main_cat_id = $maincat_row['id'];
    $main_cat_title = $maincat_row['title'];

    $subcat_query = "SELECT * FROM tbl_subcat WHERE status=? AND cat_id=?";
    $subcat_stmt = $lundry->prepare($subcat_query);
    $status = 1;
    $cat_id = $main_cat_id;
    $subcat_stmt->bind_param("ii", $status, $cat_id);
    $subcat_stmt->execute();
    $subcat_result = $subcat_stmt->get_result();

    $subcat_arr = [];
    while ($subcat_row = $subcat_result->fetch_assoc()) {
        $subcat_id = $subcat_row['id'];
        $subcat_title = $subcat_row['title'];

        $product_query = "SELECT * FROM tbl_product WHERE status=? AND cat_id=? AND subcat_id=?";
        $product_stmt = $lundry->prepare($product_query);
        $status = 1;
        $cat_id = $main_cat_id;
        $product_stmt->bind_param("iii", $status, $cat_id, $subcat_id);
        $product_stmt->execute();
        $product_result = $product_stmt->get_result();

        $product_arr = [];
        while ($product_row = $product_result->fetch_assoc()) {
            $product_id = $product_row['id'];
            $product_title = $product_row['title'];
            $product_price = $product_row['price'];

            $product_arr[] = [
                "product_id" => $product_id,
                "product_title" => $product_title,
                "product_price" => $product_price
            ];
        }

        $subcat_arr[] = [
            "subcat_id" => $subcat_id,
            "subcat_title" => $subcat_title,
            "product_data" => $product_arr
        ];
    }

    $cat_arr[] = [
        "main_cat_id" => $main_cat_id,
        "main_cat_title" => $main_cat_title,
        "subcat_data" => $subcat_arr
    ];
}

$stmt = $lundry->prepare("SELECT ukms, uprice, aprice FROM tbl_vehicle WHERE id = ?");
$stmt->bind_param("i", $set['vehiid']);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();

$response_arr = [
    "CategoryData" => $cat_arr,
	"vehicle_Data"=>$result,
    "ResponseCode" => 200,
    "Result" => true,
    "ResponseMsg" => "Data Get Successfully!"
];

echo json_encode($response_arr);