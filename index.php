<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Hotel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container my-5">

<?php

$hotels = [
    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],
];

$parkingFilter = $_GET['parking'] ?? '';
$voteFilter = $_GET['vote'] ?? '';

$filteredHotels = [];

foreach ($hotels as $hotel) {

    $parkingOk = true;
    $voteOk = true;

    if ($parkingFilter !== '') {
        $parkingOk = $hotel['parking'] == $parkingFilter;
    }

    if ($voteFilter !== '') {
        $voteOk = $hotel['vote'] >= $voteFilter;
    }

    if ($parkingOk && $voteOk) {
        $filteredHotels[] = $hotel;
    }
}

?>

<h1 class="mb-4">Hotel a Milano</h1>

<form method="GET" class="row g-3 mb-4">

    <div class="col-md-4">
        <label class="form-label">Parcheggio</label>
        <select name="parking" class="form-select">
            <option value="">Tutti</option>
            <option value="1" <?php echo $parkingFilter === '1' ? 'selected' : ''; ?>>Con parcheggio</option>
            <option value="0" <?php echo $parkingFilter === '0' ? 'selected' : ''; ?>>Senza parcheggio</option>
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label">Voto minimo</label>
        <input 
            type="number" 
            name="vote" 
            class="form-control" 
            min="1" 
            max="5"
            value="<?php echo $voteFilter; ?>"
            placeholder="Es. 3"
        >
    </div>

    <div class="col-md-4 d-flex align-items-end">
        <button type="submit" class="btn btn-primary me-2">Filtra</button>
        <a href="index.php" class="btn btn-secondary">Reset</a>
    </div>

</form>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Descrizione</th>
            <th>Parcheggio</th>
            <th>Voto</th>
            <th>Distanza dal centro</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($filteredHotels as $hotel) { ?>
            <tr>
                <td><?php echo $hotel['name']; ?></td>
                <td><?php echo $hotel['description']; ?></td>
                <td><?php echo $hotel['parking'] ? 'Sì' : 'No'; ?></td>
                <td><?php echo $hotel['vote']; ?></td>
                <td><?php echo $hotel['distance_to_center']; ?> km</td>
            </tr>
        <?php } ?>
    </tbody>
</table>

</div>
</body>
</html>