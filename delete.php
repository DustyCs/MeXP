<?php
// 1. Check if "id" is passed via id? url
if (!isset($_GET['id'])) {
    header('Location: index.php?msg=missing_id');
    exit;
}

const EXPENSES_FILE = __DIR__ . '/expenses.json';


// 2. If "expenses.json" exists, load and decode it into $expenses array
if (file_exists(EXPENSES_FILE)) {
    $json = file_get_contents(EXPENSES_FILE);
    $expenses = json_decode($json, true) ?: [];
} else {
    $expenses = [];
}

// 3. Remove the expense at the given index (use array_splice or unset)

// This is O(n) hmm
$expenses = array_filter($expenses, function($expense) {
    return $expense['id'] !== $_GET['id'];
});


// 4. Save the updated $expenses array back into the file (JSON encode again)
file_put_contents(EXPENSES_FILE, json_encode($expenses, JSON_PRETTY_PRINT));

// 5. Redirect back to "index.php"

header('Location: index.php?msg=expense_deleted');
exit;