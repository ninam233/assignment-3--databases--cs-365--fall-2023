<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Create, Read, Update, Delete Operations through a Secure Web Interface</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <h1>Create, Read, Update, Delete Operations through a Secure Web Interface</h1>
</header>
<form id="clear-results" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input id="clear-results__submit-button" type="submit" value="Clear Results">
</form>
<?php
// Include necessary files
require_once 'includes/config.php';
require_once 'includes/helpers.php';

// Retrieve selected operation from the form
$selectedOperation = (isset($_POST['submitted']) ? $_POST['submitted'] : null);

// Check the selected operation and perform corresponding actions
if ($selectedOperation != null) {
    switch ($selectedOperation) {
        case SEARCH:
            // Handle search operation
            if (empty($_POST['search'])) {
                echo '<div id="error">Search query empty. Please try again.</div>' . "\n";
            } else {
                if (NOTHING_FOUND === (Search($_POST['search']))) {
                    echo '<div id="error">Nothing found.</div>' . "\n";
                }
            }
            break;

        case UPDATE:
            // Handle update operation
            if ((0 == $_POST['new-attribute']) && (empty($_POST['pattern']))) {
                echo '<div id="error">One or both fields were empty, ' .
                    'but both must be filled out. Please try again.</div>' . "\n";
            } else {
                Update($_POST['current-attribute'], $_POST['new-attribute'],
                    $_POST['query-attribute'], $_POST['pattern']);
            }
            break;

        case INSERT:
            // Handle insert operation
            if (("" == $_POST['user-firstname']) || ("" == $_POST['user-lastname'])) {
                echo '<div id="error">At least one field in your insert request ' .
                    'is empty. Please try again.</div>' . "\n";
            } else {
                Insert(
                    $_POST['site-name'],
                    $_POST['site-url'],
                    $_POST['user-email'],
                    $_POST['user-firstname'],
                    $_POST['user-lastname'],
                    $_POST['user-username'],
                    $_POST['user-password'],
                    $_POST['comment']
                );
            }
            break;

        case DELETE:
            // Handle delete operation
            if (("" == $_POST['current-attribute']) || ("" == $_POST['pattern'])) {
                echo '<div id="error">At least one field in your delete procedure ' .
                    'is empty. Please try again.</div>' . "\n";
            } else {
                $attribute = $_POST['current-attribute'];
                $value = $_POST['pattern'];
                Delete($attribute, $value);
            }
            break;
    }
}
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
        <legend>Search</legend>
        <input type="text" name="search" autofocus required>
        <input type="hidden" name="submitted" value="1">
        <p><input type="submit" value="search"></p>
    </fieldset>
</form>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return confirm('Are you sure you want to delete?');">
    <fieldset>
        <legend>Delete</legend>
        DELETE FROM Websites WHERE
        <select name="current-attribute" id="current-attribute">
            <option>WebsiteID</option>
            <option>WebsiteName</option>
        </select>
        = <input type="text" name="pattern" required>
        <input type="hidden" name="submitted" value="<?php echo DELETE; ?>">
        <p><input type="submit" value="delete"></p>
    </fieldset>
</form>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
        <legend>Insert</legend>
        <input type="text" name="site-name" placeholder="Site Name" required>,
        <input type="text" name="site-url" placeholder="Site URL" required>
        <br>
        <input type="text" name="user-email" placeholder="User Email" required>,
        <input type="text" name="user-firstname" placeholder="User First Name" required>,
        <input type="text" name="user-lastname" placeholder="User Last Name" required>,
        <input type="text" name="user-username" placeholder="User Username" required>
        <br>
        <input type="password" name="user-password" placeholder="User Password" required>,
        <textarea name="comment" placeholder="Comment" required></textarea>
        <input type="hidden" name="submitted" value="<?php echo INSERT; ?>">
        <p><input type="submit" value="Insert"></p>
    </fieldset>
</form>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
        <legend>Update</legend>
        UPDATE Website SET
        <select name="current-attribute" id="current-attribute">
            <option>WebsiteName</option>
            <option>WebsiteID</option>
        </select>
        = <input type="text" name="new-attribute" required> WHERE
        <select name="query-attribute" id="query-attribute">
            <option>WebsiteName</option>
            <option>WebsiteID</option>
        </select>
        = <input type="text" name="pattern" required>
        <input type="hidden" name="submitted" value="2">
        <p><input type="submit" value="update"></p>
    </fieldset>
</form>
</body>
</html>
