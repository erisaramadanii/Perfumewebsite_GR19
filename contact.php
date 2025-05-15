<?php include("init.php"); ?>

<h2>Na kontakto</h2>

<form method="POST" action="Includes/email_functions.php">
    Email: <input type="email" name="to" required><br>
    Subjekti: <input type="text" name="subject" required><br>
    Mesazhi:<br>
    <textarea name="message" required></textarea><br>
    <input type="submit" value="Dërgo">
</form>
