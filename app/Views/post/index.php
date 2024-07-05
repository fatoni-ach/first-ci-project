<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap5/css/bootstrap.min.css'); ?>">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Button trigger modal -->
    <br>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Create Post
    </button>
    <br>

    <!-- Modal Create -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url() . uri_string() ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Update -->
    <div class="modal fade" id="modalUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url() . uri_string() ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <input type="hidden" name="_method" value="PUT"/>
                        <input type="hidden" name="id_update" id="id_update">
                        <div class="mb-3">
                            <label for="title_update" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title_update" name="title_update">
                        </div>
                        <div class="mb-3">
                            <label for="description_update" class="form-label">Description</label>
                            <textarea class="form-control" id="description_update" rows="3" name="description_update"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $index => $p) { ?>
                <tr>
                    <th scope="row"><?= $index + 1 ?></th>
                    <td><?= $p['title'] ?></td>
                    <td><?= $p['description'] ?></td>
                    <td>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalUpdate" onclick="showModalUpdate('<?= $p['id'] ?>' ,'<?= $p['title'] ?>', '<?= $p['description'] ?>')">
                            Edit
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="destroy(<?= $p['id'] ?>)">
                            Delete
                        </button>
                    </td>
                </tr>
            <?php } ?>
            <!-- <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
            </tr> -->
        </tbody>
    </table>


    <script src="<?= base_url('bootstrap5/js/bootstrap.bundle.min.js') ?>"></script>
    <script type="text/javascript">
        function destroy(id) {
            var postId = id; // Assuming you have a data-post-id attribute on the delete button
            var url = '<?= base_url() . uri_string() ?>/' + postId; // Replace with your actual API endpoint

            var confirmation = confirm('Are you sure you want to delete this post?');
            if (confirmation) {
                fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-Token': document.querySelector('input[name="csrf_test_name"]').value // Assuming you have a CSRF token input field
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            // Handle success response, e.g., remove the row from the table
                            // event.target.closest('tr').remove();
                            console.log("success")
                            location.reload();
                        } else {
                            // Handle error response
                            console.error('Error deleting post:', response.statusText);
                        }
                    })
                    .catch(error => {
                        // Handle network error
                        console.error('Network error:', error);
                    });
            }
        }

        function showModalUpdate(id, title, description){
            console.log(title);
            document.getElementById('id_update').value = id;
            document.getElementById('title_update').value = title;
            document.getElementById('description_update').value = description;
        }
        //     document.querySelectorAll('.btn-danger').forEach(function(button) {
        // button.addEventListener('click', function(event) {

        // });
        // });
    </script>
</body>

</html>