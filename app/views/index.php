<?php $this->view("layouts/header", $data); ?>
<div class="d-flex flex-column justify-content-center h-100">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1 class="text-center">
                Books
            </h1>
        </div>
    </div>
    <div class="row justify-content-center align-items-center">
        <div class="col-12 col-md-8">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">Is read ?</th>
                        <th scope="col">Category</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($books as $book) : ?>
                        <tr>
                            <th scope="row"><?= $book->books_id ?></th>
                            <th scope="row"><?= $book->title ?></th>
                            <th scope="row"><?= $book->author ?></th>
                            <th scope="row"><?= $book->status ?></th>
                            <th scope="row"><?= $book->name ?></th>
                            <td><a href="<?= ROOT ?>book/edit/<?= $book->books_id ?>" class="btn btn-primary">Edit</a></td>
                            <th>
                                <form method="POST" action="<?= ROOT ?>book/delete">
                                    <input type="hidden" name="id" value="<?= $book->books_id ?> ">
                                    <button class="btn btn-danger" type="submit" name="deleteBook">Delete</button>
                                </form>
                            </th>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->view("layouts/footer", $data); ?>