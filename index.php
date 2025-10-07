<?php
// 1. If "expenses.json" exists, load and decode it into $expenses array.
//    Otherwise, initialize $expenses as an empty array.

$expenses = [];
if (file_exists(__DIR__ . '/expenses.json')) {
    $json = file_get_contents(__DIR__ . '/expenses.json');
    $expenses = json_decode($json, true) ?: [];
};

?>

<!DOCTYPE html>
<html>
<head>
    <title>Expense Tracker</title>
    <style>
        body { font-family: Arial; margin: 40px; background: #f7f7f7; }
        h2 { color: #333; }
        form { margin-bottom: 20px; }
        input, select { padding: 5px; }
        table { border-collapse: collapse; width: 100%; background: white; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
<?php 
    if (isset($_GET['msg'])) {
        echo "<p style='color: green;'>" . htmlspecialchars($_GET['msg']) . "</p>";
    } 
?>

<h2>💵 Expense Tracker</h2>

<!-- 2. Create a form that POSTs to "add.php" with:
        - text input: description
        - number input: amount
        - select: category (Food, Transport, Shopping, Bills, Other)
        - submit button
-->

<form action="add.php" method="POST">
    <input type="text" name="description" placeholder="Description" required>
    <input type="number" step="1" name="amount" placeholder="Amount" required>
    <select name="category" required>
        <option value="">Select Category</option>
        <option value="Food">Food</option>
        <option value="Transport">Transport</option>
        <option value="Shopping">Shopping</option>
        <option value="Bills">Bills</option>
        <option value="Other">Other</option>
    </select>
    <button type="submit">Add Expense</button>
</form>

<!-- 3. If there are any expenses:
        - Display them in an HTML table with columns:
          Description | Amount | Category | Date | Action(Delete link)
        - Calculate and display total amount at the bottom
     Otherwise, show a message like “No expenses yet.”
-->

<table>
    <tr>
        <th>Description</th>
        <th>Amount</th>
        <th>Category</th>
        <th>Date</th>
        <th>Action</th>
    </tr>
    <?php if (count($expenses) > 0): ?>
        <?php 
        $total = 0;
        foreach ($expenses as $index => $expense): 
            $total += $expense['amount'];
        ?>
            <tr>
                <td><?= htmlspecialchars($expense['description']) ?></td>
                <td>$<?= number_format($expense['amount'], 2) ?></td>
                <td><?= htmlspecialchars($expense['category']) ?></td>
                <td><?= htmlspecialchars($expense['date']) ?></td>
                <td><a href="delete.php?id=<?= $expense['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <th colspan="1">Total</th>
            <th colspan="4">$<?= number_format($total, 2) ?></th>
        </tr>
    <?php else: ?>
        <tr><td colspan="5">No expenses yet.</td></tr>
    <?php endif; ?>
</table>

</body>
</html>
