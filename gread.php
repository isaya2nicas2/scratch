<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gread form</title>
</head>
<body>
    <?php
    function letter_grade(int $score): string {
        if ($score >= 90) return 'A';
        if ($score >= 80) return 'B';
        if ($score >= 70) return 'C';
        if ($score >= 60) return 'D';
        return 'F';
    }

    $message = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['name'] ?? '');
        $scoreRaw = $_POST['score'] ?? '';

        if ($scoreRaw === '') {
            $message = 'Please enter a score.';
        } elseif (!is_numeric($scoreRaw) || $scoreRaw < 0 || $scoreRaw > 100) {
            $message = 'Score must be a number between 0 and 100.';
        } else {
            $score = (int)$scoreRaw;
            $grade = letter_grade($score);
            $student = $name !== '' ? htmlspecialchars($name) : 'Student';
            $message = "$student scored $score → grade $grade.";
        }
    }
    ?>
    <h1>Student grade</h1>
    <form method="post" action="">
        <label for="name">optional</label>
            <input type="text" name="name" placeholder="Optional">
        <br><br>
        <label for="score">score</label>
            <input type="number" name="score" min="0" max="100" required>
        <br><br>
        <button type="submit">grade</button>
    </form>

    <?php if ($message !== ''): ?>
        <p><strong><?php echo $message; ?></strong></p>
    <?php endif; ?>
</body>
</html>
