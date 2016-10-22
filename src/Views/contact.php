<!DOCTYPE html>
<html lang="en" class="">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Bit..</title>
</head>
<body>
  <h2>Contact Us..</h2>

  <?php foreach ($contacts as $contact) :?>
    <li><?= $contact->name; ?></li>
  <?php endforeach; ?>

  <form action="/contact" method="post">

    <input type="text" name="name" value="">
    <input type="text" name="address" value="">
    <button type="submit">Send</button>
  </form>
</body>
</html>
