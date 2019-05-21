<?php

include __DIR__ . '/common.php';

// force disable bufferd query.
$pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);

function getData($pdo, $limit = false) {
    $sql = 'SELECT * FROM dummy';
    if (is_numeric($limit)) {
        $sql .= sprintf(' LIMIT %d', $limit);
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    while ($row = $stmt->fetch()) {
        yield sprintf(
            '%d,%s,%s,%s,%s,%s MB',
            $row['id'],
            $row['name'],
            $row['comment'],
            $row['created'],
            $row['updated'],
            memory_get_peak_usage(true) / 1024 / 1024
        );
    }
}

$limit = $_GET['limit'] ?? false;

$csv = getData($pdo, $limit);
header('Content-Disposition: attachment; filename="csv-tuned.csv"');
foreach ($csv as $line) {
    echo $line, PHP_EOL;
}
