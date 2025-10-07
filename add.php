<?php
// 1. Check if all required POST fields are present (description, amount, category)

const EXPENSES_FILE = __DIR__ . '/expenses.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['description'], $_POST['amount'], $_POST['category'])) {
        $description = trim($_POST['description']);
        $amount = floatval($_POST['amount']);
        $category = trim($_POST['category']);
} else {
    // Redirect back with msg if fields are missing
    header('Location: index.php?msg=missing_fields');
    exit;
}

// 2. If "expenses.json" exists, load and decode it into $expenses array.
//    Otherwise, start with an empty array.

if (file_exists(EXPENSES_FILE)) {
    $json = file_get_contents(EXPENSES_FILE);
    $expenses = json_decode($json, true) ?: [];
} else {
    $expenses = [];
}

// 3. Create a new expense as an associative array:
//    [
//      'description' => (user input),
//      'amount' => (float) amount,
//      'category' => category,
//      'date' => current date/time (Y-m-d H:i:s)
//    ]

$newExpense = [
    'description' => $description,
    'amount' => $amount,
    'category' => $category,
    'date' => date('Y-m-d H:i:s'),
    'id' => uniqid()
];

// 4. Add the new expense to the array
$expenses[] = $newExpense;

// 5. Encode $expenses to JSON and save back into "expenses.json"
file_put_contents(EXPENSES_FILE, json_encode($expenses, JSON_PRETTY_PRINT));

// 6. Redirect user back to "index.php"

header('Location: index.php?msg=expense_added');
exit;
