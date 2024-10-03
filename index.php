<?php include 'inc/header.php';
$sql = 'SELECT * FROM pokemonlist';
if (isset($_GET['submit'])) {
  $search = $_GET['search'];
  if (empty($_GET['search'])) {
    $sql = 'SELECT * FROM pokemonlist';
  }else{
    $sql = "SELECT * FROM pokemonlist WHERE name LIKE '%$search%'";
  }
}
$result = mysqli_query($conn, $sql);
$pokemonlist = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<?php
//Set vars to empty values
$name = $image = $attack = $defense = '';
$nameErr = $imagelErr = $attackErr = $defenseErr = '';

//Form submit
if (isset($_POST['submit'])) {
  //Validate name
  $type = $_POST['type'];
  $id = $_POST['id'];
  if (empty($_POST['name'])) {
    $nameErr = 'Name is required';
  } else {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }
  //validate image
  if (empty($_POST['image'])) {
    $imageErr = 'Image url is required';
  } else {
    $image = filter_input(INPUT_POST, 'image', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  //Validate attack
  if (empty($_POST['attack'])) {
    $attackErr = 'Attack is required';
  } else {
    $attack = filter_input(INPUT_POST, 'attack', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }
  //Validate defense
  if (empty($_POST['defense'])) {
    $defenseErr = 'defense is required';
  } else {
    $defense = filter_input(INPUT_POST, 'defense', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  if($type == 'delete'){
    //delete
    $sql = "DELETE FROM pokemonlist WHERE id = '$id'";
  } elseif ($type == 'new' && empty($nameErr) && empty($emailErr) && empty($bodyErr)) {
    //Add to database
    $sql = "INSERT INTO pokemonlist (name, image, attack, defense) VALUES ('$name', '$image', '$attack', '$defense')";
  } elseif($type == 'edit' && empty($nameErr) && empty($emailErr) && empty($bodyErr)) {
    $sql = "UPDATE pokemonlist SET name = '$name', image = '$image', attack = '$attack', defense = '$defense' WHERE id = '$id'";
  }
  if(isset($sql)){

    if (mysqli_query($conn, $sql)) {
      //success
      header('Location: index.php');
    } else {
      //Error
      echo 'Error: ' . mysqli_error($conn);
    }
  }
}
?>
    <main class="mt-5">
      <div class="container w-50">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="input-group mb-3 d-block">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="search" method="GET" class="d-flex">
                <input
                  type="text"
                  class="form-control"
                  name="search"
                  placeholder="Search..."
                  aria-label="Recipient's username"
                  aria-describedby="button-addon2"
                />
                <button
                  class="btn btn-warning"
                  type="submit"
                          name="submit"
                          value="Save"
                >
                  Search
                </button>
                </form>
              </div>
            </div>
            <div class="col d-flex justify-content-end mb-3">
              <!-- Button trigger modal -->
              <button
                type="button"
                class="btn btn-warning"
                onclick="openModal()"
              >
                <strong>+ New</strong>
              </button>
      
            </div>
          </div>
        </div>
        <div class="container">
          <table class="table table-bordered">
            <thead>
              <tr class="table-secondary">
                <th class="text-center" scope="col">Name</th>
                <th class="text-center" scope="col">Image</th>
                <th class="text-center" scope="col">Attack</th>
                <th class="text-center" scope="col">Defense</th>
                <th class="text-center" scope="col" style="width: 14rem;">Action</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($pokemonlist as $pokemon): ?>
              <tr>
                <td class="text-center pt-4" scope="col"><?php echo $pokemon['name']; ?></td>
                <td scope="col">
                  <div class="d-flex justify-content-center">
                    <img
                      src=<?php echo $pokemon['image']; ?>
                      alt=<?php echo $pokemon['name']; ?>
                      style="height: 70px"
                    />
                  </div>
                </td>
                <td class="text-center pt-4" scope="col">
                  <i class="bi bi-hammer"></i><?php echo $pokemon['attack']; ?>
                </td>
                <td class="text-center pt-4" scope="col">
                  <i class="bi bi-shield-shaded"></i><?php echo $pokemon['defense']; ?>
                </td>
                <td class="text-center" scope="col">
                  <div class="container d-flex justify-content-center align-items-center">
                    
                    <button
                      type="button"
                      class="btn btn-dark m-1"
                      onclick='openModal(<?php echo json_encode($pokemon) ?>)'
                    >
                      <i class="bi bi-pen-fill"></i>Edit
                    </button>
                    <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" style="width: fit-content">
                      <input type="hidden" name="type" value="delete">
                      <input type="hidden" name="id" value="<?php echo $pokemon['id'] ?>">
                      <button type="submit" name="submit" class="col btn btn-dark m-1">
                        <i class="bi bi-trash-fill"></i>Delete
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
              
            </tbody>
          </table>
          <div class="container">
          <?php if (empty($pokemonlist) && (!isset($search) || empty($search))): ?>
            <h2 class="text-center">Empty Pokemon  List!</h2>
          <?php endif; ?>
          <?php if (empty($pokemonlist) && isset($search) && !empty($search)): ?>
            <h2 class="text-center">Search Not Found!</h2>
          <?php endif; ?>
          
          </div>
        </div>
      </div>
    </main>
    <!-- Modal -->
    <div
      class="modal fade"
      id="staticBackdropEdit"
      data-bs-backdrop="static"
      data-bs-keyboard="false"
      tabindex="-1"
      aria-labelledby="staticBackdropLabel"
      aria-hidden="true"
    >
      <div
        class="modal-dialog modal-dialog modal-dialog-centered modal-xl"
      >
        <div class="modal-content">
          <div class="modal-header">
            <h1
              class="modal-title fs-5"
              id="staticBackdropLabel"
            >
              Edit Pokemon
            </h1>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="formNew" method="POST">
              <input id="type" type="hidden" name="type" value="new">
              <input id="id" type="hidden" name="id">
              <div class="row mb-2">
                <span class="col-1">Name:</span>
                <div class="col-4">
                  <input
                    required
                    type="text"
                    aria-label="First name"
                    name="name"
                    class="form-control"
                    placeholder="Name..."
                  />
                </div>
                <?php if (!empty($nameErr)) { ?> <span class="text-danger"> <?php echo $nameErr; ?></span> <?php } ?>
                <span class="col-1">Attack:</span>
                <div class="col-5">
                  <input
                    type="range"
                    class="form-range"
                    name="attack"
                    min="1"
                    max="100"
                    id="customRange2"
                    onchange="onChange('atkNum', event)"
                  />
                </div>
                <?php if (!empty($attackErr)) { ?> <span class="text-danger"> <?php echo $attackErr; ?></span> <?php } ?>
                <span id="atkNum" class="col-1">50</span>
              </div>
              <div class="row mb-2">
                <span class="col-1">Image:</span>
                <div class="col-4">
                  <input
                    required
                    type="text"
                    aria-label="First name"
                    class="form-control"
                    name="image"
                    placeholder="URL..."
                  />
                </div>
                <?php if (!empty($imageErr)) { ?> <span class="text-danger"> <?php echo $imageErr; ?></span> <?php } ?>
                <span class="col-1">Defense:</span>
                <div class="col-5">
                  <input
                    type="range"
                    class="form-range"
                    min="1"
                    max="100"
                    id="customRange2"
                    name="defense"
                    onchange="onChange('defNum', event)"
                  />
                </div>
                <?php if (!empty($defenseErr)) { ?> <span class="text-danger"> <?php echo $defenseErr; ?></span> <?php } ?>
                <span class="col-1" id="defNum">50</span>
              </div>
              <div class="modal-footer d-flex justify-content-center">
                <button  type="submit"
                          name="submit"
                          value="Save"
                          class="btn btn-warning">
                          
                  <i class="bi bi-floppy-fill"></i>
                  Save
                </button>
                <button
                  type="button"
                  class="btn btn-dark"
                  data-bs-dismiss="modal"
                >
                  Cancel
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php include 'inc/footer.php' ?>
