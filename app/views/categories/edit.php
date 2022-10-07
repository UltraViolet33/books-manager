<?php $this->view("layouts/header", $data); ?>
<div class="d-flex flex-column justify-content-center h-100">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1 class="text-center">
                Edit a category
            </h1>
        </div>
    </div>
</div>
<div class="row justify-content-center align-items-center">
    <div class="col-6">
        <form method="POST">
            <div class="mb-3">
                <label for="nale" class="form-label">Name : *</label>
                <input type="text" value="<?= $this->validateData($category->name) ?>" name='name' class="form-control">
            </div>
            <input type="submit" class="btn btn-primary" name="editCat" value="Confirm">
        </form>
        <?= $this->checkError() ?>
    </div>
</div>
<?php $this->view("layouts/footer", $data); ?>