<?php

require 'connect-indah.php';
require 'rb-mysql.php';

R::setup(
    'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,
    DB_USERNAME,
    DB_PASSWORD
);

header('Content-Type: application/json');

// get storage
$storageId = $_GET['id'];
if (isset($storageId) && !empty($storageId)) {
    echo getStorage($storageId);
    return;
}

// add storage
$storageName = $_POST['name'];
if (isset($storageName) && !empty($storageName)) {
    echo addStorage($storageName);
    return;
}

// delete storage
$removeStorageId = $_POST['removeId'];
if (isset($removeStorageId) && !empty($removeStorageId)) {
    echo deleteStorage($removeStorageId);
    return;
}

// default action: list all storages
echo storages();

function storages()
{
    // query all storages
    $data = R::find('kitchen_storages');
    return json_encode($data);
}

function getStorage($id)
{
    $data = R::findOne('kitchen_storages', 'id = ?', [$id]);
    return json_encode($data);
}

function addStorage($name)
{
    // validate input
    $name = trim($name);
    $id = strtolower(str_replace(' ', '_', $name));

    // check if storage exists
    $existed = R::findOne('kitchen_storages', 'id = ?', [$id]);
    if ($existed) {
        return json_encode(['added' => false, 'reason' => "$name already exists"]);
    }

    $sql = "INSERT INTO `kitchen_storages` VALUES ('$id', '$name');";
    R::exec($sql); // 0 on sucess

    // return message
    return json_encode(['added' => true, 'name' => $name]);
}

function deleteStorage($id)
{
    $id = trim($id);

    $sql = "DELETE FROM `kitchen_storages` WHERE `id` = '$id';";
    $isRemoved = R::exec($sql); // 1 on success

    // return message
    if ($isRemoved) {
        return json_encode(['removed' => true, 'id' => $id]);
    }
    return json_encode(['removed' => false, 'reason' => "Database error: $id not found"]);
}
