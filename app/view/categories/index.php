<?php $this->view("layouts/header", $data); ?>
<div class="d-flex flex-column justify-content-center h-100">
  <div class="row justify-content-center">
    <div class="col-12">
      <h1 class="text-center">
        Categories
      </h1>
    </div>
  </div>
</div>
<div class="row justify-content-center align-items-center">
  <div class="col-12 col-md-8">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Edit</th>
          <th scope="col">

            Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($categories as $category) : ?>
          <tr>
            <th scope="row"><?= $category->categories_id ?></th>
            <td><?= $category->name ?></td>
            <td><button>Edit</button></td>
            <td>
              <form method="POST" action="<?=ROOT?>category/delete">
                <input type="hidden" name="id" value="<?= $category->categories_id ?> ">
                <button class="btn btn-danger" type="submit" name="deleteCat">Delete</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php $this->view("layouts/footer", $data); ?>