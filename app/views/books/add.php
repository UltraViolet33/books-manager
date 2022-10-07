<?php $this->view("layouts/header", $data); ?>
<div class="d-flex flex-column justify-content-center h-100">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1 class="text-center">
                Add a Book
            </h1>
        </div>
    </div>
</div>
<div class="row justify-content-center align-items-center">
    <div class="col-6">
        <form method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Title : *</label>
                <input type="text" value="" name='title' class="form-control">
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author : *</label>
                <input type="text" value="" name='author' class="form-control">
            </div>
            <div class="mb-3">
                <select class="form-select" name="category_id">
                    <option selected>Select a category</option>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category->categories_id ?>"><?= $category->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-check mb-3">
                <input name="status" class="form-check-input" type="checkbox" value="true" id="flexCheckDefault">
                <label for="status" class="form-check-label" for="flexCheckDefault">
                    Read
                </label>
            </div>
            <input type="submit" class="btn btn-primary" value="Confirm">
        </form>
        <?php $this->checkError() ?>
    </div>
</div>
<?php $this->view("layouts/footer", $data); ?>