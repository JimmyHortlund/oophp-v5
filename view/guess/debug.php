<?php

namespace Jiho\Guess;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());



?>
<h1>Debugging</h1>
<hr>
<pre>
SESSION
<?= var_dump($_SESSION) ?>
POST
<?= var_dump($_POST) ?>
GET
<?= var_dump($_GET) ?>
<hr>
</pre>
