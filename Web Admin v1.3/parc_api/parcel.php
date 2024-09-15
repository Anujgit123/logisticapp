<?php
require dirname(dirname(__FILE__)) . "/include/lanconfig.php";
require dirname(dirname(__FILE__)) . "/include/laundrore.php";
$data = json_decode(file_get_contents("php://input"), true);
if (
    $data["pickup_address"] == "" ||
    $data["pick_lat"] == "" ||
    $data["pick_long"] == "" ||
    $data["drop_address"] == "" ||
    $data["drop_lat"] == "" ||
    $data["drop_long"] == "" ||
    $data["pick_pincode"] == "" ||
    $data["drop_pincode"] == "" ||
    $data["total"] == "" ||
	$data["parcel_weight"] == "" ||
	$data["parcel_dimension"] == ""
) {
    $returnArr = [
        "ResponseCode" => "401",
        "Result" => "false",
        "ResponseMsg" => "Something Went Wrong!",
    ];
} else {
    $pickup_address = strip_tags(
        mysqli_real_escape_string($lundry, $data["pickup_address"])
    );
    $pick_lat = strip_tags(
        mysqli_real_escape_string($lundry, $data["pick_lat"])
    );
    $pick_long = strip_tags(
        mysqli_real_escape_string($lundry, $data["pick_long"])
    );
    $drop_address = strip_tags(
        mysqli_real_escape_string($lundry, $data["drop_address"])
    );
    $drop_lat = strip_tags(
        mysqli_real_escape_string($lundry, $data["drop_lat"])
    );
    $drop_long = strip_tags(
        mysqli_real_escape_string($lundry, $data["drop_long"])
    );
    $pick_pincode = strip_tags(
        mysqli_real_escape_string($lundry, $data["pick_pincode"])
    );
    $drop_pincode = strip_tags(
        mysqli_real_escape_string($lundry, $data["drop_pincode"])
    );
	$parcel_weight = strip_tags(
        mysqli_real_escape_string($lundry, $data["parcel_weight"])
    );
	$parcel_dimension = strip_tags(
        mysqli_real_escape_string($lundry, $data["parcel_dimension"])
    );
    $logistic_date = date("Y-m-d");
    $total = strip_tags(mysqli_real_escape_string($lundry, $data["total"]));
    $uid = $data["uid"];
    $vid = $set["couvid"];
    $transaction_id = $data["transaction_id"];
    $p_method_id = $data["p_method_id"];
    $getzoneid = $lundry
        ->query(
            "select id FROM zones where ST_Contains(coordinates,ST_GeomFromText('POINT(" .
                $pick_long .
                " " .
                $pick_lat .
                ")'))"
        )
        ->fetch_assoc();
    $zoneid = $getzoneid["id"];

    $table = "tbl_parcel";
    $field_values = [
        "vehicleid",
        "pickup_address",
        "pick_lat",
        "pick_long",
        "drop_address",
        "drop_lat",
        "drop_long",
        "pick_pincode",
        "drop_pincode",
        "order_date",
        "total",
        "p_method_id",
        "transaction_id",
        "uid",
        "dzone",
		"parcel_dimension",
		"parcel_weight"
    ];
    $data_values = [
        "$vid",
        "$pickup_address",
        "$pick_lat",
        "$pick_long",
        "$drop_address",
        "$drop_lat",
        "$drop_long",
        "$pick_pincode",
        "$drop_pincode",
        "$logistic_date",
        "$total",
        "$p_method_id",
        "$transaction_id",
        "$uid",
        "$zoneid",
		"$parcel_dimension",
		"$parcel_weight"
    ];

    $h = new Laundrore();
    $oid = $h->lundryinsertdata_Api_Id($field_values, $data_values, $table);

    $content = [
        "en" => "New Parcel  Arrival!!",
    ];
    $heading = [
        "en" => "Check Parcel Order And Accept!!",
    ];
    $fields = [
        "app_id" => $set["d_key"],
        "included_segments" => ["Active Users"],
        "data" => ["order_id" => $oid],
        "filters" => [
            [
                "field" => "tag",
                "key" => "vehicleid",
                "relation" => "=",
                "value" => $vid,
            ],
            ["operator" => "and"],
            [
                "field" => "tag",
                "key" => "dzoneid",
                "relation" => "=",
                "value" => $zoneid,
            ],
        ],
        "contents" => $content,
        "headings" => $heading,
    ];

    $fields = json_encode($fields);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json; charset=utf-8",
        "Authorization: Basic " . $set["d_hash"],
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);
    curl_close($ch);

    $returnArr = [
        "ResponseCode" => "200",
        "Result" => "true",
        "ResponseMsg" => "Parcel Order Placed Successfully!!!",
        "order_id" => $oid,
    ];
}
echo json_encode($returnArr);
