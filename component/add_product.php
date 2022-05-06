<?php
?>

<form method="post" action="">
    <div class="form-control">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="<?php echo $name; ?>">
    </div>
    <div class="form-control">
        <label for="price">Price</label>
        <input type="text" name="price" id="price" value="<?php echo $price; ?>">
    </div>
    <div class="form-control">
        <label for="description">Description</label>
        <textarea name="description" id="description" cols="30" rows="10"><?php echo $description; ?></textarea>
    </div>
    <div class="form-control">
        <label for="image">Image</label>
        <input type="file" name="image" id="image">
    </div>
    <div class="form-control">
        <label for="category">Category</label>
        <select name="category" id="category">
        <?php foreach ($categories as $category) : ?>
            <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
        <?php endforeach; ?>
        </select>
    </div>
</form>
