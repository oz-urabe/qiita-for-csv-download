<?php

include __DIR__ . '/common.php';

function getData($pdo, $limit = false) {
    $sql = 'SELECT * FROM dummy';
    if (is_numeric($limit)) {
        $sql .= sprintf(' LIMIT %d', $limit);
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $csv = [];
    while ($row = $stmt->fetch()) {
        $csv[] = sprintf(
            '%d,%s,%s,%s,%s,%s MB',
            $row['id'],
            $row['name'],
            $row['comment'],
            $row['created'],
            $row['updated'],
            memory_get_peak_usage(true) / 1024 / 1024
        );
    }
    return $csv;
}

$limit = $_GET['limit'] ?? false;

$csv = getData($pdo, $limit);
header('Content-Disposition: attachment; filename="csv-normal.csv"');
foreach ($csv as $line) {
    echo $line, PHP_EOL;
}
