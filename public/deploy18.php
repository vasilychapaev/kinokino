<?php
// test commit
putenv("HOME=/sites/kinokino_ml/");
 
// The commands
$commands = array(
    'pwd',
    'whoami',
    'git status',
    'git add .',
    'git commit -m "Changes on production"',
    'git pull origin master',
    'git checkout --theirs .',
    'git commit -am "Remote Conflict"',
    'git push origin master',
    'git submodule sync',
    'git submodule update',
    'git submodule status',
    'artisan migrate',
);

// Run the commands for output
$output = '';
foreach($commands AS $command){
// Run it
//    $tmp = shell_exec($command);
    $tmp = exec($command. '  2>&1');
// Output
    $output .= "<span style=\"color: #6BE234;\">\$</span> <span style=\"color: #729FCF;\">{$command}\n</span>";
    $output .= htmlentities(trim($tmp)) . "\n";
}

// Make it pretty for manual user access (and why not?)
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>GIT DEPLOYMENT SCRIPT</title>
</head>
<body style="background-color: #000000; color: #FFFFFF; font-weight: bold; padding: 0 10px;">
<pre>
. ____ . ____________________________
|/ \| | |
[| <span style="color: #FF0000;">&hearts; &hearts;</span> |] | Git Deployment Script v0.1 |
|___==___| / &copy; oodavid 2012 |
|____________________________|

    <?php echo $output; ?>
</pre>
</body>
</html>

