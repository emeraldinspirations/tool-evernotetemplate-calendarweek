<?php

$Today          = new DateTimeImmutable();
$OffsetToSunday = new DateInterval('P'.$Today->format('w').'D');
$Sunday         = $Today->sub($OffsetToSunday);

$textPlainArray = [];
$DateString     = '';
$textHtml       = '';


for ($x = 0; $x < 7; $x ++) {
    $Interval = new DateInterval('P'.$x.'D');
    $DateString = ($Sunday->add($Interval))->format('Y-m-d - l');
    $textPlainArray[] = $DateString;
    $textHtml .= PHP_EOL
        . $DateString
        . PHP_EOL
        . '<ul><li></li></ul>';
}

?><!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Calendar Week - Evernote Template</title>
  <meta name="description" content="Generate a bulleted list of the days of the week for submission to evernote">
  <meta name="author" content="Matthew 'Juniper' Barlett <emeraldinspirations@gmail.com>">
</head>
<body>
    <?php
        echo '<script>', file_get_contents('../node_modules/clipboard-js/clipboard.min.js'), '</script>';
    ?>
    <blockquote id="tool-evernotetemplate-calendarweek">'
        <?php echo $textHtml; ?>
    </blockquote>
    <script>
    function copyHTML() {
        var htmlText =
            document.getElementById("tool-evernotetemplate-calendarweek")
            .innerHTML;
        clipboard.copy({
            "text/plain": "<?php echo implode('\n', $textPlainArray); ?>",
            "text/html": htmlText
        });
    }
    </script>
    <button onclick="copyHTML()">Copy</button>
</body>
</html>
