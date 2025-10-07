<?php
include 'config.php';

$limit = 15;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$result = $conn->query("SELECT * FROM mahasiswa LIMIT $limit OFFSET $offset");
$totalQuery = $conn->query("SELECT COUNT(*) AS total FROM mahasiswa");
$totalData = $totalQuery->fetch_assoc()['total'];
$totalPages = ceil($totalData / $limit);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode([
    'rows' => $data,
    'totalPages' => $totalPages,
    'currentPage' => $page
]);
?>
