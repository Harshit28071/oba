<!DOCTYPE html>
<html>
<head>
    <title>WhatsApp Integration</title>
</head>
<body>

<?php
$phoneNumber = "7771841091";
$prefilledMessage = "Hello from my website!";

$link = "https://wa.me/$phoneNumber?text=$prefilledMessage";
?>

<a href="<?php echo $link; ?>">
    <button>Click to chat on WhatsApp</button>
</a>

</body>
</html>