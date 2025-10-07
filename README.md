# Expense Tracker (Procedural PHP)

A lightweight **file-based Expense Tracker** built using **pure procedural PHP** — no frameworks, no databases.  
This project lets users record, view, and delete expenses stored locally in a simple JSON file.

## Features

- Add new expenses with description, amount, and category  
- Persistent storage using a `expenses.json` file  
- Delete specific expenses  
- Auto-calculates total expenses  
- Instant feedback via simple query messages  
- Safe input handling with validation and escaping  

## Tech Stack

| Technology | Purpose |
|-------------|----------|
| **PHP** | Core backend logic |
| **HTML / CSS** | Frontend UI |
| **JSON** | Lightweight data storage |

---

## Project Structure

```text
expense-tracker/
├── index.php        # Main UI – form + expense list
├── add.php          # Handles adding new expenses
├── delete.php       # Handles deletion
└── expenses.json    # JSON data file
```

## Usage

### Example Entry (in expenses.json)
json

```
[
  {
    "id": "652056e7b3e9b",
    "description": "Groceries",
    "amount": 45.75,
    "category": "Food",
    "date": "2025-10-06 13:42:00"
  }
]
```

🔍 Learning Highlights
This project revisits core procedural PHP skills:

File I/O with file_get_contents() and file_put_contents()
JSON encoding/decoding
Data validation
GET/POST handling
Dynamic HTML rendering
Simple routing and redirects

It’s a great warm-up before transitioning into OOP PHP projects using classes, objects, and more structured architectures.

License
This project is open-source and available under the MIT License.

“Small projects done right teach more than big projects half-finished.” 💡
