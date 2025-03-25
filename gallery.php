<?php
$baseDir = "images";  // Main images directory
$artists = array_diff(scandir($baseDir), array('.', '..')); // Get artist directories

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SVGourd Club - Gallery</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<header>
  <nav class="vintage-nav navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="index.html">Silicon Valley Gourd Club</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navmenu">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
          <li class="nav-item"><a class="nav-link active" href="gallery.php">Gallery</a></li>
          <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>
</header>

<main>
  <h2 class="text-center mb-4">Members Gallery</h2>

  <div class="row g-4" data-masonry='{"percentPosition": true }'>
    <?php 
    // Iterate through all artist directories
    foreach ($artists as $artist) {
      if (!is_dir("$baseDir/$artist") || $artist[0] === '.') continue;
      
      $artistDir = "$baseDir/$artist";
      $images = array_diff(scandir($artistDir), array('.', '..', '.DS_Store')); 
      
      // Process images in this artist's directory
      foreach ($images as $image): 
        $imagePath = "$artistDir/$image";
        // Skip if not a valid image file
        if (!is_file($imagePath) || !in_array(strtolower(pathinfo($image, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif'])) continue;
    ?>
        <div class="col-sm-6 col-md-4 col-lg-3 p-2">
          <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="Artwork" class="img-fluid w-100 rounded shadow-sm gallery-img">
        </div>
    <?php 
      endforeach;
    } 
    ?>
  </div>
</main>

<footer class="site-footer text-center p-4">
  <div class="container">
    <p>&copy; 2025 Silicon Valley Gourd Club. All Rights Reserved.</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/main.js"></script>

<!-- Add Masonry -->
<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
<!-- Add imagesLoaded -->
<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
<script>
  // Initialize Masonry after all images are loaded
  var grid = document.querySelector('.row');
  imagesLoaded(grid, function() {
    new Masonry(grid, {
      percentPosition: true
    });
  });
</script>
</body>
</html>
