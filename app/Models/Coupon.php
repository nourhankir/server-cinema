<?php
require_once __DIR__ . '/../Core/Model.php';

class Coupon extends Model {
    protected static string $table = 'coupons';
    protected static string $primaryKey = 'id';
}
