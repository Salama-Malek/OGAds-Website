<!-- resources/views/offers.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <title>Offers</title>
</head>

<body>
    <h1>Offers</h1>

    <ul>
        @foreach ($offers as $offer)
        <li><pre>{{ json_encode($offer, JSON_PRETTY_PRINT) }}</pre></li>
        @endforeach
    </ul>
</body>

</html>