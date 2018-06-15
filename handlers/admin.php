<?php

require_once 'db.php';

switch ($_POST['operation_type']) {
    case 'update_shop':
        updateShop($pdo);
        break;
    case 'delete_category':
        deleteCategory($pdo);
        break;
    case 'add_category':
        addCategory($pdo);
        break;
    case 'enable_category':
        enableCategory($pdo);
        break;
    case 'disable_category':
        disableCategory($pdo);
        break;
    case 'enable_main_content':
        enableContent($pdo);
        break;
    case 'disable_main_content':
        disableContent($pdo);
        break;
    case 'send_feedback':
        sendFeedback($pdo);
        break;
    case 'update_product':
//        updateProduct($pdo);
//        break;
//    case 'confirm_purchase':
//        confirmPurchase($pdo);
//        break;
    default:
        echo 'Неверный запрос!';
        break;
}

function updateShop($pdo)
{
    $stmt = $pdo->prepare("UPDATE shops SET title = :title, path = :path, enabled = :enabled WHERE id = :id");

    $is_active = isset($_POST['is_active']) && $_POST['is_active'] === 'on' ? 1 : 0;

    $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
    $stmt->bindParam(':title', $_POST['title']);
    $stmt->bindParam(':path', $_POST['api']);
    $stmt->bindParam(':enabled', $is_active, PDO::PARAM_INT);
    $stmt->execute();

    header('Location: /admin/shops.php');
}

function deleteCategory($pdo)
{
    $stmt = $pdo->prepare("DELETE FROM categories WHERE id = ?");
    $response = $stmt->execute([$_POST['category_id']]);

    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode(['response' => $response]));
}

function addCategory($pdo)
{
    $stmt = $pdo->prepare('SELECT * from categories where title = ?');
    $stmt->execute([$_POST['category_title']]);
    $categories = $stmt->fetchAll();

    if ($categories) {
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(['response' => 0]));
    } else {
        $stmt = $pdo->prepare("INSERT INTO categories (title, enabled) VALUES (:title, 1)");
        $stmt->bindParam(':title', $_POST['category_title']);
        $response = $stmt->execute();

        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(['response' => $response]));
    }
}

function enableCategory($pdo)
{
    $stmt = $pdo->prepare("UPDATE categories SET enabled = 1 WHERE id = ?");
    $response = $stmt->execute([$_POST['category_id']]);

    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode(['response' => $response]));
}

function disableCategory($pdo)
{
    $stmt = $pdo->prepare("UPDATE categories SET enabled = 0 WHERE id = ?");
    $response = $stmt->execute([$_POST['category_id']]);

    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode(['response' => $response]));
}

function enableContent($pdo)
{
    $stmt = $pdo->prepare("UPDATE main_page SET enabled = 1 WHERE id = ?");
    $response = $stmt->execute([$_POST['content_id']]);

    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode(['response' => $response]));
}

function disableContent($pdo)
{
    $stmt = $pdo->prepare("UPDATE main_page SET enabled = 0 WHERE id = ?");
    $response = $stmt->execute([$_POST['content_id']]);

    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode(['response' => $response]));
}

function sendFeedback($pdo)
{

    $stmt = $pdo->prepare("INSERT INTO feedback (name, email, description, date) VALUES (:name, :email, :description, :date)");

    $date = new DateTime('now');

    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':description', $_POST['text']);
    $stmt->bindParam(':date', $date->format('Y-m-d H:i:s'));
    $stmt->execute();

    header('Location: /feedback-success.php');
}
