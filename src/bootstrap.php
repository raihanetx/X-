<?php
// index.php - FINAL & COMPLETE version rewritten for MySQL Database
require_once 'src/includes/db.php';
require_once 'src/includes/helpers.php';

// --- Base Path ---
define('BASE_PATH', rtrim(str_replace('index.php', '', $_SERVER['SCRIPT_NAME']), '/'));

// --- Load ALL Data from DATABASE ---
$site_config = get_all_settings($pdo);
$all_coupons_data = $pdo->query("SELECT * FROM coupons")->fetchAll(PDO::FETCH_ASSOC);
$all_hotdeals_data = $pdo->query("SELECT h.product_id as productId, h.custom_title as customTitle FROM hotdeals h")->fetchAll(PDO::FETCH_ASSOC);

// Extract simple config values
$hero_banner_paths_raw = $site_config['hero_banner'] ?? [];
$hero_banner_paths = array_map(function($path) { return rtrim(BASE_PATH, '/') . '/' . ltrim($path, '/'); }, $hero_banner_paths_raw);
$favicon_path = $site_config['favicon'] ?? '';
$contact_info = $site_config['contact_info'] ?? ['phone' => '', 'whatsapp' => '', 'email' => ''];
$usd_to_bdt_rate = $site_config['usd_to_bdt_rate'] ?? 110;
$site_logo_path = $site_config['site_logo'] ?? '';
$hero_slider_interval = $site_config['hero_slider_interval'] ?? 5000;
$hot_deals_speed = $site_config['hot_deals_speed'] ?? 40;
$payment_methods = $site_config['payment_methods'] ?? [];

// --- Prepare Data for Vue.js ---
$all_categories = [];
$all_products_flat = [];
$products_by_category = [];
$product_slug_map = [];
$category_slug_map = [];
$static_pages = ['cart', 'checkout', 'order-history', 'products', 'about-us', 'privacy-policy', 'terms-and-conditions', 'refund-policy'];

$categories = $pdo->query("SELECT id, name, slug, icon FROM categories ORDER BY name ASC")->fetchAll(PDO::FETCH_ASSOC);
foreach ($categories as $category) {
    $all_categories[] = ['name' => $category['name'], 'slug' => $category['slug'], 'icon' => $category['icon']];
    $category_slug_map[$category['slug']] = $category['name'];

    $product_stmt = $pdo->prepare("SELECT * FROM products WHERE category_id = ? ORDER BY name ASC");
    $product_stmt->execute([$category['id']]);
    $products_for_this_category = $product_stmt->fetchAll(PDO::FETCH_ASSOC);

    $category_products_temp = [];
    foreach ($products_for_this_category as $product) {
        $product_data = $product;
        $product_data['stock_out'] = (bool)$product_data['stock_out'];
        $product_data['featured'] = (bool)$product_data['featured'];
        $product_data['category'] = $category['name'];
        $product_data['category_slug'] = $category['slug'];

        $pricing_stmt = $pdo->prepare("SELECT duration, price FROM product_pricing WHERE product_id = ?");
        $pricing_stmt->execute([$product['id']]);
        $product_data['pricing'] = $pricing_stmt->fetchAll(PDO::FETCH_ASSOC);

        $reviews_stmt = $pdo->prepare("SELECT id, name, rating, comment FROM product_reviews WHERE product_id = ? ORDER BY created_at DESC");
        $reviews_stmt->execute([$product['id']]);
        $product_data['reviews'] = $reviews_stmt->fetchAll(PDO::FETCH_ASSOC);

        $all_products_flat[] = $product_data;
        $category_products_temp[] = $product_data;
        $product_slug_map[$category['slug'] . '/' . $product['slug']] = $product['id'];
    }

    if (!empty($category_products_temp)) {
        $products_by_category[$category['name']] = $category_products_temp;
    }
}

// --- URL ROUTING LOGIC ---
$request_path = trim($_GET['path'] ?? '', '/');
$path_parts = explode('/', $request_path);
$initial_view = 'home';
$initial_params = new stdClass();

if ($request_path) {
    $view_map = ['order-history' => 'orderHistory', 'about-us' => 'aboutUs', 'privacy-policy' => 'privacyPolicy', 'terms-and-conditions' => 'termsAndConditions', 'refund-policy' => 'refundPolicy'];
    $view_key = $path_parts[0];

    if (isset($product_slug_map[$request_path])) {
        $initial_view = 'productDetail';
        $initial_params->productId = $product_slug_map[$request_path];
    } elseif ($path_parts[0] === 'products' && isset($path_parts[1], $path_parts[2]) && $path_parts[1] === 'category' && isset($category_slug_map[$path_parts[2]])) {
        $initial_view = 'products';
        $initial_params->filterType = 'category';
        $initial_params->filterValue = $category_slug_map[$path_parts[2]];
    } elseif (in_array($view_key, $static_pages) && !isset($path_parts[1])) {
        $initial_view = $view_map[$view_key] ?? $view_key;
    }
}
?>