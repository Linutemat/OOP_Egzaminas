<!DOCTYPE html>
<html>

<head>
    <title>Reservation</title>
    <link rel="stylesheet" href="/view/style.css">
</head>

<body>
    <nav>
        <h2>
            <a href="/">Product reservation</a>
        </h2>

        <div>
            <a href="/reservation">Reserve products</a>
        </div>

    </nav>
    <div>
        <?php if (isset($inner)) : ?>
            <?php /** @var string $inner */
            require $inner; ?>
        <?php endif; ?>
    </div>
</body>

</html>