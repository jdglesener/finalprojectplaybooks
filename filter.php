<header class="filter">
        <form action="index.php" method="POST" >
          <div class="form-inline">
          <select name="category" >
            <option value="">Select Book Category</option>
            <?php
               /*  
                    Write your PHP MYSQL code to populate the category
               */
              $query = "SELECT * from category;";
              $result = mysqli_query($conn, $query);
              if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
            ?>
            <option value="<?php echo $row["categoryID"];?>"><?php echo $row["category"];?></option>
            <?php
                }
              }
            ?>
          </select>     
          <input type="text"  placeholder="Search title" name=title>
          <button type="submit" class="btn-primary">Filter</button>
          <button type="submit" class="btn-secondary">Reset</button>
          </div>
        </form>
    </header> 