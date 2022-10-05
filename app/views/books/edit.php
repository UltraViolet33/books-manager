<?php $this->view("layouts/header", $data); ?>
<div class="d-flex flex-column justify-content-center h-100">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1 class="text-center">
                Edit a Book
            </h1>
        </div>
    </div>
</div>
<div class="row justify-content-center align-items-center">
    <div class="col-6">
        <form method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Title : *</label>
                <input type="text" value="<?= $book->title ?>" name='title' class="form-control">
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author : *</label>
                <input type="text" value="<?= $book->author ?>" name='author' class="form-control">
            </div>
            <div class="mb-3">
                <select class="form-select" name="category_id">
                    <option selected>Select a categjjjory</option>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category->categories_id ?>"><?= $category->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <input type="submit" class="btn btn-primary" name="editBook" value="Confirm">
        </form>
       
    </div>
</div>
<?php $this->view("layouts/footer", $data); ?>