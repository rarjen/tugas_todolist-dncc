<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Hello, world!</title>
</head>

<body>
    <?php
    require_once("config/connection.php");

    try {
        if (isset($_POST["submit"])) {
            $task = $_POST["task"];
            $date = $_POST["date"];

            $queryCreated = "INSERT INTO tugas(task, date) VALUES ('$task', '$date')";


            $created = mysqli_query($conn, $queryCreated);
        }
    } catch (Exception $error) {
        echo "Error", $error->getMessage(), "\n";
    }
    ?>
    <!-- Form Data -->
    <div class="container card mt-5 col-md-8">
        <div class="card-header fw-bold">Tambah Todolist</div>
        <div class="card-body">
            <form action="" method="post">
                <div class=" mb-3">
                    <label for="task" class="form-label">Tugas Saya</label>
                    <input type="text" class="form-control" id="task" name="task" required>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Deadline</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <!-- End Form Data -->

    <!-- Table -->
    <div class="container card mt-5 col-md-8">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Todo</th>
                        <th scope="col">Deadline</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $queryShow = "SELECT * FROM tugas ORDER BY date ASC"; // menampilkan data
                    $show = mysqli_query($conn, $queryShow);

                    if (mysqli_num_rows($show) > 0) {
                        $number = 1;
                        while ($data = mysqli_fetch_assoc($show)) {

                    ?>
                            <tr>
                                <td class="number"><?= $number; ?></td>
                                <td><?= $data["task"]; ?></td>
                                <td><?= $data["date"]; ?></td>
                                <td class="action">
                                    <a href="edit.php?id=<?php echo $data["id"] ?>" class="edit-btn">Edit</a>
                                    <a href="delete.php?id=<?php echo $data["id"] ?>" class="delete-btn">Delete</a>
                                </td>
                            </tr>
                        <?php
                            $number++;
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="4">No Data Found</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- End Table -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>